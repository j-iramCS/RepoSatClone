<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>OnLaBox - Simula, Aprende y Practica</title>
    <meta name="description" content="Simulación interactiva para aprender con ejemplos reales del SAT.">
    Aprende Laravel Interactivamente
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
