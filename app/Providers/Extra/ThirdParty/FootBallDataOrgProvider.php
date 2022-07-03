<?php

namespace App\Providers\Extra\ThirdParty;

use App\ThirdParty\Factory\HttpClientFactory;
use App\ThirdParty\FootBallDataOrg\Config\FootBallDataOrgConfig;
use App\ThirdParty\FootBallDataOrg\FootBallDataOrgClient;
use App\ThirdParty\HttpRestWrapper;
use Illuminate\Support\ServiceProvider;

class FootBallDataOrgProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(FootBallDataOrgClient::class, function($app) {
            $httpRest =  new HttpRestWrapper(
                (new HttpClientFactory()),
                FootBallDataOrgConfig::getTimeOut(),
                FootBallDataOrgConfig::getRetry(),
                FootBallDataOrgConfig::getApiUrl(),
                [],
                FootBallDataOrgConfig::getCredentials()
            );

            return new FootBallDataOrgClient($httpRest);
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
