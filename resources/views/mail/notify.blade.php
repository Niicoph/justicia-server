<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de Evento</title>
</head>

<body>
    <h1>🔔 Recordatorio de Evento</h1>
    <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
    <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
    <p><strong>Hora de Inicio:</strong> {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }}</p>
    <p><strong>Hora de Fin:</strong> {{ \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') }}</p>
    <p>¡No olvides tu evento!</p>
</body>

</html>
