<?php

namespace MshMsh;

use Illuminate\Support\ServiceProvider;
use MshMsh\Loaders\Components;
use MshMsh\Loaders\Migrations;
use MshMsh\Loaders\Routes;
use MshMsh\Loaders\Views;

class Provider extends ServiceProvider
{
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
    public function boot()
    {
        /**
         * Create Modules folder if not exists
         */
        $this->publishes([
            __DIR__ . '/Modules'   =>  base_path('Modules')
        ]);

        /**
         * Load routes for web , admin , api
         */
        new Routes();
        /**
         * Load migrations from Modules//DB;
         */
        new Migrations();
        /**
         * Load views from Modules//Views;
         */
        new Views();
        /**
         * Load Components from Modules//Components
         */
        new Components();

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
