<?php

namespace MshMsh\Commands;

use Illuminate\Console\Command;

class ModuleCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:create 
                            {name : Name of new module , prefered to be plural}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new module with its Controllers , Models , Migrations , Routes , Views.
    Optional you can create: Components , Resources , Requests';

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
        $name = $this->argument('name');
        $this->recurse_copy(__DIR__ . "/Demo", base_path("Modules/$name"), $name);
        $this->info("**************************" . PHP_EOL . "Module create successfully" . PHP_EOL . "**************************");
    }

    public function recurse_copy($src, $dst, $name = null)
    {
        if ($name) {
            $upper = $name;
            $lower = strtolower($name);
            $single = \Illuminate\Support\Str::singular($lower);
            $model_name = ucfirst($single);
        }
        $dir = opendir($src);
        while (false !== ($file = readdir($dir))) {
            if (!in_array(substr($dst, strrpos($dst, '/') + 1), ['Resources', 'Components', 'Requests'])) {
                @mkdir($dst);
                if (($file != '.') && ($file != '..')) {
                    if (is_dir($src . '/' . $file)) {
                        $this->recurse_copy($src . '/' . $file, $dst . '/' . $file, $name);
                    } else {
                        if ($name) {
                            $newfile = str_replace(['Module', 'module'], [$upper, $lower], $file);
                            copy($src . '/' . $file, $dst . '/' . $newfile);
                            $file = $dst . '/' . $newfile;
                            file_put_contents(
                                $file,
                                str_replace(
                                    ['ModuleName', 'module_name', 'ModelName'],
                                    [$name, $lower, $model_name],
                                    file_get_contents($file)
                                )
                            );
                        } else {
                            copy($src . '/' . $file, $dst . '/' . $file);
                        }
                    }
                }
            }
        }
        closedir($dir);
    }
}
