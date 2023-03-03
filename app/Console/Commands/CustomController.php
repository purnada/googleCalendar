<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CustomController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:cc {model} {--m} {controllerDir?} {viewDir?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CustomController';

    protected $modelDir = 'Models';

    protected $controllerDir = 'Admin';

    protected $viewDir = 'admin';



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
        if ($this->argument('controllerDir')) {
            $this->controllerDir = ucFirst($this->argument('controllerDir'));
        }

        if ($this->argument('viewDir')) {
            $this->viewDir = strtolower($this->argument('viewDir'));
        }


        // Get the model and folder name with first character Capital
        $this->model = ucfirst($this->argument('model'));
        // $this->folder = ucfirst($this->argument('folder'));


        // Create Model under default instalation folder
        if ($this->confirm('Do you wish to create' . ' ' . $this->model . ' ' . 'Model?')) {
            $this->call('make:model', [
                'name' => $this->model,
            ]);
        }
        if ($this->confirm('Do you wish to create' . ' ' . $this->model . ' ' . 'Controler?')) {
            $controllerDirectory = app_path('Http/Controllers/' . $this->controllerDir);
            $this->createDirectory($controllerDirectory);

            // Controller File
            $sourceControllerFile = app_path('Console/Stubs/CustomController.stub');
            $destinationControllerFile = app_path("Http/Controllers/{$this->controllerDir}/{$this->model}Controller.php");
            $msg = "Created {$this->model}Controller";
            $this->createFile($sourceControllerFile, $destinationControllerFile, $msg);
        }

        if ($this->confirm('Do you wish to create' . ' ' . $this->model . ' ' . 'Form Request?')) {
            $this->call('make:request', [
                'name' => ucfirst($this->controllerDir) . '/' . $this->model . 'Request',
            ]);
        }
        if ($this->confirm('Do you wish to create' . ' ' . $this->model . ' ' . 'migration?')) {
            $this->createMigration();
        }

        if ($this->confirm('Do you wish to create the views')) {
            $this->createViews();
        }

    }

    protected function createFile($dummySource, $destinationPath, $message, $folder = null)
    {
        $this->model = ucfirst($this->argument('model'));
        $pluralModel = \Str::plural($this->model);
        $dummyFile = file_get_contents($dummySource);
        $toBeReplacedContent = str_replace(
            ['Dummy', 'Dummies', 'dummies', 'dummy','folderDir','{{$viewDir}}'],
            [$this->model, $pluralModel, strtolower($pluralModel), strtolower($this->model),$this->controllerDir,$this->viewDir],
            $dummyFile
        );
        file_put_contents($dummySource, $toBeReplacedContent);
        copy($dummySource, $destinationPath);
        file_put_contents($dummySource, $dummyFile);
        return $this->info($message);
    }

    /**
     *  Create the directory for the model
     *  @return void
     */

    protected function createDirectory($dir)
    {

        if (!is_dir($dir)) {

            mkdir($dir, 0755, true);
        }
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('model'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    protected function createViews()
    {
        $folder = Str::snake(Str::pluralStudly(class_basename($this->model)));

        $pluralModel = \Str::plural(ucfirst($this->argument('model')));

        $bladeFolder = strtolower($folder);

        $views = [
            'pages/index.stub' => "{$this->viewDir}/pages/{$bladeFolder}/index.blade.php",
            'pages/edit.stub' => "{$this->viewDir}/pages/{$bladeFolder}/edit.blade.php",
            'pages/create.stub' => "{$this->viewDir}/pages/{$bladeFolder}/create.blade.php",
        ];
        foreach ($views as $key => $value) {
            $this->createDirectory($this->getViewPath($this->viewDir) . '/pages');
            if (file_exists($view = $this->getViewPath($value))) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            $sourceControllerFile = app_path("Console/Stubs/{$key}");

            $destinationControllerFile = $this->getViewPath("$value");
            $this->createDirectory($this->getViewPath("{$this->viewDir}/pages/{$bladeFolder}"));
            $msg =  str_replace('.stub', '', explode("/", $key)[1])  . " View Created";
            $this->createFile($sourceControllerFile, $this->getViewPath($value), $msg);
        }
    }

    protected function getViewPath($path)
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }
}
