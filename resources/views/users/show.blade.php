<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detalle de Usuario | DHACER ECO LIMP</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#faf8ff]">

<div class="max-w-4xl mx-auto p-5 lg:py-8">

    <div class="flex justify-between items-center mb-6">

        <div>

            <a
                href="{{ route('users.index') }}"
                class="text-[#006948] text-sm"
            >
                ← Volver a Usuarios
            </a>

            <h1 class="text-2xl font-bold mt-2">
                Detalle del Usuario
            </h1>

        </div>


        <a
            href="{{ route('users.edit', $user) }}"
            class="px-4 py-2.5 bg-[#006948] text-white rounded-lg font-semibold"
        >
            Editar Usuario
        </a>

    </div>


    @if(session('success'))

        <div class="mb-5 p-4 bg-green-50 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    <section class="bg-white rounded-xl shadow-sm p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <p class="text-xs text-gray-500 uppercase">
                    Nombres
                </p>

                <p class="font-semibold mt-1">
                    {{ $user->first_name }}
                </p>

            </div>


            <div>

                <p class="text-xs text-gray-500 uppercase">
                    Apellidos
                </p>

                <p class="font-semibold mt-1">
                    {{ $user->last_name }}
                </p>

            </div>


            <div>

                <p class="text-xs text-gray-500 uppercase">
                    Correo electrónico
                </p>

                <p class="font-semibold mt-1">
                    {{ $user->email }}
                </p>

            </div>


            <div>

                <p class="text-xs text-gray-500 uppercase">
                    Rol
                </p>

                <p class="font-semibold mt-1">
                    {{ $user->role->name }}
                </p>

            </div>


            <div>

                <p class="text-xs text-gray-500 uppercase">
                    Estado
                </p>

                @if($user->status)

                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-green-50 text-green-700 font-semibold text-sm">
                        Activo
                    </span>

                @else

                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-100 text-gray-600 font-semibold text-sm">
                        Inactivo
                    </span>

                @endif

            </div>


            <div>

                <p class="text-xs text-gray-500 uppercase">
                    Fecha de creación
                </p>

                <p class="font-semibold mt-1">
                    {{ $user->created_at->format('d/m/Y H:i') }}
                </p>

            </div>

        </div>

    </section>


    @if(auth()->id() !== $user->id)

        <div class="mt-6 flex justify-end">

            <form
                method="POST"
                action="{{ route('users.toggle-status', $user) }}"
                onsubmit="return confirm('{{ $user->status ? '¿Deseas desactivar este usuario?' : '¿Deseas activar este usuario?' }}')"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="{{ $user->status
                        ? 'bg-red-600'
                        : 'bg-green-700'
                    }} text-white px-5 py-3 rounded-lg font-semibold"
                >

                    {{ $user->status
                        ? 'Desactivar Usuario'
                        : 'Activar Usuario'
                    }}

                </button>

            </form>

        </div>

    @endif

</div>

</body>
</html>