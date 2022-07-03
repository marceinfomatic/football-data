<?php

namespace App\Providers\Extra;

use App\ThirdParty\Factory\HttpClientFactory;
use App\ThirdParty\Factory\HttpClientFactoryInterface;
use Illuminate\Support\ServiceProvider;

class HttpClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(HttpClientFactoryInterface::class, function($app) {
            return new HttpClientFactory();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
