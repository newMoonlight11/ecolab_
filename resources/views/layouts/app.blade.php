<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ECOLAB</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="{{ asset('images/main_icon.png') }}?v=1.0" type="image/png">
    <link rel="icon" href="{{ asset('images/main_icon.svg') }}?v=1.0" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/main_icon.png') }}?v=1.0">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    /* Estilo del botón */
    .dropbtn {
        background-color: #ffffff;
        color: black;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* Contenedor del dropdown */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Estilo del contenido del dropdown (links) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Links dentro del dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Cambia el color al pasar el mouse sobre los links */
    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    /* Mostrar el dropdown cuando se hace hover en el botón */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Cambia el color del botón al hacer hover */
    .dropdown:hover .dropbtn {
        background-color: #f1f1f1;
    }
</style>

<body>
    <div>
        @include('layouts.navbar')
        <br>
        <main class="py-4 bg-bground">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBogGz8FLxIMs3Hs5e1e5KDeSlPYiFturGFpW9QkGk60KVp+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76A7a2E+rLqh2BO6RQ1MRhX1G8KL4emKpcFMNcCgEZylHX1jIQ9b8UK/41gQf2" crossorigin="anonymous"></script>
</body>

</html>
