<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Panel de Control | DHACER ECO LIMP</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#006948',
                        'primary-container': '#00855d',

                        secondary: '#006a63',
                        'secondary-container': '#99efe5',

                        surface: '#faf8ff',
                        'surface-container': '#eaedff',
                        'surface-container-low': '#f2f3ff',
                        'surface-container-high': '#e2e7ff',
                        'surface-container-lowest': '#ffffff',

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
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
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

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }
    </style>
</head>


<body class="bg-surface text-on-surface">

@php
    $usuario = auth()->user();

    $rol = $usuario->role->name;

    $esAdministrador = $rol === 'Administrador';

    $iniciales =
        strtoupper(substr($usuario->first_name, 0, 1)) .
        strtoupper(substr($usuario->last_name, 0, 1));
@endphp



{{-- ========================================================= --}}
{{-- SIDEBAR --}}
{{-- ========================================================= --}}

<aside
    class="
        hidden
        lg:flex
        fixed
        left-0
        top-0
        h-screen
        w-64
        bg-surface-container-lowest
        shadow-sm
        z-50
        flex-col
        justify-between
    "
>

    <div>

        {{-- LOGO --}}
        <div
            class="
                h-20
                px-4
                flex
                items-center
                gap-3
            "
        >

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Eco Limp"
                class="w-12 h-12 object-contain"
            >

            <div>

                <p class="font-bold text-on-surface">
                    DHACER ECO LIMP
                </p>

                <p class="text-xs text-on-surface-variant">
                    Sistema Web de Gestión
                </p>

            </div>

        </div>


        {{-- MENÚ --}}
        <div class="px-3 py-4">

            <p
                class="
                    px-3
                    mb-2
                    text-xs
                    font-semibold
                    text-outline
                    uppercase
                    tracking-wider
                "
            >
                Sección principal
            </p>


            {{-- DASHBOARD --}}
            <a
                href="{{ route('dashboard') }}"
                class="
                    flex
                    items-center
                    gap-3
                    px-3
                    py-3
                    rounded-lg
                    bg-primary
                    text-white
                    font-semibold
                "
            >

                <span class="material-symbols-outlined">
                    dashboard
                </span>

                Panel de Control

            </a>


            {{-- USUARIOS --}}
            @if($esAdministrador)

                <a
                    href="{{ route('users.index') }}"
                    class="
                        mt-1
                        flex
                        items-center
                        gap-3
                        px-3
                        py-3
                        rounded-lg
                        text-on-surface-variant
                        hover:bg-surface-container
                        hover:text-primary
                        transition-colors
                    "
                >

                    <span class="material-symbols-outlined">
                        group
                    </span>

                    Gestión de Usuarios

                </a>


                {{-- ROLES --}}
                <div
                    class="
                        flex
                        items-center
                        gap-3
                        px-3
                        py-3
                        rounded-lg
                        text-on-surface-variant
                        opacity-70
                    "
                >

                    <span class="material-symbols-outlined">
                        verified_user
                    </span>

                    Roles y Permisos

                </div>

            @endif


            {{-- PRODUCTOS --}}
            <div
                class="
                    flex
                    items-center
                    gap-3
                    px-3
                    py-3
                    rounded-lg
                    text-on-surface-variant
                    opacity-70
                "
            >

                <span class="material-symbols-outlined">
                    inventory_2
                </span>

                Catálogo de Productos

            </div>


            {{-- PRÓXIMOS MÓDULOS --}}
            <p
                class="
                    px-3
                    mt-6
                    mb-2
                    text-xs
                    font-semibold
                    text-outline
                    uppercase
                    tracking-wider
                "
            >
                Próximos módulos
            </p>


            @foreach([
                ['shopping_cart', 'Pedidos'],
                ['warehouse', 'Inventario'],
                ['local_shipping', 'Seguimiento']
            ] as $modulo)

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        px-3
                        py-3
                        text-outline
                        opacity-50
                    "
                >

                    <div class="flex items-center gap-3">

                        <span class="material-symbols-outlined">
                            {{ $modulo[0] }}
                        </span>

                        {{ $modulo[1] }}

                    </div>


                    <span
                        class="
                            text-[10px]
                            px-2
                            py-1
                            rounded
                            bg-surface-container
                        "
                    >
                        Próximamente
                    </span>

                </div>

            @endforeach

        </div>

    </div>



    {{-- USUARIO --}}
    <div class="p-3 bg-surface-container-low">

        <div
            class="
                flex
                items-center
                gap-3
                p-3
                bg-white
                rounded-xl
            "
        >

            <div
                class="
                    w-10
                    h-10
                    rounded-full
                    bg-primary
                    text-white
                    flex
                    items-center
                    justify-center
                    font-semibold
                "
            >
                {{ $iniciales }}
            </div>


            <div class="min-w-0 flex-1">

                <p class="text-sm font-semibold truncate">

                    {{ $usuario->first_name }}
                    {{ $usuario->last_name }}

                </p>

                <p class="text-xs text-primary truncate">
                    {{ $rol }}
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    title="Cerrar sesión"
                    class="
                        text-on-surface-variant
                        hover:text-red-600
                    "
                >

                    <span class="material-symbols-outlined">
                        logout
                    </span>

                </button>

            </form>

        </div>

    </div>

</aside>



{{-- ========================================================= --}}
{{-- CONTENEDOR PRINCIPAL --}}
{{-- ========================================================= --}}

<div class="lg:pl-64 min-h-screen">


    {{-- HEADER --}}
    <header
        class="
            h-20
            bg-white
            shadow-sm
            flex
            items-center
            justify-between
            px-5
            lg:px-8
        "
    >

        <div class="flex items-center gap-3">

            <img
                src="{{ asset('images/logo.png') }}"
                class="w-10 h-10 object-contain lg:hidden"
                alt="Eco Limp"
            >

            <div>

                <p class="text-xs text-on-surface-variant">
                    Inicio /
                </p>

                <p class="font-semibold">
                    Panel de Control
                </p>

            </div>

        </div>


        <div class="flex items-center gap-4">

            <div
                class="
                    hidden
                    sm:flex
                    items-center
                    gap-2
                    px-3
                    py-1.5
                    rounded-full
                    bg-secondary-container
                    text-secondary
                    text-sm
                    font-semibold
                "
            >

                <span
                    class="
                        w-2
                        h-2
                        bg-secondary
                        rounded-full
                    "
                ></span>

                Rol: {{ $rol }}

            </div>


            <div class="hidden md:block text-right">

                <p class="text-sm font-semibold">

                    {{ $usuario->first_name }}
                    {{ $usuario->last_name }}

                </p>

                <p class="text-xs text-on-surface-variant">
                    {{ $usuario->email }}
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
                class="lg:hidden"
            >

                @csrf

                <button
                    type="submit"
                    class="text-red-600"
                >

                    <span class="material-symbols-outlined">
                        logout
                    </span>

                </button>

            </form>

        </div>

    </header>



    {{-- ===================================================== --}}
    {{-- CONTENIDO --}}
    {{-- ===================================================== --}}

    <main class="p-5 lg:p-8">


        {{-- CABECERA --}}
        <div class="mb-8">

            <p
                class="
                    text-xs
                    font-semibold
                    uppercase
                    tracking-wider
                    text-primary
                "
            >
                Sprint 1 • Acceso operativo
            </p>

            <h1
                class="
                    text-3xl
                    font-bold
                    mt-2
                "
            >
                Panel de Control
            </h1>

            <p
                class="
                    text-on-surface-variant
                    mt-1
                "
            >
                Bienvenido al Sistema Web de Gestión.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- TARJETAS SUPERIORES --}}
        {{-- ================================================= --}}

        <div
            class="
                grid
                grid-cols-1
                sm:grid-cols-2
                xl:grid-cols-4
                gap-5
            "
        >


            {{-- USUARIOS --}}
            <div
                class="
                    bg-white
                    rounded-xl
                    shadow-sm
                    p-6
                "
            >

                <div class="flex justify-between">

                    <div>

                        <p class="text-sm text-on-surface-variant">
                            Usuarios activos
                        </p>

                        <p
                            class="
                                text-4xl
                                font-bold
                                mt-4
                            "
                        >
                            {{ $usuariosActivos }}
                        </p>

                    </div>


                    <div
                        class="
                            w-11
                            h-11
                            rounded-xl
                            bg-surface-container
                            text-primary
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <span class="material-symbols-outlined">
                            group
                        </span>

                    </div>

                </div>


                <p
                    class="
                        text-xs
                        text-on-surface-variant
                        mt-5
                    "
                >
                    {{ $administradores }} Administrador(es)
                    • {{ $ventas }} Ventas
                    • {{ $produccionReparto }} Producción/Reparto
                </p>

            </div>



            {{-- PRODUCTOS --}}
            <div
                class="
                    bg-white
                    rounded-xl
                    shadow-sm
                    p-6
                "
            >

                <div class="flex justify-between">

                    <div>

                        <p class="text-sm text-on-surface-variant">
                            Catálogo de productos
                        </p>

                        <p
                            class="
                                text-xl
                                font-bold
                                mt-4
                                text-primary
                            "
                        >
                            En desarrollo
                        </p>

                    </div>


                    <div
                        class="
                            w-11
                            h-11
                            rounded-xl
                            bg-secondary-container
                            text-secondary
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <span class="material-symbols-outlined">
                            inventory_2
                        </span>

                    </div>

                </div>

                <p
                    class="
                        text-xs
                        text-on-surface-variant
                        mt-5
                    "
                >
                    Se implementará dentro del Sprint 1.
                </p>

            </div>



            {{-- ROL --}}
            <div
                class="
                    bg-white
                    rounded-xl
                    shadow-sm
                    p-6
                "
            >

                <p class="text-sm text-on-surface-variant">
                    Mi rol actual
                </p>


                <div
                    class="
                        mt-5
                        inline-flex
                        items-center
                        gap-2
                        px-3
                        py-2
                        rounded-lg
                        bg-surface-container
                        text-primary
                        font-semibold
                    "
                >

                    <span
                        class="
                            w-2
                            h-2
                            bg-primary
                            rounded-full
                        "
                    ></span>

                    {{ $rol }}

                </div>


                <p
                    class="
                        text-xs
                        text-on-surface-variant
                        mt-6
                    "
                >

                    @if($esAdministrador)

                        Acceso administrativo habilitado.

                    @else

                        Acceso limitado según permisos asignados.

                    @endif

                </p>

            </div>



            {{-- ESTADO DEL SISTEMA --}}
            <div
                class="
                    bg-white
                    rounded-xl
                    shadow-sm
                    p-6
                "
            >

                <p class="text-sm text-on-surface-variant">
                    Estado del sistema
                </p>


                <div class="flex items-center gap-2 mt-5">

                    <span
                        class="
                            w-3
                            h-3
                            bg-green-600
                            rounded-full
                        "
                    ></span>

                    <span class="text-2xl font-bold">
                        Operativo
                    </span>

                </div>


                <p
                    class="
                        text-xs
                        text-on-surface-variant
                        mt-6
                    "
                >
                    Autenticación y base de datos disponibles.
                </p>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- ACCESOS RÁPIDOS --}}
        {{-- ================================================= --}}

        <section
            class="
                mt-6
                bg-white
                rounded-xl
                shadow-sm
                p-6
            "
        >

            <div class="flex items-center gap-3 mb-5">

                <div
                    class="
                        w-10
                        h-10
                        rounded-lg
                        bg-surface-container
                        text-primary
                        flex
                        items-center
                        justify-center
                    "
                >

                    <span class="material-symbols-outlined">
                        bolt
                    </span>

                </div>


                <div>

                    <h2 class="text-xl font-semibold">
                        Accesos rápidos
                    </h2>

                    <p class="text-sm text-on-surface-variant">
                        Funciones disponibles durante el Sprint 1.
                    </p>

                </div>

            </div>


            <div
                class="
                    grid
                    grid-cols-1
                    md:grid-cols-2
                    xl:grid-cols-4
                    gap-4
                "
            >


                @if($esAdministrador)

                    {{-- GESTIONAR USUARIOS --}}
                    <a
                        href="{{ route('users.index') }}"
                        class="
                            p-4
                            rounded-xl
                            bg-surface-container-low
                            border
                            border-outline-variant
                            hover:border-primary
                            hover:shadow-md
                            transition-all
                        "
                    >

                        <span
                            class="
                                material-symbols-outlined
                                text-primary
                            "
                        >
                            group
                        </span>

                        <p class="font-semibold mt-2">
                            Gestionar Usuarios
                        </p>

                        <p
                            class="
                                text-xs
                                text-on-surface-variant
                                mt-1
                            "
                        >
                            Registrar, consultar y administrar usuarios.
                        </p>

                    </a>



                    {{-- NUEVO USUARIO --}}
                    <a
                        href="{{ route('users.create') }}"
                        class="
                            p-4
                            rounded-xl
                            bg-surface-container-low
                            border
                            border-outline-variant
                            hover:border-primary
                            hover:shadow-md
                            transition-all
                        "
                    >

                        <span
                            class="
                                material-symbols-outlined
                                text-primary
                            "
                        >
                            person_add
                        </span>

                        <p class="font-semibold mt-2">
                            Nuevo Usuario
                        </p>

                        <p
                            class="
                                text-xs
                                text-on-surface-variant
                                mt-1
                            "
                        >
                            Registrar una nueva cuenta de acceso.
                        </p>

                    </a>



                    {{-- ROLES --}}
                    <div
                        class="
                            p-4
                            rounded-xl
                            bg-surface-container-low
                            border
                            border-outline-variant
                            opacity-70
                        "
                    >

                        <span
                            class="
                                material-symbols-outlined
                                text-primary
                            "
                        >
                            verified_user
                        </span>

                        <p class="font-semibold mt-2">
                            Roles y Permisos
                        </p>

                        <p
                            class="
                                text-xs
                                text-on-surface-variant
                                mt-1
                            "
                        >
                            Administrador, Ventas y Producción/Reparto.
                        </p>

                    </div>

                @endif



                {{-- PRODUCTOS --}}
                <div
                    class="
                        p-4
                        rounded-xl
                        bg-surface-container-low
                        border
                        border-outline-variant
                        opacity-70
                    "
                >

                    <span
                        class="
                            material-symbols-outlined
                            text-primary
                        "
                    >
                        inventory_2
                    </span>

                    <p class="font-semibold mt-2">
                        Catálogo de Productos
                    </p>

                    <p
                        class="
                            text-xs
                            text-on-surface-variant
                            mt-1
                        "
                    >
                        Pendiente de implementar.
                    </p>

                </div>

            </div>

        </section>



        {{-- ================================================= --}}
        {{-- ESTADO SPRINT Y SESIÓN --}}
        {{-- ================================================= --}}

        <section
            class="
                mt-6
                grid
                grid-cols-1
                xl:grid-cols-2
                gap-5
            "
        >


            {{-- ESTADO SPRINT --}}
            <div
                class="
                    bg-white
                    rounded-xl
                    shadow-sm
                    p-6
                "
            >

                <h2 class="text-xl font-semibold">
                    Estado del Sprint 1
                </h2>

                <p
                    class="
                        text-sm
                        text-on-surface-variant
                        mt-1
                    "
                >
                    Funcionalidades desarrolladas hasta el momento.
                </p>


                <div class="mt-5 space-y-3">


                    @foreach([
                        ['Autenticación de usuarios', true],
                        ['Inicio y cierre de sesión', true],
                        ['Roles de usuario', true],
                        ['Protección de rutas', true],
                        ['Gestión de usuarios', true],
                        ['Catálogo de productos', false]
                    ] as $item)


                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                p-3
                                rounded-lg
                                bg-surface-container-low
                            "
                        >

                            <span class="text-sm">
                                {{ $item[0] }}
                            </span>


                            @if($item[1])

                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        gap-1
                                        text-xs
                                        font-semibold
                                        text-green-700
                                    "
                                >

                                    <span
                                        class="
                                            material-symbols-outlined
                                            text-base
                                        "
                                    >
                                        check_circle
                                    </span>

                                    Implementado

                                </span>

                            @else

                                <span
                                    class="
                                        text-xs
                                        font-semibold
                                        text-outline
                                    "
                                >
                                    Pendiente
                                </span>

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>



            {{-- SESIÓN --}}
            <div
                class="
                    bg-white
                    rounded-xl
                    shadow-sm
                    p-6
                "
            >

                <h2 class="text-xl font-semibold">
                    Mi sesión
                </h2>

                <p
                    class="
                        text-sm
                        text-on-surface-variant
                        mt-1
                    "
                >
                    Información del usuario autenticado.
                </p>


                <div class="mt-5 space-y-4">


                    <div>

                        <p
                            class="
                                text-xs
                                text-outline
                                uppercase
                            "
                        >
                            Usuario
                        </p>

                        <p class="font-semibold mt-1">

                            {{ $usuario->first_name }}
                            {{ $usuario->last_name }}

                        </p>

                    </div>


                    <div>

                        <p
                            class="
                                text-xs
                                text-outline
                                uppercase
                            "
                        >
                            Correo
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $usuario->email }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="
                                text-xs
                                text-outline
                                uppercase
                            "
                        >
                            Rol
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $rol }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="
                                text-xs
                                text-outline
                                uppercase
                            "
                        >
                            Estado
                        </p>

                        @if($usuario->status)

                            <span
                                class="
                                    inline-flex
                                    mt-1
                                    items-center
                                    gap-2
                                    text-green-700
                                    font-semibold
                                "
                            >

                                <span
                                    class="
                                        w-2
                                        h-2
                                        rounded-full
                                        bg-green-600
                                    "
                                ></span>

                                Activo

                            </span>

                        @else

                            <span
                                class="
                                    inline-flex
                                    mt-1
                                    items-center
                                    gap-2
                                    text-red-600
                                    font-semibold
                                "
                            >

                                <span
                                    class="
                                        w-2
                                        h-2
                                        rounded-full
                                        bg-red-600
                                    "
                                ></span>

                                Inactivo

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </section>



        {{-- ================================================= --}}
        {{-- ROADMAP --}}
        {{-- ================================================= --}}

        <div
            class="
                mt-6
                bg-surface-container-high
                rounded-xl
                p-5
                flex
                flex-col
                md:flex-row
                md:items-center
                md:justify-between
                gap-4
            "
        >

            <div class="flex items-center gap-4">

                <div
                    class="
                        w-11
                        h-11
                        bg-white
                        rounded-xl
                        text-primary
                        flex
                        items-center
                        justify-center
                    "
                >

                    <span class="material-symbols-outlined">
                        construction
                    </span>

                </div>


                <div>

                    <p class="font-semibold">
                        Desarrollo progresivo del sistema
                    </p>

                    <p
                        class="
                            text-sm
                            text-on-surface-variant
                        "
                    >
                        Pedidos, inventario, cumplimiento y seguimiento
                        serán implementados en los siguientes Sprints.
                    </p>

                </div>

            </div>


            <span
                class="
                    bg-white
                    text-primary
                    font-semibold
                    text-xs
                    px-3
                    py-2
                    rounded-lg
                    whitespace-nowrap
                "
            >
                SPRINT 1 • EN DESARROLLO
            </span>

        </div>

    </main>

</div>

</body>
</html>