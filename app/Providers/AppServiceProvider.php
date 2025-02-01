<?php

namespace App\Providers;

use App\Repositories\ClientRepository;
use App\Repositories\ClientRepositoryInterface;
use App\Services\ClientService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(ClientService::class, function ($app) {
            return new ClientService($app->make(ClientRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
