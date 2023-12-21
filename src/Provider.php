<?php

namespace MshMsh;

use Illuminate\Support\ServiceProvider;
use MshMsh\Loaders\Components;
use MshMsh\Loaders\Migrations;
use MshMsh\Loaders\Routes;
use MshMsh\Loaders\Views;
use MshMsh\Middlewares\Admin;
use MshMsh\Middlewares\Locale;

class Provider extends ServiceProvider
{
    use Views,
        Routes,
        Components;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Register commands
         */
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
    public function boot(\Illuminate\Routing\Router $router)
    {
        /**
         * Create Modules folder if not exists
         */
        $router->aliasMiddleware('locale', Locale::class);
        $router->aliasMiddleware('admin', Admin::class);


        $this->publishes([
            __DIR__ . '/Modules'   =>  base_path('Modules'),
            // __DIR__ . '/Middlewares'   =>  base_path('app/Http/Middleware')
        ], 'mshmsh-modules');

        /**
         * Load routes for web , admin , api
         */
        $this->loadRoutes();
        /**
         * Load migrations from Modules//DB;
         */
        $this->loadMigrationsFrom(glob(base_path("Modules/**/DB")));
        /**
         * Load views from Modules//Views;
         */
        $this->loadViews();
        /**
         * Load Components from Modules//Components
         */
        $this->loadComponents();

        /**
         * Set auth User model path configration 
         */
        config()->set('auth.providers.users.model', \Modules\User\Models\User::class);

        /**
         * Auto load helpers
         */
        require __DIR__ . '/Helpers.php';
    }
}
