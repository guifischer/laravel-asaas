<?php

namespace guivic\LaravelAsaas\Tests;

use Dotenv\Dotenv;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Schema\Blueprint;
use guivic\LaravelAsaas\LaravelAsaasServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */

    protected function getPackageProviders($app)
    {
        return [
            LaravelAsaasServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../.env.testing');
        $dotenv->load();

        $app['config']->set("asaas.api_key", env("ASAAS_API_KEY"));
        $app['config']->set("asaas.enviroment", env("ASAAS_ENVIROMENT", "homologacao"));
    }

    protected function setUpDataBase()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
}
