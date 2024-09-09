<?php

namespace Laramic\Mailer;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Laramic\Mailer\Service\LaramicManager;

class LaramicMailerServiceProvider extends ServiceProvider
{
    public function boot(Filesystem $filesystem)
    {
        $this->publishes([
            __DIR__ . '/../config/laramic.php' => config_path('laramic.php')
        ],'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/2023_12_01_030159_create_laramic_mail_table.php' => database_path('/migrations/2023_12_01_030159_create_laramic_mail_table.php'),
        ],'migrations');

        if(!$filesystem->exists(database_path('/migrations/2023_12_01_030159_create_laramic_mail_table.php'))){
            $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ .'/../config/laramic.php', 'laramic');

        $this->app->singleton('laramic.manager', function ($app) {
            return new LaramicManager($app);
        });
    }

}


