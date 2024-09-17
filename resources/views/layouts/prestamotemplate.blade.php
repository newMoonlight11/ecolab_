<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ECOLAB</title>
    <link rel="stylesheet" href="css/prestamos.css">
    <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
    @vite(['resources/sass/app.scss'])
</head>
<body>
    @include('layouts.navbar')
    @yield('content')

    <script src="{{ asset('js/prestamos.js') }}"></script>
</body>
</html>