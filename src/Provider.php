<?php

namespace MshMsh;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Commands\ModuleCreate::class,
            Commands\ModuleMake::class
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Modules'   =>  base_path('Modules')
        ]);
        $this->loadRoutes();
        $this->loadMigrations();
        $this->loadViews();
        $this->loadComponents();

        require __DIR__ . '/Helpers.php';

        config()->set('auth.providers.users.model', \Modules\User\Models\User::class);
    }

    private function loadRoutes()
    {
        $web_router = Route::middleware(['web', 'locale']);

        $web_files = glob(base_path("Modules/**/Routes/web.php"));
        \array_map(function ($file) use ($web_router) {
            $module = array_reverse(explode('/', $file))[2];
            $web_router->namespace("Modules\\$module\\Controllers")->group($file);
        }, $web_files);

        // $admin_router = Route::middleware(['web', "admin:ads"]);
        $admin_files = glob(base_path("Modules/**/Routes/admin.php"));
        // dd($admin_files);
        \array_map(function ($file) {
            $module = array_reverse(explode('/', $file))[2];
            Route::middleware(['web' , 'locale' , "admin:$module"])->namespace("Modules\\$module\\Controllers")
                ->prefix('admin')->as('admin.')->group($file);
        }, $admin_files);

        $api_router = Route::middleware(['locale'])->prefix('api');
        $api_files = glob(base_path("Modules/**/Routes/api.php"));
        \array_map(function ($file) use ($api_router) {
            $module = array_reverse(explode('/', $file))[2];
            $api_router->namespace("Modules\\$module\\Controllers")->group($file);
        }, $api_files);
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(glob(base_path("Modules/**/DB")));
    }

    private function loadViews()
    {
        $views = glob(base_path('Modules/**/Views'));
        array_map(function ($view) {
            $prefix = array_reverse(explode('/', $view))[1];
            $this->loadViewsFrom($view, $prefix);
        }, $views);
    }

    private function loadComponents()
    {
        $components = glob(base_path(('Modules/**/Components/*')));
        array_map(function ($component) {
            $file = array_reverse(explode('/', $component))[0];
            $class_name = explode('.', $file)[0];
            $component_name = strtolower($class_name);
            $namespaces = explode("/Modules", $component);
            if(count($namespaces) == 1){
                $namespaces = explode("\Modules", $component);   
            }
            foreach ($namespaces as $namespace) {
                if (strpos($namespace, 'Components') !== false) {
                    $namespace = "\Modules" . str_replace([$file, '/'], ['', '\\'], $namespace);
                    // dd($component , "{$namespace}{$class_name}");
                    \Illuminate\Support\Facades\Blade::component("{$namespace}{$class_name}", $component_name);
                }
            }
        }, $components);
    }
}
