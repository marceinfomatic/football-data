<?php

namespace App\Providers\Extra;

use App\Manager\MatchManager;
use App\Manager\MatchManagerInterface;
use Illuminate\Support\ServiceProvider;

class ManagerProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(MatchManagerInterface::class, MatchManager::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }

}
