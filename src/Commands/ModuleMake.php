<?php

namespace MshMsh\Commands;

use Illuminate\Console\Command;

class ModuleMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make 
                            {type : What you need to create [ model , migration , controller , component , resource , request ] }
                            {name : Name of what you need to create}
                            {--m|module= : Module name to perform action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform action on modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $type = $this->argument('type');
        $name = $this->argument('name');
        $module = $this->option('module');
        if ($module == null) {
            $this->error("Please enter module name -m=");
        } else {
            $modules = glob(base_path("Modules") . '/*', GLOB_ONLYDIR);
            $modules = array_map(function ($module) {
                return array_reverse(explode('/', $module))[0];
            }, $modules);
            $module = str_replace('=', '', $module);

            if (!in_array($type, ['model', 'migration', 'controller', 'component', 'resource', 'request'])) {
                $this->error("Invalid type please enter one of these model , migration , controller , component , resource , request");
            } elseif (!in_array($module, $modules)) {
                $this->error("Module name not found");
            } else {
                if (strpos($name, '/') !== false) $name = substr($name, strrpos($name, '/') + 1);
                switch ($type) {
                    case 'model':
                        $this->new_model($module, $name);
                        break;

                    case 'migration':
                        $this->new_migration($module, $name);
                        break;

                    case 'controller':
                        $this->new_controller($module, $name);
                        break;

                    case 'component':
                        $this->new_component($module, $name);
                        break;

                    case 'resource':
                        $this->new_resource($module, $name);
                        break;

                    case 'request':
                        $this->new_request($module, $name);
                        break;
                }
            }
        }
    }

    /**
     * New model
     */
    private function new_model($module, $name)
    {
        $single = \Illuminate\Support\Str::singular($name);
        $filename = ucwords($single);
        $content = file_get_contents(__DIR__ . "/Demo/Models/Module.php");
        $content = str_replace(
            ['ModuleName', 'module_name', 'ModelName'],
            [$module, strtolower($module), $filename],
            $content
        );
        if (file_exists(base_path("Modules/$module/Models/$filename.php"))) {
            $this->error("Model alreay exists");
        } else {
            file_put_contents(base_path("Modules/$module/Models/$filename.php"), $content);
            $this->info("**************************" . PHP_EOL . "Model created successfully" . PHP_EOL . "**************************");
        }
    }

    /**
     * New migration
     */
    private function new_migration($module, $name)
    {
        $classname = str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        $tablename = str_replace(['create_', '_table'], ['', ''], $name);
        $filename = "2_0_0_0_" . strtolower($name);
        $content = file_get_contents(__DIR__ . "/Demo/DB/2_0_0_0_create_module_table.php");
        $content = str_replace(
            ['CreateModuleNameTable', 'ModuleName', 'module_name'],
            [$classname, $module, $tablename],
            $content
        );

        if (file_exists(base_path("Modules/$module/DB/$filename.php"))) {
            $this->error("Migration file alreay exists");
        } else {
            file_put_contents(base_path("Modules/$module/DB/$filename.php"), $content);
            $this->info("********************************" . PHP_EOL . "Migration created successfully" . PHP_EOL . "********************************");
        }
    }

    /**
     * New controller
     */
    private function new_controller($module, $name)
    {
        $filename = ucwords($name);
        $content = file_get_contents(__DIR__ . "/Demo/Controllers/WebController.php");
        $content = str_replace(
            ['ModuleName', 'WebController'],
            [$module, $filename],
            $content
        );

        if (file_exists(base_path("Modules/$module/Controllers/$filename.php"))) {
            $this->error("Controller alreay exists");
        } else {
            file_put_contents(base_path("Modules/$module/Controllers/$filename.php"), $content);
            $this->info("********************************" . PHP_EOL . "Controller created successfully" . PHP_EOL . "********************************");
        }
    }

    /**
     * New component
     * Create component controler and component view
     */
    private function new_component($module, $name)
    {
        $dir = base_path("Modules/$module/Components");
        if (!is_dir($dir)) mkdir($dir);
        $viewdir = base_path("Modules/$module/Views/components");
        if (!is_dir($viewdir)) mkdir($viewdir);

        $filename = ucwords($name);
        $content = file_get_contents(__DIR__ . "/Demo/Components/ComponentName.php");
        $content = str_replace(
            ['ModuleName', 'ComponentName', 'componentfile'],
            [$module, $filename, strtolower($name)],
            $content
        );
        if (file_exists($dir . '/' . $filename . '.php')) {
            $this->error("Component alreay exists");
        } else {
            file_put_contents(base_path("Modules/$module/Views/components/" . strtolower($name) . ".blade.php"), '');
            file_put_contents($dir . '/' . $filename . '.php', $content);
            $this->info("********************************" . PHP_EOL . "Component created successfully" . PHP_EOL . "********************************");
        }
    }

    /**
     * New resource
     */
    private function new_resource($module, $name)
    {
        $dir = base_path("Modules/$module/Resources");
        if (!is_dir($dir)) mkdir($dir);
        $filename = ucwords($name);
        $content = file_get_contents(__DIR__ . "/Demo/Resources/DemoResource.php");
        $content = str_replace(
            ['ModuleName', 'DemoResource'],
            [$module, $filename],
            $content
        );

        if (file_exists(base_path("Modules/$module/Resources/$filename.php"))) {
            $this->error("Resource alreay exists");
        } else {
            file_put_contents(base_path("Modules/$module/Resources/$filename.php"), $content);
            $this->info("********************************" . PHP_EOL . "Resource created successfully" . PHP_EOL . "********************************");
        }
    }


    /**
     * New request
     */
    private function new_request($module, $name)
    {
        $dir = base_path("Modules/$module/Requests");
        if (!is_dir($dir)) mkdir($dir);
        $filename = ucwords($name);
        $content = file_get_contents(__DIR__ . "/Demo/Requests/DemoRequest.php");
        $content = str_replace(
            ['ModuleName', 'DemoRequest'],
            [$module, $filename],
            $content
        );

        if (file_exists(base_path("Modules/$module/Requests/$filename.php"))) {
            $this->error("Request alreay exists");
        } else {
            file_put_contents(base_path("Modules/$module/Requests/$filename.php"), $content);
            $this->info("********************************" . PHP_EOL . "Request created successfully" . PHP_EOL . "********************************");
        }
    }
}
