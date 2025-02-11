<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EventoService;
use Carbon\Carbon;
use App\Mail\EventoNotifyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class EventoNotify extends Command
{
    protected $eventoService;

    public function __construct(EventoService $eventoService)
    {
        parent::__construct();
        $this->eventoService = $eventoService;
    }

    protected $signature = 'app:evento-notify';  // Nombre del comando
    protected $description = 'Envía notificaciones por email sobre eventos próximos';  // Descripción del comando

    public function handle()
    {
        $eventos = $this->eventoService->getTodayEventos();
        $horaActual = date('H:i'); // Solo hora y minutos

        foreach ($eventos as $evento) {
            $horaInicio = Carbon::parse($evento->fecha . ' ' . $evento->hora_inicio);
            $horaNotificacion = (clone $horaInicio)->subMinutes($evento->minutos_previos_notificacion);

            Log::alert("horaNoti: " . $horaNotificacion->format('H:i') . " horaActual: " . $horaActual);

            // Comparar solo hora y minutos
            if ($horaNotificacion->format('H:i') === $horaActual) {
                Mail::to($evento->usuario->email)->send(new EventoNotifyMail($evento));
                Log::alert("Notificación enviada a: " . $evento->usuario->email);
            } else {
                Log::alert("Enviar mail más tarde");
            }
        }
    }
}
