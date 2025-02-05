<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EstudioRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EstudioRepository::class, function ($app) {
            return new EstudioRepository();
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
