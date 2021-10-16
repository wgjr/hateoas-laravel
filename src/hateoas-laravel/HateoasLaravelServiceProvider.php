<?php

namespace hateoasLaravel;

use Illuminate\Support\ServiceProvider;

class HateoasLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hateoasLaravel', HateoasLaravel::class);
    }
}