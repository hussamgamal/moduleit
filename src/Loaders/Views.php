<?php

namespace MshMsh\Loaders;

use Illuminate\Support\ServiceProvider;

trait Views
{
    public function loadViews()
    {
        $views = glob(base_path('Modules/**/Views'));
        array_map(function ($view) {
            $prefix = array_reverse(explode('/', $view))[1];
            $this->loadViewsFrom($view, $prefix);
        }, $views);
    }
}
