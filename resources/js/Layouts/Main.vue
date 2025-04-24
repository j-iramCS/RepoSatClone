<template>
    <div class="min-h-screen overflow-hidden">
        <!-- Contenedor principal con gradiente de fondo -->
        <div
            class="dark:bg-[#111527] bg-[#f5f6fa] relative transition-colors">
            <!-- Elementos decorativos animados con pointer-events-none -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <!-- Círculos decorativos animados -->
                <div
                    class="absolute top-10 left-10 w-64 h-64 bg-green-500 rounded-full animate-pulse-slow">
                </div>
                <div
                    class="absolute top-40 right-20 w-96 h-96 bg-indigo-500 rounded-full animate-pulse-medium">
                </div>
                <div
                    class="absolute bottom-20 left-1/3 w-72 h-72 bg-purple-500 rounded-full animate-pulse-fast">
                </div>

                <!-- Partículas flotantes -->
                <div class="particles">
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                    <span class="particle bg-black dark:bg-white"></span>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="flex relative z-10">
                <Aside :isOpen="isSidebarOpen" @close="closeSidebar" @toggleSidebar="toggleSidebar" />

                <!-- Main content area -->
                <main class="py-16 container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-6xl mx-auto mt-6">
                        <slot></slot>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import Aside from "@/Components/Aside.vue";
import { ref } from "vue";

const isSidebarOpen = ref(false);
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
const closeSidebar = () => {
    isSidebarOpen.value = false;
};
</script>

<style scoped>
/* Animaciones de pulso para los círculos grandes de fondo */
@keyframes pulse-slow {

    0%,
    100% {
        transform: scale(1);
        opacity: 0.05;
    }

    50% {
        transform: scale(1.05);
        opacity: 0.1;
    }
}

@keyframes pulse-medium {

    0%,
    100% {
        transform: scale(1);
        opacity: 0.05;
    }

    50% {
        transform: scale(1.1);
        opacity: 0.1;
    }
}

@keyframes pulse-fast {

    0%,
    100% {
        transform: scale(1);
        opacity: 0.05;
    }

    50% {
        transform: scale(1.15);
        opacity: 0.1;
    }
}

.animate-pulse-slow {
    animation: pulse-slow 10s ease-in-out infinite;
}

.animate-pulse-medium {
    animation: pulse-medium 8s ease-in-out infinite;
}

.animate-pulse-fast {
    animation: pulse-fast 6s ease-in-out infinite;
}

/* Patrón de fondo para el panel izquierdo */
.bg-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

/* Animación de partículas flotantes */
.particles {
    position: absolute;
    width: 100%;
    height: 100%;
}

.particle {
    position: absolute;
    width: 6px;
    height: 6px;
    /* background-color: ; */
    border-radius: 50%;
    opacity: 0.2;
}

.particle:nth-child(1) {
    top: 10%;
    left: 20%;
    animation: float 15s linear infinite;
}

.particle:nth-child(2) {
    top: 20%;
    left: 80%;
    animation: float 25s linear infinite;
}

.particle:nth-child(3) {
    top: 50%;
    left: 50%;
    animation: float 20s linear infinite;
}

.particle:nth-child(4) {
    top: 70%;
    left: 30%;
    animation: float 18s linear infinite;
}

.particle:nth-child(5) {
    top: 30%;
    left: 90%;
    animation: float 22s linear infinite;
}

.particle:nth-child(6) {
    top: 90%;
    left: 40%;
    animation: float 19s linear infinite;
}

.particle:nth-child(7) {
    top: 40%;
    left: 10%;
    animation: float 26s linear infinite;
}

.particle:nth-child(8) {
    top: 80%;
    left: 70%;
    animation: float 21s linear infinite;
}

.particle:nth-child(9) {
    top: 60%;
    left: 60%;
    animation: float 24s linear infinite;
}

.particle:nth-child(10) {
    top: 15%;
    left: 45%;
    animation: float 17s linear infinite;
}

.particle:nth-child(11) {
    top: 55%;
    left: 15%;
    animation: float 23s linear infinite;
}

.particle:nth-child(12) {
    top: 75%;
    left: 85%;
    animation: float 16s linear infinite;
}

@keyframes float {
    0% {
        transform: translateY(0) translateX(0);
    }

    25% {
        transform: translateY(-20px) translateX(10px);
    }

    50% {
        transform: translateY(0) translateX(20px);
    }

    75% {
        transform: translateY(20px) translateX(10px);
    }

    100% {
        transform: translateY(0) translateX(0);
    }
}
</style>