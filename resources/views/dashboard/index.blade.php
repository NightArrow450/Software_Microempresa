<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel de control</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <h1>Panel de control</h1>

    <p>
        Bienvenido:
        {{ auth()->user()->first_name }}
        {{ auth()->user()->last_name }}
    </p>

    <p>
        Rol:
        {{ auth()->user()->role->name }}
    </p>

    <p>
        Correo:
        {{ auth()->user()->email }}
    </p>

    <a href="{{ url('/admin-prueba') }}">
        Probar acceso administrador
    </a>

    <br><br>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit">
            Cerrar sesión
        </button>
    </form>

</body>
</html>