<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\FilesystemManager;

class AzureStorageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app['filesystem']->extend('azure', function ($app, $config) {
            return new \App\Storage\AzureStorageManager(
                $config['account'] ?? env('AZURE_STORAGE_ACCOUNT'),
                $config['key'] ?? env('AZURE_STORAGE_KEY'),
                $config['container'] ?? env('AZURE_STORAGE_CONTAINER')
            );
        });
    }
}
