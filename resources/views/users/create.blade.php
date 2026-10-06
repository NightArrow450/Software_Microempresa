<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo Usuario | DHACER ECO LIMP</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #faf8ff;
        }
    </style>
</head>

<body>

<div class="max-w-4xl mx-auto p-5 lg:py-8">

    <div class="flex items-center gap-4 mb-6">

        <a
            href="{{ route('users.index') }}"
            class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center"
        >
            <span class="material-symbols-outlined">
                arrow_back
            </span>
        </a>

        <div>

            <p class="text-xs text-gray-500">
                Inicio / Usuarios / Nuevo
            </p>

            <h1 class="text-2xl font-bold">
                Nuevo Usuario
            </h1>

        </div>

    </div>


    @if($errors->any())

        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700">

            <p class="font-semibold">
                Revisa los campos ingresados.
            </p>

            <ul class="list-disc ml-5 mt-2 text-sm">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('users.store') }}"
        class="space-y-6"
    >

        @csrf


        <section class="bg-white p-6 rounded-xl shadow-sm">

            <h2 class="text-lg font-semibold mb-5">
                Información personal
            </h2>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Nombres *
                    </label>

                    <input
                        type="text"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        class="w-full h-11 px-4 border rounded-lg"
                    >

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Apellidos *
                    </label>

                    <input
                        type="text"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        class="w-full h-11 px-4 border rounded-lg"
                    >

                </div>

            </div>

        </section>


        <section class="bg-white p-6 rounded-xl shadow-sm">

            <h2 class="text-lg font-semibold mb-5">
                Información de acceso
            </h2>


            <div class="space-y-5">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Correo electrónico *
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full h-11 px-4 border rounded-lg"
                    >

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Contraseña *
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full h-11 px-4 border rounded-lg"
                        >

                    </div>


                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Confirmar contraseña *
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full h-11 px-4 border rounded-lg"
                        >

                    </div>

                </div>

            </div>

        </section>


        <section class="bg-white p-6 rounded-xl shadow-sm">

            <h2 class="text-lg font-semibold mb-5">
                Configuración
            </h2>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Rol *
                    </label>

                    <select
                        name="role_id"
                        class="w-full h-11 px-3 border rounded-lg"
                    >

                        <option value="">
                            Seleccione un rol
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                {{ old('role_id') == $role->id ? 'selected' : '' }}
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Estado *
                    </label>

                    <select
                        name="status"
                        class="w-full h-11 px-3 border rounded-lg"
                    >

                        <option value="1">
                            Activo
                        </option>

                        <option value="0">
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>

        </section>


        <div class="flex justify-end gap-3">

            <a
                href="{{ route('users.index') }}"
                class="px-5 py-3 rounded-lg bg-gray-200 font-semibold"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="px-5 py-3 rounded-lg bg-[#006948] text-white font-semibold"
            >
                Guardar Usuario
            </button>

        </div>

    </form>

</div>

</body>
</html>