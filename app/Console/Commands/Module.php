<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Module CLI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        if (File::exists(base_path('modules/' . $name))) {
            $this->error("Module $name already exists!");

        }
// make router
        $routerFoder = base_path('modules/' . $name . '/routes');
        if (!File::exists($routerFoder)) {
            File::makeDirectory(base_path('modules/' . $name . '/routes'), 0755, true, true);
        }
        $routerFile = $routerFoder . '/routes.php';
        if (!File::exists($routerFile)) {
            File::put($routerFile, "");
        }
        //make src
        $srcFoder = base_path('modules/' . $name . '/src');
        if (!File::exists($srcFoder)) {
            File::makeDirectory(base_path('modules/' . $name . '/src'), 0755, true, true);
        }
        if (!file_exists($srcFoder . '/Http')) {
            File::makeDirectory($srcFoder . '/Http', 0755, true, true);
        }
        if (!file_exists($srcFoder . '/Models')) {
            File::makeDirectory($srcFoder . '/Models', 0755, true, true);
        }
        if (!file_exists($srcFoder . '/Commands')) {
            File::makeDirectory($srcFoder . '/Commands', 0755, true, true);
        }
        if (!file_exists($srcFoder . '/Http/Controller')) {
            File::makeDirectory($srcFoder . '/Http/Controller', 0755, true, true);
        }
        if (!file_exists($srcFoder . '/Http/Middlewares')) {
            File::makeDirectory($srcFoder . '/Http/Middlewares', 0755, true, true);
        }
        //make  resource
        $resourceFoder = base_path('modules/' . $name . '/resource');
        if (!File::exists($resourceFoder)) {
            File::makeDirectory(base_path('modules/' . $name . '/resource'), 0755, true, true);
        }
        if (!File::exists($resourceFoder . '/lang')) {
            File::makeDirectory($resourceFoder . '/lang', 0755, true, true);
        }
        if (!File::exists($resourceFoder . '/views')) {
            File::makeDirectory($resourceFoder . '/views', 0755, true, true);
        }
        // make migration
        $migrateFoder = base_path('modules/' . $name . '/migration');
        if (!File::exists($migrateFoder)) {
            File::makeDirectory(base_path('modules/' . $name . '/migration'), 0755, true, true);
        }
        // make config
        $configForder = base_path('modules/' . $name . '/config');
        if (!File::exists($configForder)) {
            File::makeDirectory(base_path('modules/' . $name . '/config'), 0755, true, true);
        }
        $configFile = $configForder . '/config.php';
        if (!File::exists($configFile)) {
            File::put($configFile, "");
        }
        //make Reository

//        File::put('D:\Xampp\htdocs\Laravel\modules/Product/src/Repository/ProductRepository.php', "<?php");

        $repositoryForder = base_path('modules/' . $name . '/src/Repositories');

        if (!file_exists($repositoryForder)) {
            File::makeDirectory($repositoryForder, 0755, true, true);

            if (!file_exists($repositoryForder . '/' . $name . 'Repository.php')) {
                $pathModule = app_path('Console/Commands/Template/ModuleRipository.txt');

                $moduleRepositoryFile = file_get_contents($pathModule);
                $moduleRepositoryFile = str_replace('{module}', $name, $moduleRepositoryFile);
//                file_put_contents($pathModule, $moduleRepositoryFile);

                File::put($repositoryForder . '/' . $name . 'Repository.php', $moduleRepositoryFile);
            }
            if (!file_exists($repositoryForder . "/" . $name . 'RepositoryInterface.php')) {
                File::put($repositoryForder . '/' . $name . 'RepositoryInterface.php', "");
                $pathModule = app_path('Console/Commands/Template/RepositoryInterface.txt');

                $moduleRepositoryFile = file_get_contents($pathModule);
                $moduleRepositoryFile = str_replace('{module}', $name, $moduleRepositoryFile);
//                file_put_contents($pathModule, $moduleRepositoryFile);
                File::put($repositoryForder . '/' . $name . 'RepositoryInterface.php', $moduleRepositoryFile);

            }

        }


    }
}
