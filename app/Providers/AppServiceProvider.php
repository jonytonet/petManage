<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, function ($app) {
            return new CustomerRepository(new User);
        });
        $this->app->bind(CustomerService::class, function ($app) {
            return new CustomerService(app(CustomerRepository::class));
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
