<?php

namespace modules;

use modules\User\src\Http\Middlewares\DemoMiddleware;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use modules\User\src\Commands\test;
use modules\User\src\Repositories\UserRepositoryInterface;


class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modules = $this->getModule();
        if (!empty($modules)) {
            foreach ($modules as $moduleName) {
                $this->registerModule($moduleName);
            }
        }
    }

    private function getModule()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }

    public function register()
    {
        $modules = $this->getModule();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerConfig($module);
            }
        }
        $this->registerMiddlewares();
        $this->app->singleton(
            UserRepositoryInterface::class,
        );
    }

    private function registerConfig($module)
    {
        $configPath = __DIR__ . "/" . $module . '/configs';
        if (file_exists($configPath)) {
            $configFile = array_map('basename', File::allFiles($configPath));
            foreach ($configFile as $file) {
                $alias = basename($file, '.php');
                $this->mergeConfigFrom($configPath . '/' . $file, $alias);
            }
        }
    }

    private function registerMiddlewares()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

    private function registeRoute($modulePath)
    {
        if (File::exists($modulePath . "routes/routes.php")) {
            $this->loadRoutesFrom($modulePath . "routes/routes.php");
        }
    }

    private function registerMigration($modulePath)
    {
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }
    }

    private function registerLanguage($modulePath, $moduleName)
    {
        if (File::exists($modulePath . "resources/lang")) {
            // Đa ngôn ngữ theo file php
            // Dùng đa ngôn ngữ tại file php resources/lang/en/general.php : @lang('Demo::general.hello')
            $this->loadTranslationsFrom($modulePath . "resources/lang", $moduleName);// Đa ngôn ngữ theo file json
            $this->loadJSONTranslationsFrom($modulePath . 'resources/lang');
        }
    }

    private function registerView($modulePath, $moduleName)
    {
        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", $moduleName);
        }
    }

    private function registerHelper($modulePath)
    {
        if (File::exists($modulePath . "helpers")) {
// Tất cả files có tại thư mục helpers
            $helper_dir = File::allFiles($modulePath . "helpers");
// khai báo helpers
            foreach ($helper_dir as $key => $value) {
                $file = $value->getPathName();
                require $file;
            }
        }
    }

    private function registerMiddle()
    {
        $middleare = [
            'demo' => DemoMiddleware::class
        ];
        if (!empty($middleare)) {
            foreach ($middleare as $key => $value) {
                $this->app['router']->pushMiddlewareToGroup($key, $value);
            }
        }

    }

    private function registerModule($moduleName)
    {
        $modulePath = __DIR__ . "/$moduleName/";
        // Khai báo route
        $this->registeRoute($modulePath);
        // Khai báo migration
        // Toàn bộ file migration của modules sẽ tự động được load
        $this->registerMigration($modulePath);

        // Khai báo languages
        $this->registerLanguage($modulePath, $moduleName);

// Khai báo views
// Gọi view thì ta sử dụng: view('Demo::index'), @extends('Demo::index'), @include('Demo::index')
        $this->registerView($modulePath, $moduleName);
// Khai báo helpers
        $this->registerHelper($modulePath,);
        $this->registerMiddle();
    }


}
