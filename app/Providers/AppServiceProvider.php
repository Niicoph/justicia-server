<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EstudioRepository;
use App\Models\Usuario;
use App\Models\Evento;
use App\Policies\EventoPolicy;
use Illuminate\Support\Facades\Gate;

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
        Gate::policy(Evento::class, EventoPolicy::class);
    }
}
