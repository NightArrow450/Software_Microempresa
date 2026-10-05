<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acceso no autorizado</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <h1>403</h1>

    <h2>Acceso no autorizado</h2>

    <p>
        No tienes permisos para acceder a esta sección.
    </p>

    <a href="{{ route('dashboard') }}">
        Volver al panel de control
    </a>

</body>
</html>