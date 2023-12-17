<?php

namespace MshMsh\Loaders;
use Illuminate\Support\ServiceProvider;

class Views extends ServiceProvider;
{
    public function __construct()
    {
        $this->load();
    }

    private function load()
    {
        $views = glob(base_path('Modules/**/Views'));
        array_map(function ($view) {
            $prefix = array_reverse(explode('/', $view))[1];
            $this->loadViewsFrom($view, $prefix);
        }, $views);
    }
}
