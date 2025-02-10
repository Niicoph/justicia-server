<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EstudioRepository;
use Illuminate\Support\Facades\Gate;
use App\Policies\EventoPolicy;
use App\Policies\EstudioPolicy;
use App\Models\Estudio;
use App\Models\Evento;

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
        Gate::policy(Estudio::class, EstudioPolicy::class);
    }
}
