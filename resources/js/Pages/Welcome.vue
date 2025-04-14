<template>
    <div class="min-h-screen overflow-hidden">
        <!-- Hero Section with animated elements -->
        <section
            class="relative bg-slate-800 text-white py-20 px-4 overflow-hidden"
        >
            <!-- Animated floating shapes -->
            <div class="absolute inset-0 overflow-hidden">
                <div
                    class="absolute -top-20 -left-20 w-64 h-64 bg-white rounded-full opacity-20 animate-float-slow"
                ></div>
                <div
                    class="absolute top-40 right-10 w-32 h-32 bg-white rounded-full opacity-20 animate-float-medium"
                ></div>
                <div
                    class="absolute bottom-10 left-1/4 w-48 h-48 bg-white rounded-full opacity-20 animate-float-fast"
                ></div>
            </div>

            <div
                class="container mx-auto max-w-6xl flex flex-col md:flex-row items-center relative z-10"
            >
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                    <h1 class="text-5xl mb-2">
                        Simula tus declaraciones fiscales con
                        <span class="bg-clip-text font-bold">facilidad</span>
                    </h1>
                    <p class="text-base text-muted mb-8">
                        SATy te ayuda a prepararte para tus obligaciones
                        fiscales con simulaciones precisas y actualizadas del
                        SAT.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <Link
                            :href="route('login')"
                            class="bg-slate-900 text-white shadow-xl px-5 py-3 rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105 text-lg font-medium"
                        >
                            Empezar Ahora
                        </Link>
                    </div>
                </div>
                <div
                    class="md:w-1/2 transform transition-all duration-700 hover:scale-105"
                >
                    <div
                        class="relative bg-slate-800 rounded-2xl shadow-xl p-4"
                    >
                        <div class="absolute top-3 left-4 flex gap-1">
                            <div class="h-3 w-3 rounded-full bg-red-500"></div>
                            <div
                                class="h-3 w-3 rounded-full bg-yellow-500"
                            ></div>
                            <div
                                class="h-3 w-3 rounded-full bg-green-500"
                            ></div>
                        </div>
                        <div class="pt-4 rounded-xl overflow-hidden">
                            <div class="bg-slate-800 p-4 rounded-lg">
                                <div class="flex justify-between mb-4">
                                    <h3 class="font-medium">Recibo de Pago</h3>
                                    <span class="text-green-400 font-medium"
                                        >Simulación</span
                                    >
                                </div>
                                <div class="space-y-3">
                                    <div class="bg-slate-700 p-3 rounded">
                                        <div class="flex justify-between">
                                            <span class="text-muted text-sm"
                                                >Nombre Emisor:</span
                                            >
                                            <span class="font-medium text-sm"
                                                >Empresa ABC S.A. de C.V.</span
                                            >
                                        </div>
                                    </div>
                                    <div class="bg-slate-700 p-3 rounded">
                                        <div class="flex justify-between">
                                            <span class="text-muted text-sm"
                                                >Nombre Receptor:</span
                                            >
                                            <span class="font-medium text-sm"
                                                >Juan Pérez</span
                                            >
                                        </div>
                                    </div>
                                    <div class="bg-slate-700 p-3 rounded">
                                        <div class="flex justify-between">
                                            <span class="text-muted text-sm"
                                                >Monto Pagado:</span
                                            >
                                            <span class="font-medium text-sm"
                                                >$12,580.45 MXN</span
                                            >
                                        </div>
                                    </div>
                                    <div class="bg-slate-700 p-3 rounded">
                                        <div class="flex justify-between">
                                            <span class="text-muted text-sm"
                                                >Referencia:</span
                                            >
                                            <span class="font-medium text-sm"
                                                >PAGO-2024-00123</span
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <div
                                        class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-sm"
                                    >
                                        Generar Nuevo Recibo
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wave divider -->
            <div
                class="absolute bottom-0 left-0 w-full overflow-hidden leading-none"
                style="margin: 0; padding: 0"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path
                        fill="#ffffff"
                        fill-opacity="1"
                        d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
                    ></path>
                </svg>
            </div>
        </section>

        <!-- Features Section with cards that animate on hover -->
        <section id="features" class="py-20 px-4 relative bg-white">
            <div class="container mx-auto max-w-6xl">
                <h2
                    class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-4"
                >
                    Características Principales
                </h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
                    Descubre por qué SATy es la herramienta preferida para
                    simulaciones fiscales en México
                </p>

                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-pink-500"
                    >
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-red-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 transform rotate-3"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">
                            Simulación Precisa
                        </h3>
                        <p class="text-gray-600">
                            Nuestros cálculos están siempre actualizados con las
                            últimas normativas fiscales del SAT, garantizando
                            resultados confiables.
                        </p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-blue-500"
                    >
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 transform -rotate-3"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">
                            Datos Seguros
                        </h3>
                        <p class="text-gray-600">
                            Tu información está protegida con los más altos
                            estándares de seguridad y encriptación de nivel
                            bancario.
                        </p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-green-500"
                    >
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 transform rotate-3"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">
                            Reportes Detallados
                        </h3>
                        <p class="text-gray-600">
                            Obtén informes completos y visualizaciones claras de
                            tus simulaciones para tomar mejores decisiones
                            fiscales.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Wave divider -->
            <div
                class="absolute bottom-0 left-0 w-full overflow-hidden leading-none"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120"
                    preserveAspectRatio="none"
                    class="w-full h-16 text-slate-800"
                >
                    <path
                        d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                        class="fill-current"
                    ></path>
                </svg>
            </div>
        </section>

        <!-- CTA Section with animated background -->
        <section class="py-20 px-4 bg-slate-800 relative overflow-hidden">
            <!-- Animated background elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full">
                    <div
                        class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full opacity-10 animate-float-slow"
                    ></div>
                    <div
                        class="absolute top-40 right-20 w-24 h-24 bg-white rounded-full opacity-10 animate-float-medium"
                    ></div>
                    <div
                        class="absolute bottom-20 left-1/3 w-40 h-40 bg-white rounded-full opacity-10 animate-float-fast"
                    ></div>
                    <div
                        class="absolute bottom-40 right-1/4 w-20 h-20 bg-white rounded-full opacity-10 animate-float-medium"
                    ></div>
                </div>
            </div>

            <div class="container mx-auto max-w-4xl text-center relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    ¿Listo para simplificar tus declaraciones fiscales?
                </h2>
                <p class="text-xl text-gray-100 mb-10">
                    Únete a miles de usuarios que ya confían en SimulaTi para
                    sus simulaciones fiscales.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link
                        :href="route('register')"
                        class="bg-green-500 text-black font-bold px-8 py-4 rounded-xl hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105 shadow-lg text-lg"
                    >
                        Comenzar Ahora Gratis
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer with wave top -->
        <footer class="bg-white text-white py-16 px-4 relative">
            <!-- Wave top -->
            <div
                class="absolute -top-5 left-0 w-full overflow-hidden leading-none transform rotate-180"
            >
                <svg
                    id="wave"
                    style="transform: rotate(0deg); transition: 0.3s"
                    viewBox="0 0 1440 180"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <defs>
                        <linearGradient
                            id="sw-gradient-0"
                            x1="0"
                            x2="0"
                            y1="1"
                            y2="0"
                        >
                            <stop stop-color="#1e293b" offset="0%"></stop>
                            <stop stop-color="#1e293b" offset="100%"></stop>
                        </linearGradient>
                    </defs>
                    <path
                        style="transform: translate(0, 0px); opacity: 1"
                        fill="url(#sw-gradient-0)"
                        d="M0,144L13.3,144C26.7,144,53,144,80,141C106.7,138,133,132,160,123C186.7,114,213,102,240,87C266.7,72,293,54,320,54C346.7,54,373,72,400,72C426.7,72,453,54,480,57C506.7,60,533,84,560,96C586.7,108,613,108,640,108C666.7,108,693,108,720,105C746.7,102,773,96,800,87C826.7,78,853,66,880,75C906.7,84,933,114,960,129C986.7,144,1013,144,1040,123C1066.7,102,1093,60,1120,45C1146.7,30,1173,42,1200,48C1226.7,54,1253,54,1280,72C1306.7,90,1333,126,1360,141C1386.7,156,1413,150,1440,147C1466.7,144,1493,144,1520,126C1546.7,108,1573,72,1600,54C1626.7,36,1653,36,1680,48C1706.7,60,1733,84,1760,87C1786.7,90,1813,72,1840,75C1866.7,78,1893,102,1907,114L1920,126L1920,180L1906.7,180C1893.3,180,1867,180,1840,180C1813.3,180,1787,180,1760,180C1733.3,180,1707,180,1680,180C1653.3,180,1627,180,1600,180C1573.3,180,1547,180,1520,180C1493.3,180,1467,180,1440,180C1413.3,180,1387,180,1360,180C1333.3,180,1307,180,1280,180C1253.3,180,1227,180,1200,180C1173.3,180,1147,180,1120,180C1093.3,180,1067,180,1040,180C1013.3,180,987,180,960,180C933.3,180,907,180,880,180C853.3,180,827,180,800,180C773.3,180,747,180,720,180C693.3,180,667,180,640,180C613.3,180,587,180,560,180C533.3,180,507,180,480,180C453.3,180,427,180,400,180C373.3,180,347,180,320,180C293.3,180,267,180,240,180C213.3,180,187,180,160,180C133.3,180,107,180,80,180C53.3,180,27,180,13,180L0,180Z"
                    ></path>
                </svg>
            </div>

            <div class="container mx-auto max-w-6xl relative mt-32">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-2xl mb-6 text-green-600 font-extrabold">SimulaTi</h3>
                        <p class="text-black">
                            La mejor plataforma para simular tus declaraciones
                            fiscales y estar preparado para el SAT.
                        </p>
                        <div class="flex space-x-4 mt-6">
                            <a
                                href="#"
                                class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-indigo-600 transition-colors"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"
                                    ></path>
                                </svg>
                            </a>
                            <a
                                href="#"
                                class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-indigo-600 transition-colors"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"
                                    ></path>
                                </svg>
                            </a>
                            <a
                                href="#"
                                class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-indigo-600 transition-colors"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-6">Enlaces</h4>
                        <ul class="space-y-3">
                            <li>
                                <a
                                    href="#"
                                    class="text-black hover:text-green-500 transition-colors hover:translate-x-1 inline-block transform"
                                    >Inicio</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#features"
                                    class="text-black hover:text-green-500 transition-colors hover:translate-x-1 inline-block transform"
                                    >Características</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#how-it-works"
                                    class="text-black hover:text-green-500 transition-colors hover:translate-x-1 inline-block transform"
                                    >Cómo Funciona</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#testimonials"
                                    class="text-black hover:text-green-500 transition-colors hover:translate-x-1 inline-block transform"
                                    >Testimonios</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-6">Legal</h4>
                        <ul class="space-y-3">
                            <li>
                                <a
                                    href="#"
                                    class="text-black hover:text-green-500 transition-colors hover:translate-x-1 inline-block transform"
                                    >Términos de Servicio</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-black hover:text-green-500 transition-colors hover:translate-x-1 inline-block transform"
                                    >Política de Privacidad</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-black hover:text-green-500 transition-colors hover:translate-x-1 inline-block transform"
                                    >Aviso Legal</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-6">Contacto</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center text-black">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2 text-indigo-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                                info@simulati.com
                            </li>
                            <li class="flex items-center text-black">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2 text-indigo-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                    />
                                </svg>
                                +52 55 1234 5678
                            </li>
                            <li class="flex items-center text-black">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2 text-indigo-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                                Ciudad de México, México
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    class="border-t border-gray-800 mt-12 pt-8 text-center text-black"
                >
                    <p>
                        © {{ new Date().getFullYear() }} SimulaTi. Todos los
                        derechos reservados.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<style>
/* Animations */
@keyframes float-slow {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-20px);
    }
}

@keyframes float-medium {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-15px);
    }
}

@keyframes float-fast {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

.animate-float-slow {
    animation: float-slow 8s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 6s ease-in-out infinite;
}

.animate-float-fast {
    animation: float-fast 4s ease-in-out infinite;
}
</style>
