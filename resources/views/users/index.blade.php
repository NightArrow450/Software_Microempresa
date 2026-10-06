<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestión de Usuarios | DHACER ECO LIMP</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#006948',
                        'primary-container': '#00855d',
                        surface: '#faf8ff',
                        'surface-container': '#eaedff',
                        'surface-container-low': '#f2f3ff',
                        'on-surface': '#131b2e',
                        'on-surface-variant': '#3d4a42',
                        outline: '#6d7a72',
                        'outline-variant': '#bccac0'
                    }
                }
            }
        }
    </script>

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-surface text-on-surface">

<div class="min-h-screen">

    {{-- HEADER --}}
    <header class="bg-white shadow-sm">

        <div class="max-w-7xl mx-auto px-5 lg:px-8 py-5">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="flex items-center gap-4">

                    <a
                        href="{{ route('dashboard') }}"
                        class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary"
                    >
                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>
                    </a>

                    <div>
                        <p class="text-xs text-on-surface-variant">
                            Inicio / Usuarios
                        </p>

                        <h1 class="text-2xl font-bold">
                            Gestión de Usuarios
                        </h1>

                        <p class="text-sm text-on-surface-variant mt-1">
                            Administra las cuentas, roles y estados de los usuarios.
                        </p>
                    </div>

                </div>

                <a
                    href="{{ route('users.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-primary hover:bg-primary-container text-white font-semibold"
                >
                    <span class="material-symbols-outlined">
                        person_add
                    </span>

                    Nuevo Usuario
                </a>

            </div>

        </div>

    </header>


    <main class="max-w-7xl mx-auto p-5 lg:py-8">


        {{-- ALERTAS --}}
        @if(session('success'))

            <div class="mb-5 p-4 rounded-lg bg-green-50 border border-green-200 flex gap-3">

                <span class="material-symbols-outlined text-green-700">
                    check_circle
                </span>

                <p class="text-sm text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        @endif


        @if(session('error'))

            <div class="mb-5 p-4 rounded-lg bg-red-50 border border-red-200 flex gap-3">

                <span class="material-symbols-outlined text-red-600">
                    error
                </span>

                <p class="text-sm text-red-700">
                    {{ session('error') }}
                </p>

            </div>

        @endif


        {{-- FILTROS --}}
        <section class="bg-white rounded-xl shadow-sm p-5 mb-6">

            <form
                method="GET"
                action="{{ route('users.index') }}"
                class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4"
            >

                <div class="xl:col-span-2">

                    <label
                        for="search"
                        class="block text-sm font-medium mb-2"
                    >
                        Buscar usuario
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nombre, apellido o correo..."
                        class="w-full h-11 px-4 rounded-lg border border-outline-variant outline-none focus:ring-2 focus:ring-primary"
                    >

                </div>


                <div>

                    <label
                        for="role"
                        class="block text-sm font-medium mb-2"
                    >
                        Rol
                    </label>

                    <select
                        id="role"
                        name="role"
                        class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white"
                    >

                        <option value="">
                            Todos
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                {{ request('role') == $role->id ? 'selected' : '' }}
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label
                        for="status"
                        class="block text-sm font-medium mb-2"
                    >
                        Estado
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full h-11 px-3 rounded-lg border border-outline-variant bg-white"
                    >

                        <option value="">
                            Todos
                        </option>

                        <option
                            value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}
                        >
                            Activo
                        </option>

                        <option
                            value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                    </select>

                </div>


                <div class="md:col-span-2 xl:col-span-4 flex gap-3">

                    <button
                        type="submit"
                        class="px-4 py-2.5 rounded-lg bg-primary text-white font-semibold"
                    >
                        Aplicar filtros
                    </button>

                    <a
                        href="{{ route('users.index') }}"
                        class="px-4 py-2.5 rounded-lg bg-surface-container text-on-surface-variant font-semibold"
                    >
                        Limpiar
                    </a>

                </div>

            </form>

        </section>


        {{-- TABLA --}}
        <section class="bg-white rounded-xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-outline-variant">

                <h2 class="font-semibold">
                    Usuarios registrados
                </h2>

                <p class="text-sm text-on-surface-variant">
                    {{ $users->total() }} resultado(s)
                </p>

            </div>


            @if($users->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[900px]">

                        <thead class="bg-surface-container-low">

                            <tr>

                                <th class="px-5 py-3 text-left text-xs uppercase">
                                    Usuario
                                </th>

                                <th class="px-5 py-3 text-left text-xs uppercase">
                                    Correo
                                </th>

                                <th class="px-5 py-3 text-left text-xs uppercase">
                                    Rol
                                </th>

                                <th class="px-5 py-3 text-left text-xs uppercase">
                                    Estado
                                </th>

                                <th class="px-5 py-3 text-left text-xs uppercase">
                                    Fecha
                                </th>

                                <th class="px-5 py-3 text-right text-xs uppercase">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-outline-variant">

                            @foreach($users as $user)

                                <tr class="hover:bg-surface-container-low">

                                    <td class="px-5 py-4">

                                        <p class="font-semibold">
                                            {{ $user->first_name }}
                                            {{ $user->last_name }}
                                        </p>

                                        @if(auth()->id() === $user->id)

                                            <span class="text-xs text-primary">
                                                Tu cuenta
                                            </span>

                                        @endif

                                    </td>


                                    <td class="px-5 py-4 text-sm">
                                        {{ $user->email }}
                                    </td>


                                    <td class="px-5 py-4">

                                        <span class="px-3 py-1 rounded-full bg-surface-container text-primary text-xs font-semibold">
                                            {{ $user->role->name }}
                                        </span>

                                    </td>


                                    <td class="px-5 py-4">

                                        @if($user->status)

                                            <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold">
                                                Activo
                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">
                                                Inactivo
                                            </span>

                                        @endif

                                    </td>


                                    <td class="px-5 py-4 text-sm">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>


                                    <td class="px-5 py-4">

                                        <div class="flex justify-end gap-1">

                                            <a
                                                href="{{ route('users.show', $user) }}"
                                                title="Ver"
                                                class="p-2 rounded-lg hover:bg-surface-container text-primary"
                                            >
                                                <span class="material-symbols-outlined">
                                                    visibility
                                                </span>
                                            </a>


                                            <a
                                                href="{{ route('users.edit', $user) }}"
                                                title="Editar"
                                                class="p-2 rounded-lg hover:bg-surface-container text-primary"
                                            >
                                                <span class="material-symbols-outlined">
                                                    edit
                                                </span>
                                            </a>


                                            @if(auth()->id() !== $user->id)

                                                <form
                                                    method="POST"
                                                    action="{{ route('users.toggle-status', $user) }}"
                                                    onsubmit="return confirm('{{ $user->status ? '¿Deseas desactivar este usuario?' : '¿Deseas activar este usuario?' }}')"
                                                >

                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="{{ $user->status ? 'text-red-600' : 'text-green-700' }} p-2"
                                                    >

                                                        <span class="material-symbols-outlined">
                                                            {{ $user->status ? 'person_off' : 'person_check' }}
                                                        </span>

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                @if($users->hasPages())

                    <div class="p-5 border-t">
                        {{ $users->links() }}
                    </div>

                @endif


            @else

                <div class="py-16 text-center">

                    <span class="material-symbols-outlined text-5xl text-primary">
                        person_search
                    </span>

                    <h3 class="text-lg font-semibold mt-3">
                        No se encontraron usuarios
                    </h3>

                </div>

            @endif

        </section>

    </main>

</div>

</body>
</html>