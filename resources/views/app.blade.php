<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Simulación interactiva para aprender Laravel con ejemplos reales.">
        <meta name="author" content="Boxter">
        <meta name="keywords" content="Laravel, Boxter, Simulación, Interactiva, Ejemplos, Reales">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
         <!-- Favicon -->
        <link rel="icon" href="{{ asset('storage/img/icon.svg') }}" type="image/svg+xml">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
