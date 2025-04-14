<template>
    <Main>
        <div class="container">
            <div class="pb-6 border-b mb-7 border-slate-700 mt-2">
                <h1 class="text-4xl font-extrabold text-white">
                    Bienvenido de Nuevo, Iram
                </h1>
                <p class="text-gray-300">
                    Aquí tienes una descripción general rápida de las
                    actividades de tu cuenta
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-white">
                <!-- Crear Ejercicios -->
                <div
                    className="group relative overflow-hidden bg-gradient-to-br from-blue-600 to-purple-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div
                        className="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"
                    ></div>
                    <div
                        className="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"
                    ></div>

                    <div className="flex items-start space-x-4">
                        <div className="p-3 bg-white bg-opacity-20 rounded-lg">
                        </div>
                        <div className="flex-1">
                            <h3 className="text-xl font-bold mb-2">
                                Crear Ejercicios
                            </h3>
                            <p className="text-white text-opacity-80 mb-4">
                                Crea ejercicios personalizados y compártelos con
                                toda la comunidad o con tu grupo de estudio.
                            </p>

                            <div className="flex justify-between items-center">
                                <Link
                                    :href="route('general.create')"
                                    className="px-4 py-2 bg-white text-blue-600 font-medium rounded-lg hover:bg-opacity-90 transition-colors"
                                >
                                    Comenzar a Crear
                                </Link>
                                <span className="text-white text-opacity-70"
                                    >✦ Gratis</span
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ejercicios de la Comunidad -->
                <div
                    className="group relative overflow-hidden bg-gradient-to-br from-green-500 to-teal-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div
                        className="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"
                    ></div>
                    <div
                        className="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"
                    ></div>

                    <div className="flex items-start space-x-4">
                        <div className="p-3 bg-white bg-opacity-20 rounded-lg">
                        </div>
                        <div className="flex-1">
                            <h3 className="text-xl font-bold mb-2">
                                Ejercicios de la Comunidad
                            </h3>
                            <p className="text-white text-opacity-80 mb-4">
                                Explora ejercicios creados por otros usuarios.
                                Practica con retos reales, variados y hechos por
                                personas como tú. ¡Siempre hay algo nuevo que
                                resolver!
                            </p>

                            <div className="flex justify-between items-center">
                                <button
                                    className="px-4 py-2 bg-white text-green-600 font-medium rounded-lg hover:bg-opacity-90 transition-colors"
                                >
                                    Comenzar a Practicar
                                </button>
                                <span
                                    className="bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs font-medium"
                                    >3 Nuevos Agregados</span
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mis Creaciones -->
                <div
                    className="group relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 md:col-span-2"
                >
                    <div
                        className="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"
                    ></div>
                    <div
                        className="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"
                    ></div>
                    <div
                        className="absolute top-0 left-1/2 w-20 h-20 bg-white opacity-10 rounded-full -mt-10"
                    ></div>

                    <div className="flex items-start space-x-4">
                        <div className="p-3 bg-white bg-opacity-20 rounded-lg">
                        </div>
                        <div className="flex-1">
                            <h3 className="text-xl font-bold mb-2">
                                Mis Creaciones
                            </h3>
                            <p className="text-white text-opacity-80 mb-4">
                                ¡Revisa, edita o elimina los ejercicios que has
                                creado. Consulta cuántas veces los han resuelto
                                otros!
                            </p>

                            <div
                                className="flex flex-wrap justify-between items-center gap-4"
                            >
                                <Link
                                    :href="route('general.create')"
                                    className="px-4 py-2 bg-white text-orange-600 font-medium rounded-lg hover:bg-opacity-90 transition-colors"
                                >
                                    Ver mis ejercicios
                                </Link>
                                <div className="flex space-x-2">
                                    <span
                                        className="px-3 py-1 bg-white bg-opacity-20 rounded-lg text-sm flex justify-center items-center gap-2"
                                    >
                                        <Icon
                                            icon="hugeicons:delivery-box-01"
                                            class="text-lg"
                                        />
                                        <span>3 Creaciones</span>
                                    </span>
                                    <span
                                        className="px-3 py-1 bg-white bg-opacity-20 rounded-lg text-sm flex gap-2 justify-center items-center"
                                    >
                                        <Icon
                                            icon="hugeicons:favourite"
                                            class="text-lg"
                                        />
                                        <span>15</span>
                                    </span>
                                </div>
                            </div>
                        </div>
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

// Componentes
import Main from "@/Layouts/Main.vue";

// Variables

// Functions
</script>

<style></style>
