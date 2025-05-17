<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- SEO Metatags principales -->
        <title>Simulador SAT - Plataforma de práctica para declaraciones fiscales | {{ config('app.name', 'Boxter') }}</title>
        <meta name="description" content="Aprende a presentar declaraciones fiscales con nuestro simulador del SAT. Plataforma interactiva con ejemplos reales para dominar trámites tributarios en México.">
        <meta name="author" content="Boxter">
        <meta name="keywords" content="Simulador SAT, Declaraciones fiscales, Plataforma tributaria, Trámites SAT, Impuestos México, Simulación fiscal, Boxter, Ejemplos reales SAT">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="Simulador SAT - Práctica interactiva para declaraciones fiscales">
        <meta property="og:description" content="Aprende a presentar declaraciones fiscales con nuestro simulador del SAT. Plataforma interactiva con ejemplos reales.">
        <meta property="og:image" content="{{ asset('storage/img/icon.svg') }}">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url('/') }}">
        <meta name="twitter:title" content="Simulador SAT - Práctica interactiva para declaraciones fiscales">
        <meta name="twitter:description" content="Aprende a presentar declaraciones fiscales con nuestro simulador del SAT. Plataforma con ejemplos reales.">
        <meta name="twitter:image" content="{{ asset('storage/img/icon.svg') }}">
        
        <!-- Favicon y logos para SERP -->
        <link rel="icon" href="{{ asset('storage/img/icon.svg') }}" type="image/svg+xml">
        <link rel="apple-touch-icon" href="{{ asset('storage/img/icon.svg') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/img/icon.svg') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/img/icon.svg') }}">
        
        <!-- Structured Data / JSON-LD -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Simulador SAT - Boxter",
            "url": "{{ url('/') }}",
            "description": "Plataforma de simulación interactiva para aprender a realizar trámites y declaraciones fiscales en el SAT con ejemplos reales.",
            "applicationCategory": "Educación",
            "operatingSystem": "Web",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "MXN"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Boxter",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('storage/img/icon.svg') }}"
                }
            }
        }
        </script>
        
        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">

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