<?php

namespace guivic\LaravelAsaas\Tests;

use guivic\LaravelAsaas\LaravelAsaasServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        $app['config']->set("asaas.api_key", "9f06223db7ec7db3e6d14e60161ecde56b5189bc44e9f6ef7cccf9438e829d60");
        $app['config']->set("asaas.enviroment", "homologacao");
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
