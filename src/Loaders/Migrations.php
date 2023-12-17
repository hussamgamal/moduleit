<?php

namespace MshMsh\Loaders;

use Illuminate\Support\ServiceProvider;

class Migrations extends ServiceProvider
{

    public function load()
    {
        $this->loadMigrationsFrom(glob(base_path("Modules/**/DB")));
    }
}
