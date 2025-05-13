<template>
    <Main>
        <div class="container mx-auto">
            <!-- Encabezado y Estadísticas Rápidas -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 ">
                <div>
                    <div class="flex items-center mb-4 gap-4">
                        <div
                            class="bg-blue-500 dark:bg-gray-900 bg-opacity-20 w-12 h-12 rounded-lg flex items-center justify-center">
                            <Icon icon="mingcute:home-3-fill" class="text-3xl text-blue-600 dark:text-gray-300" />
                        </div>
                        <h1 class="text-3xl font-bold dark:text-gray-300">Bienvenido {{ props.username }} </h1>
                    </div>
                    <p class="text-gray-600">Resumen de actividad y recursos disponibles</p>
                </div>
            </div>

            <!-- Tarjetas principales -->
            <div class="grid grid-cols-2  md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <!-- Crear Actividad -->
                <div
                    class="text-xs md:text-base group relative overflow-hidden bg-gradient-to-br from-red-500 to-red-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                    </div>

                    <div class="flex flex-col h-full">
                        <div
                            class="bg-white bg-opacity-20 w-8 h-8 md:w-12 md:h-12 rounded-lg flex items-center justify-center">
                            <Icon icon="mdi:pencil-plus" class="text-white text-lg  md:text-2xl" />
                        </div>

                        <h3 class="text-lg md:text-xl font-bold mb-2 text-white">Crear Actividad</h3>
                        <p class="text-white text-opacity-80 mb-4 flex-grow">
                            Diseña actividades personalizadas y compártelas con toda la comunidad o con tu grupo de
                            estudio.
                        </p>

                        <div class="flex justify-between items-center flex-wrap gap-">
                            <Link :href="route('index.crear.actividad')"
                                class="px-4 py-2 bg-white text-red-600 font-medium rounded-md flex items-center active:scale-90 transition-transform duration-100">
                            <span class="font-bold">Comenzar</span>
                            <Icon icon="mdi:arrow-right" class="ml-1" />
                            </Link>
                            <!-- <span class="text-white text-opacity-70 flex items-center">
                                <Icon icon="mdi:star" class="mr-1" />
                                Gratis
                            </span> -->
                        </div>
                    </div>
                </div>

                <!-- Crear Ejercicios -->
                <div
                    class="text-xs md:text-base group relative overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                    </div>

                    <div class="flex flex-col h-full">
                        <div
                            class="bg-white bg-opacity-20 w-8 h-8 md:w-12 md:h-12 rounded-lg flex items-center justify-center">
                            <Icon icon="mdi:pencil-plus" class="text-white text-lg  md:text-2xl" />
                        </div>

                        <h3 class="text-lg md:text-xl font-bold mb-2 text-white">Crear Ejercicios</h3>
                        <p class="text-white text-opacity-80 mb-4 flex-grow">
                            Diseña ejercicios personalizados y usalos en todas tus actividades.
                        </p>

                        <div class="flex justify-between items-center flex-wrap gap-">
                            <Link :href="route('index.crear.ejercicio')"
                                class="px-4 py-2 bg-white text-blue-600 font-medium rounded-md flex items-center active:scale-90 transition-transform duration-100">
                            <span>Crear</span>
                            <Icon icon="mdi:arrow-right" class="ml-1" />
                            </Link>
                            <!-- <span class="text-white text-opacity-70 flex items-center">
                                <Icon icon="mdi:star" class="mr-1" />
                                Gratis
                            </span> -->
                        </div>
                    </div>
                </div>

                <!-- Ejercicios de la Comunidad -->
                <div
                    class="text-xs md:text-base group relative overflow-hidden bg-gradient-to-br from-emerald-500 to-teal-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                    </div>

                    <div class="flex flex-col h-full">
                        <div
                            class="bg-white bg-opacity-20 w-8 h-8 md:w-12 md:h-12 rounded-lg flex items-center justify-center">
                            <Icon icon="mdi:pencil-plus" class="text-white text-lg  md:text-2xl" />
                        </div>

                        <h3 class="text-lg md:text-xl font-bold mb-2 text-white">Ejercicios de la Comunidad</h3>
                        <p class="text-white text-opacity-80 mb-4 flex-grow">
                            Explora ejercicios creados por otros usuarios. Practica con retos reales y variados.
                        </p>

                        <div class="flex justify-between items-center flex-wrap gap-">
                            <Link :href="route('vistaA')"
                                class="px-4 py-2 bg-white text-green-600 font-medium rounded-md flex items-center active:scale-90 transition-transform duration-100">
                            <span>Explorar</span>
                            <Icon icon="mdi:arrow-right" class="ml-1" />
                            </Link>
                            <!-- <span class="text-white text-opacity-70 flex items-center">
                                <Icon icon="mdi:star" class="mr-1" />
                                Gratis
                            </span> -->
                        </div>
                    </div>
                </div>

                <!-- Favoritos -->
                <div
                    class="text-xs md:text-base group relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                    </div>

                    <div class="flex flex-col h-full">
                        <div
                            class="bg-white bg-opacity-20 w-8 h-8 md:w-12 md:h-12 rounded-lg flex items-center justify-center">
                            <Icon icon="mdi:heart" class="text-white text-lg  md:text-2xl" />
                        </div>

                        <h3 class="text-lg md:text-xl font-bold mb-2 text-white">Mis Favoritos</h3>
                        <p class="text-white text-opacity-80 mb-4 flex-grow">
                            Acceso rápido a los ejercicios que has marcado como favoritos para practicar después.
                        </p>

                        <div class="flex justify-between items-center flex-wrap gap-">
                            <button
                                class="px-4 py-2 bg-white text-purple-600 font-medium rounded-md flex items-center active:scale-90 transition-transform duration-100">
                                <span>Ver favoritos</span>
                                <Icon icon="mdi:arrow-right" class="ml-1" />
                            </button>
                            <!-- <span
                                class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs font-medium text-white">12
                                guardados</span> -->
                        </div>
                    </div>
                </div>

                <div
                    class="col-span-2 text-xs md:text-base group relative overflow-hidden bg-gradient-to-br from-amber-500 to-amber-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                    </div>

                    <div class="flex flex-col">
                        <div class="flex items-center mb-4">
                            <div
                                class="bg-white bg-opacity-20 w-8 h-8 md:w-12 md:h-12 rounded-lg flex items-center justify-center">
                                <Icon icon="mdi:folder-multiple" class="text-white text-lg  md:text-2xl" />
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg md:text-xl font-bold mb-2 text-white">Mis Actividades Creadas</h3>
                                <div class="flex space-x-2 mt-1">
                                    <span
                                        class="px-2 py-1 bg-white bg-opacity-20 rounded-lg text-sm text-white flex items-center">
                                        <Icon icon="mdi:package-variant" class="mr-1" />
                                        <span class="text-xs md:text-base">3 Ejercicios</span>
                                    </span>
                                    <span
                                        class="px-2 py-1 bg-white bg-opacity-20 rounded-lg text-sm text-white flex items-center">
                                        <Icon icon="mdi:thumb-up" class="mr-1" />
                                        <span class="text-xs md:text-base">15 Me gusta</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Mini lista de ejercicios creados -->
                        <div class="bg-white bg-opacity-10 rounded-lg p-4 mb-4">
                            <ul class="space-y-2">
                                <li v-for="index in 3" :key="index"
                                    class="flex justify-between items-center p-2 hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white font-medium">
                                            {{ index }}
                                        </div>
                                        <span class="ml-3 text-white">Ejercicio de ejemplo #{{ index }}</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-1 text-white opacity-70 hover:opacity-100 transition-opacity">
                                            <Icon icon="mdi:pencil" class="text-lg" />
                                        </button>
                                        <button class="p-1 text-white opacity-70 hover:opacity-100 transition-opacity">
                                            <Icon icon="mdi:eye" class="text-lg" />
                                        </button>
                                        <button class="p-1 text-white opacity-70 hover:opacity-100 transition-opacity">
                                            <Icon icon="mdi:delete" class="text-lg" />
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-between items-center">
                            <Link :href="route('index.user.ejercicios')"
                                class="px-4 py-2 bg-white text-orange-600 font-medium rounded-lg hover:bg-opacity-90 transition-colors flex items-center">
                            <span>Ver todos</span>
                            <Icon icon="mdi:arrow-right" class="ml-1" />
                            </Link>

                            <button
                                class="px-4 py-2 bg-white text-orange-600 font-medium rounded-md flex items-center active:scale-90 transition-transform duration-100">
                                <Icon icon="mdi:plus" class="mr-1" />
                                <span>Nuevo ejercicio</span>
                            </button>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Segunda fila de contenido -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Mis Creaciones -->



                <!-- Panel de Progreso y Actividad Reciente -->
                <div class="bg-white rounded-xl shadow-lg p-5 space-y-6 hidden">
                    <!-- Progreso -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tu progreso</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gray-600">Ejercicios completados</span>
                                    <span class="text-sm font-medium text-blue-600">24/50</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 48%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gray-600">Ejercicios creados</span>
                                    <span class="text-sm font-medium text-green-600">3/10</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 30%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gray-600">Nivel de experiencia</span>
                                    <span class="text-sm font-medium text-purple-600">Intermedio</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actividad Reciente -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Actividad reciente</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <Icon icon="mdi:check" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-800">Completaste el ejercicio "Lógica booleana avanzada"
                                    </p>
                                    <p class="text-xs text-gray-500">Hace 2 horas</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                                    <Icon icon="mdi:thumb-up" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-800">Tu ejercicio recibió 3 me gusta</p>
                                    <p class="text-xs text-gray-500">Ayer</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 flex-shrink-0">
                                    <Icon icon="mdi:star" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-800">¡Subiste de nivel! Ahora eres Intermedio</p>
                                    <p class="text-xs text-gray-500">Hace 2 días</p>
                                </div>
                            </div>
                        </div>

                        <button
                            class="w-full mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                            Ver todo el historial
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sección de recursos y herramientas -->
            <div class="mt-8 hidden">
                <h2 class="text-xl font-bold text-gray-800 mb-4 dark:text-white">Recursos y herramientas</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div
                        class="bg-blue-50 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-blue-100 transition-colors cursor-pointer">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-3">
                            <Icon icon="mdi:book-open-page-variant" class="text-2xl" />
                        </div>
                        <h3 class="font-medium text-gray-800">Tutoriales</h3>
                        <p class="text-sm text-gray-600 mt-1">Guías paso a paso</p>
                    </div>

                    <div
                        class="bg-green-50 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-green-100 transition-colors cursor-pointer">
                        <div
                            class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3">
                            <Icon icon="mdi:chart-bar" class="text-2xl" />
                        </div>
                        <h3 class="font-medium text-gray-800">Estadísticas</h3>
                        <p class="text-sm text-gray-600 mt-1">Tu rendimiento</p>
                    </div>

                    <div
                        class="bg-purple-50 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-purple-100 transition-colors cursor-pointer">
                        <div
                            class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-3">
                            <Icon icon="mdi:account-group" class="text-2xl" />
                        </div>
                        <h3 class="font-medium text-gray-800">Grupos</h3>
                        <p class="text-sm text-gray-600 mt-1">Estudia en equipo</p>
                    </div>

                    <div
                        class="bg-amber-50 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-amber-100 transition-colors cursor-pointer">
                        <div
                            class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 mb-3">
                            <Icon icon="mdi:help-circle" class="text-2xl" />
                        </div>
                        <h3 class="font-medium text-gray-800">Ayuda</h3>
                        <p class="text-sm text-gray-600 mt-1">Centro de soporte</p>
                    </div>
                </div>
            </div>
        </div>
    </Main>
</template>

<script setup lang="ts">
// Composables
import { Icon } from "@iconify/vue/dist/iconify.js";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

// Componentes
import Main from "@/Layouts/Main.vue";

// Variables
const recentExercises = ref([]);
const userProgress = ref({
    exercisesCompleted: 24,
    exercisesCreated: 3,
    level: "Intermedio"
});

const props = defineProps({
    username: {
        type: String,
    },
});

// Functions
onMounted(() => {
    // Aquí podrías cargar datos dinámicos de tu backend
    //   console.log("Dashboard montado");
});
</script>

<style>
/* Animaciones adicionales se pueden agregar aquí */
@keyframes pulseGlow {
    0% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5);
    }

    70% {
        box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
    }
}
</style>