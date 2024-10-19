<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ECOLAB</title>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="images/favicon.svg" type="image/svg+xml">

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
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
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
    <div >


        @include('layouts.navbar')
        <main class="py-4 bg-bground">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
