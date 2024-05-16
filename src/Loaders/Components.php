<?php

namespace MshMsh\Loaders;

use \Illuminate\Support\Facades\Blade;

trait Components
{

    public function loadComponents()
    {
        Blade::component("MshMsh\Components\Input", 'input');

        $components = glob(base_path(('Modules/**/Components/*')));
        array_map(function ($component) {
            extract($this->namespaces($component));
            foreach ($namespaces as $namespace) {
                if (strpos($namespace, 'Components') !== false) {
                    $namespace = "\Modules" . str_replace([$file, '/'], ['', '\\'], $namespace);
                    Blade::component("{$namespace}{$class_name}", $component_name);
                }
            }
        }, $components);
    }

    private function namespaces($component)
    {
        $file = array_reverse(explode('/', $component))[0];
        $class_name = explode('.', $file)[0];
        $component_name = strtolower($class_name);
        $namespaces = explode("/Modules", $component);
        if (count($namespaces) == 1) {
            $namespaces = explode("\Modules", $component);
        }
        return get_defined_vars();
    }
}
