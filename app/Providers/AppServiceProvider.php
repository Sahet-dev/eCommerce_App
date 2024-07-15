<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Verified;
use App\Listeners\CreateCustomerAfterEmailVerified;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        Verified::class => [
            CreateCustomerAfterEmailVerified::class,
        ],
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
