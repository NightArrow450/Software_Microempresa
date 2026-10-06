<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Usuario | DHACER ECO LIMP</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#faf8ff]">

<div class="max-w-4xl mx-auto p-5 lg:py-8">

    <div class="mb-6">

        <a
            href="{{ route('users.show', $user) }}"
            class="text-[#006948] text-sm"
        >
            ← Volver
        </a>

        <h1 class="text-2xl font-bold mt-2">
            Editar Usuario
        </h1>

        <p class="text-sm text-gray-500">
            Modifica los datos, rol o estado de la cuenta.
        </p>

    </div>


    @if($errors->any())

        <div class="mb-5 p-4 bg-red-50 text-red-700 rounded-lg">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('users.update', $user) }}"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        <section class="bg-white rounded-xl shadow-sm p-6">

            <h2 class="font-semibold text-lg mb-5">
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
                        value="{{ old('first_name', $user->first_name) }}"
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
                        value="{{ old('last_name', $user->last_name) }}"
                        class="w-full h-11 px-4 border rounded-lg"
                    >

                </div>

            </div>

        </section>


        <section class="bg-white rounded-xl shadow-sm p-6">

            <h2 class="font-semibold text-lg mb-5">
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
                        value="{{ old('email', $user->email) }}"
                        class="w-full h-11 px-4 border rounded-lg"
                    >

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Nueva contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Dejar vacío para conservar"
                            class="w-full h-11 px-4 border rounded-lg"
                        >

                    </div>


                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Confirmar nueva contraseña
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


        <section class="bg-white rounded-xl shadow-sm p-6">

            <h2 class="font-semibold text-lg mb-5">
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

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}
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

                        <option
                            value="1"
                            {{ old('status', (string)$user->status) === '1' ? 'selected' : '' }}
                        >
                            Activo
                        </option>

                        <option
                            value="0"
                            {{ old('status', (string)$user->status) === '0' ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                    </select>

                    @error('status')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>


        <div class="flex justify-end gap-3">

            <a
                href="{{ route('users.show', $user) }}"
                class="px-5 py-3 bg-gray-200 rounded-lg font-semibold"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="px-5 py-3 bg-[#006948] text-white rounded-lg font-semibold"
            >
                Guardar Cambios
            </button>

        </div>

    </form>

</div>

</body>
</html>