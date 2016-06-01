<?php

namespace KalebClark\LaravelTools;

use Illuminate\Support\ServiceProvider;

class LaravelToolsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            'KalebClark\LaravelTools\Console\RemakeDBCommand',
            'KalebClark\LaravelTools\Console\EnvironmentCommand'
        );
    }
    public function provides()
    {

    }
}
