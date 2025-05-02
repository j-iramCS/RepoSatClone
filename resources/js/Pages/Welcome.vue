<template>
    <section
        class="min-h-screen bg-gradient-to-br from-[#050714] to-[#050714] text-white overflow-hidden relative flex items-center justify-center px-4">
        <!-- Partículas de fondo -->
        <div class="absolute inset-0 overflow-hidden">
            <div v-for="i in 30" :key="i" class="absolute rounded-full bg-blue-500 opacity-10" :style="{
                width: `${Math.random() * 10 + 2}px`,
                height: `${Math.random() * 10 + 2}px`,
                top: `${Math.random() * 100}%`,
                left: `${Math.random() * 100}%`,
                animation: `float ${Math.random() * 10 + 10}s linear infinite`,
                animationDelay: `${Math.random() * 5}s`
            }"></div>
        </div>
        
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <!-- Título con animación -->
            <div class="overflow-hidden">
                <h1 class="text-5xl sm:text-7xl md:text-8xl font-bold leading-tight mb-6 flex flex-col">
                    <span class="inline-block opacity-0 animate-fadeInUp delay-100">SIMULA</span>
                    <span
                        class="inline-block text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 opacity-0 animate-fadeInUp delay-300">APRENDE</span>
                    <span class="inline-block opacity-0 animate-fadeInUp delay-500">PRACTICA</span>
                </h1>
            </div>

            <!-- Texto descriptivo -->
            <div class="max-w-2xl mx-auto">
                <p class="text-xl md:text-2xl text-gray-300 opacity-0 animate-fadeIn delay-700">
                    Lleva tus <span
                        class="font-medium text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">habilidades</span>
                    al siguiente nivel con
                    <span
                        class="font-medium text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-pink-400">simulación
                        interactiva</span> y
                    <span class="font-semibold text-white">ejercicios prácticos</span> en entornos realistas.
                </p>

                <p class="mt-4 text-lg text-gray-400 opacity-0 animate-fadeIn delay-900">
                    Domina conceptos complejos mediante escenarios inmersivos — sin configuraciones complicadas, solo
                    aprendizaje efectivo.
                </p>
            </div>

            <!-- CTA con hover effect -->
            <div class="mt-12 opacity-0 animate-fadeInUp delay-1100">
                <Link :href="route('login')"
                    class="relative bg inline-flex items-center justify-center px-8 py-4 overflow-hidden font-bold text-white rounded-xl group bg-[#141624]">
                <!-- <span class="absolute inset-0 w-full h-full transition-all duration-300 ease-out bg-gradient-to-r from-indigo-600 to-indigo-600 group-hover:from-indigo-700 group-hover:to-indigo-700"></span> -->
                <span class="relative flex items-center gap-2">
                    <span>Empezar</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>
                </Link>
            </div>

            <!-- Elementos decorativos -->
            <!-- <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-blue-500 rounded-full filter blur-[80px] opacity-20"></div> -->
            <!-- <div class="absolute -top-20 -right-20 w-60 h-60 bg-purple-500 rounded-full filter blur-[100px] opacity-15"></div> -->
        </div>
    </section>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<style>
@keyframes float {
    0% {
        transform: translateY(0) translateX(0);
    }

    50% {
        transform: translateY(-20px) translateX(10px);
    }

    100% {
        transform: translateY(0) translateX(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.8s forwards;
}

.animate-fadeIn {
    animation: fadeIn 1s forwards;
}

.delay-100 {
    animation-delay: 0.1s;
}

.delay-300 {
    animation-delay: 0.3s;
}

.delay-500 {
    animation-delay: 0.5s;
}

.delay-700 {
    animation-delay: 0.7s;
}

.delay-900 {
    animation-delay: 0.9s;
}

.delay-1100 {
    animation-delay: 1.1s;
}
</style>