<?php

namespace MshMsh\Loaders;

use Illuminate\Support\Facades\Route;
use MshMsh\Middlewares\Admin;
use MshMsh\Middlewares\Locale;

trait Routes
{
    public static function loadRoutes()
    {
        self::web();

        self::admin();

        self::api();
    }

    private static function web()
    {
        $web_router = Route::middleware([
            'web',
            Locale::class
        ]);
        $web_files = glob(base_path("Modules/**/Routes/web.php"));
        \array_map(function ($file) use ($web_router) {
            $module = array_reverse(explode('/', $file))[2];
            $web_router->namespace("Modules\\$module\\Controllers")->group($file);
        }, $web_files);
    }

    private static function admin()
    {
        // $admin_router = Route::middleware(['web', "admin:ads"]);
        $admin_files = glob(base_path("Modules/**/Routes/admin.php"));
        // dd($admin_files);
        \array_map(function ($file) {
            $module = array_reverse(explode('/', $file))[2];
            Route::middleware([
                'web',
                Locale::class,
                Admin::class . ":$module"
            ])->namespace("Modules\\$module\\Controllers")
                ->prefix('admin')->as('admin.')->group($file);
        }, $admin_files);
    }


    private static function api()
    {
        $api_router = Route::middleware([
            Locale::class
        ])->prefix('api');
        $api_files = glob(base_path("Modules/**/Routes/api.php"));
        \array_map(function ($file) use ($api_router) {
            $module = array_reverse(explode('/', $file))[2];
            $api_router->namespace("Modules\\$module\\Controllers")->group($file);
        }, $api_files);
    }
}
