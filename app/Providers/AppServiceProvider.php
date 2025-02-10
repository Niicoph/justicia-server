<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EstudioRepository;
use Illuminate\Support\Facades\Gate;
use App\Policies\EventoPolicy;
use App\Policies\EstudioPolicy;
use App\Policies\RolPolicy;
use App\Policies\UsuarioPolicy;
use App\Policies\NotaPolicy;

use App\Models\Estudio;
use App\Models\Evento;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Nota;


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
        Gate::policy(Rol::class, RolPolicy::class);
        Gate::policy(Usuario::class, UsuarioPolicy::class);
        Gate::policy(Nota::class, NotaPolicy::class);
    }
}
