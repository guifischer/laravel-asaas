<?php

namespace guivic\LaravelAsaas;

use Illuminate\Support\ServiceProvider;

class LaravelAsaasServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerResources();
    }

    private function registerResources()
    {
        $this->publishes([
            __DIR__ . '../config/asaas.php' => config_path('asaas.php'),
        ]);
    }
}
