<template>
    <Main>
        <div class="max-w-4xl mx-auto mb-10 text-center relative px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-indigo-600 mb-4">¡Comencemos a definir que tipo de <span
                    class="px-2 py-1 mr-2 rounded-lg bg-blue-500 text-white">Ejercicio</span> quieres realizar!</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-indigo-300 to-indigo-600 mx-auto mb-4 rounded-full"></div>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">
                Aquí puedes diseñar ejercicios personalizados relacionados con el SAT. Son ideales para reforzar tus
                conocimientos o evaluar a tu grupo de estudio. Puedes compartirlos con la comunidad o usarlos para crear
                Actividades basadas en ellos.
            </p>
        </div>

        <!-- Contenedor principal de tarjetas -->
        <div class="flex flex-wrap gap-6 justify-center text-white mt-6">
            <!-- 1. Trámite -->
            <ModalFiscal title="Selecciona un trámite o servicio fiscal" :data="tramites_servicios"
                v-model="tramiteSeleccionado" @select-tramite="onTramiteSelected">
                <template #button-open="{ selectedDato: selectedTramite }">
                    <!-- Solo mostrar una tarjeta: la seleccionada o el botón de añadir -->
                    <div v-if="selectedTramite"
                        class="h-80 w-64 group relative overflow-hidden bg-gradient-to-br from-indigo-500 to-indigo-700 dark:from-indigo-700 dark:to-indigo-900 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Contenido de la tarjeta seleccionada -->
                        <div
                            class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-indigo-300 opacity-5 dark:opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                        </div>

                        <button @click.stop="quitarSeleccionTramite"
                            class="absolute top-3 right-3 bg-red-500 dark:bg-red-600 text-white rounded-full p-1.5 hover:bg-red-600 dark:hover:bg-red-700 transition-all duration-200 z-10 hover:rotate-90 transform">
                            <Icon icon="material-symbols:close" class="text-lg" />
                        </button>

                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <Icon icon="solar:file-text-bold" class="text-white text-3xl" />
                            </div>
                        </div>

                        <div class="flex justify-center items-center w-full relative z-0">
                            <div>
                                <h3 class="font-semibold text-white text-xl mb-3 text-center">
                                    {{ selectedTramite.titulo }}
                                </h3>
                                <div class="h-0.5 w-12 bg-white/30 mx-auto mb-3"></div>
                                <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                    {{ selectedTramite.descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else
                        class="relative h-80 w-64 border-3 border-dashed rounded-2xl bg-white/5 dark:bg-indigo-900/10 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-4 p-6 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/20 transform hover:-translate-y-1 shadow-sm hover:shadow-lg">
                        <div
                            class="w-20 h-20 bg-indigo-100 dark:bg-indigo-800/30 rounded-full flex items-center justify-center mb-2">
                            <Icon icon="hugeicons:add-01" class="text-5xl text-indigo-500 dark:text-indigo-300" />
                        </div>
                        <h3 class="font-medium text-indigo-600 dark:text-indigo-300 text-lg">Trámite Fiscal</h3>
                        <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                            Selecciona un trámite o servicio fiscal.
                        </p>
                    </div>
                </template>
            </ModalFiscal>

            <!-- 2. Declaración (solo se muestra si hay un trámite seleccionado) -->
            <template v-if="tramiteSeleccionado && tramiteSeleccionado !== null">
                <ModalFiscal title="Selecciona un tipo de declaración" :data="declaraciones"
                    v-model="declaracionSeleccionado" @select-tramite="onDeclaracionSelected">
                    <template #button-open="{ selectedDato: selectedDeclaracion }">
                        <div v-if="selectedDeclaracion"
                            class="h-80 w-64 group relative overflow-hidden bg-gradient-to-br from-indigo-500 to-indigo-700 dark:from-indigo-700 dark:to-indigo-900 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Contenido de la declaración seleccionada -->
                            <div
                                class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                            </div>
                            <div
                                class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-indigo-300 opacity-5 dark:opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                            </div>

                            <button @click.stop="quitarSeleccionDeclaracion"
                                class="absolute top-3 right-3 bg-red-500 dark:bg-red-600 text-white rounded-full p-1.5 hover:bg-red-600 dark:hover:bg-red-700 transition-all duration-200 z-10 hover:rotate-90 transform">
                                <Icon icon="material-symbols:close" class="text-lg" />
                            </button>

                            <div class="flex justify-center mb-4">
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                    <Icon icon="solar:file-text-bold" class="text-white text-3xl" />
                                </div>
                            </div>

                            <div class="flex justify-center items-center w-full relative z-0">
                                <div>
                                    <h3 class="font-semibold text-white text-xl mb-3 text-center">
                                        {{ selectedDeclaracion.titulo }}
                                    </h3>
                                    <div class="h-0.5 w-12 bg-white/30 mx-auto mb-3"></div>
                                    <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                        {{ selectedDeclaracion.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-else
                            class="relative h-80 w-64 border-3 border-dashed rounded-2xl bg-white/5 dark:bg-indigo-900/10 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-4 p-6 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/20 transform hover:-translate-y-1 shadow-sm hover:shadow-lg">
                            <div
                                class="w-20 h-20 bg-indigo-100 dark:bg-indigo-800/30 rounded-full flex items-center justify-center mb-2">
                                <Icon icon="hugeicons:add-01" class="text-5xl text-indigo-500 dark:text-indigo-300" />
                            </div>
                            <h3 class="font-medium text-indigo-600 dark:text-indigo-300 text-lg">Tipo de Declaración
                            </h3>
                            <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                                Selecciona un tipo de declaración.
                            </p>
                        </div>
                    </template>
                </ModalFiscal>
            </template>

            <!-- tipo_obligacion -->
            <template v-if="declaracionSeleccionado && declaracionSeleccionado !== null">
                <ModalFiscal title="Selecciona un tipo de obligación" :data="tipo_obligacion"
                    v-model="obligacionSeleccionado" @select-tramite="onObligacionSelected">
                    <template #button-open="{ selectedDato: selectedObligacion }">
                        <div v-if="selectedObligacion"
                            class="h-80 w-64 group relative overflow-hidden bg-gradient-to-br from-indigo-500 to-indigo-700 dark:from-indigo-700 dark:to-indigo-900 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Contenido de la obligación seleccionada -->
                            <div
                                class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                            </div>
                            <div
                                class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-indigo-300 opacity-5 dark:opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                            </div>

                            <button @click.stop="quitarSeleccionObligacion"
                                class="absolute top-3 right-3 bg-red-500 dark:bg-red-600 text-white rounded-full p-1.5 hover:bg-red-600 dark:hover:bg-red-700 transition-all duration-200 z-10 hover:rotate-90 transform">
                                <Icon icon="material-symbols:close" class="text-lg" />
                            </button>

                            <div class="flex justify-center mb-4">
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                    <Icon icon="solar:file-text-bold" class="text-white text-3xl" />
                                </div>
                            </div>

                            <div class="flex justify-center items-center w-full relative z-0">
                                <div>
                                    <h3 class="font-semibold
                                        text-white text-xl mb-3 text-center">
                                        {{ selectedObligacion.titulo }}
                                    </h3>
                                    <div class="h-0.5 w-12 bg-white/30 mx-auto mb-3"></div>
                                    <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                        {{ selectedObligacion.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-else
                            class="relative h-80 w-64 border-3 border-dashed rounded-2xl bg-white/5 dark:bg-indigo-900/10 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-4 p-6 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/20 transform hover:-translate-y-1 shadow-sm hover:shadow-lg">
                            <div
                                class="w-20 h-20 bg-indigo-100 dark:bg-indigo-800/30 rounded-full flex items-center justify-center mb-2">
                                <Icon icon="hugeicons:add-01" class="text-5xl text-indigo-500 dark:text-indigo-300" />
                            </div>
                            <h3 class="font-medium text-indigo-600 dark:text-indigo-300 text-lg">Tipo de Obligación
                            </h3>
                            <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                                Selecciona un tipo de obligación.
                            </p>
                        </div>
                    </template>
                </ModalFiscal>
            </template>


            <template v-if="obligacionSeleccionado && obligacionSeleccionado !== null">
                <ModalFiscal title="Selecciona un tipo de declaración" :data="tipo_declaracion"
                    v-model="tipoDeclaracionSeleccionado" @select-tramite="onTipoDeclaracionSelected">
                    <template #button-open="{ selectedDato: selectedTipoDeclaracion }">
                        <div v-if="selectedTipoDeclaracion"
                            class="h-80 w-64 group relative overflow-hidden bg-gradient-to-br from-indigo-500 to-indigo-700 dark:from-indigo-700 dark:to-indigo-900 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Contenido de la obligación seleccionada -->
                            <div
                                class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                            </div>
                            <div
                                class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-indigo-300 opacity-5 dark:opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                            </div>

                            <button @click.stop="quitarSeleccionTipoDeclaracion"
                                class="absolute top-3 right-3 bg-red-500 dark:bg-red-600 text-white rounded-full p-1.5 hover:bg-red-600 dark:hover:bg-red-700 transition-all duration-200 z-10 hover:rotate-90 transform">
                                <Icon icon="material-symbols:close" class="text-lg" />
                            </button>

                            <div class="flex justify-center mb-4">
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                    <Icon icon="solar:file-text-bold" class="text-white text-3xl" />
                                </div>
                            </div>

                            <div class="flex justify-center items-center w-full relative z-0">
                                <div>
                                    <h3 class="font-semibold
                                        text-white text-xl mb-3 text-center">
                                        {{ selectedTipoDeclaracion.titulo }}
                                    </h3>
                                    <div class="h-0.5 w-12 bg-white/30 mx-auto mb-3"></div>
                                    <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                        {{ selectedTipoDeclaracion.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-else
                            class="relative h-80 w-64 border-3 border-dashed rounded-2xl bg-white/5 dark:bg-indigo-900/10 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-4 p-6 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/20 transform hover:-translate-y-1 shadow-sm hover:shadow-lg">
                            <div
                                class="w-20 h-20 bg-indigo-100 dark:bg-indigo-800/30 rounded-full flex items-center justify-center mb-2">
                                <Icon icon="hugeicons:add-01" class="text-5xl text-indigo-500 dark:text-indigo-300" />
                            </div>
                            <h3 class="font-medium text-indigo-600 dark:text-indigo-300 text-lg">Tipo de Declaración
                            </h3>
                            <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                                Selecciona un tipo de declaraión.
                            </p>
                        </div>
                    </template>
                </ModalFiscal>
            </template>

            <!-- Botón para empezar con el ejercicio (solo visible cuando todos los pasos están completados) -->
            <template v-if="tipoDeclaracionSeleccionado && tipoDeclaracionSeleccionado !== null">
                <Link :href="route('index.ejercicio.obligacion.a')"
                    class="relative h-80 w-64 border-3 overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex flex-col items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl cursor-pointer group">
                <!-- Elementos decorativos de fondo -->
                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-black/20 to-transparent"></div>
                <div
                    class="absolute -inset-1 bg-emerald-500 opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300">
                </div>

                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 z-10">
                    <Icon icon="hugeicons:play" class="text-white text-4xl" />
                </div>
                <h3 class="font-semibold text-white text-xl mb-2 z-10">¡Vamos a comenzar!</h3>
                <p class="text-center text-white/80 text-sm z-10 px-6">
                    Tu ejercicio está listo para ser rellenado.
                </p>
                </Link>
            </template>
        </div>
    </Main>
</template>

<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { ref, watch } from "vue";
import { Link } from "@inertiajs/vue3";
import Main from "@/Layouts/Main.vue";
import ModalFiscal from "@/Components/ModalFiscal.vue";

// Definición de tipos
interface Types {
    id: number;
    titulo: string;
    descripcion: string;
    disponible: boolean;
}

const { tramites_servicios, declaraciones, tipo_obligacion, tipo_declaracion } = defineProps<{
    tramites_servicios: Types[];
    declaraciones: Types[];
    tipo_obligacion: Types[];
    tipo_declaracion: Types[];
}>();

// tramites_servicios
const tramiteSeleccionado = ref<number | null>(null);
const selectedTramiteData = ref<Types | null>(null);
const onTramiteSelected = (tramite: Types) => {
    selectedTramiteData.value = tramite;
};
const quitarSeleccionTramite = (event: Event) => {
    event.stopPropagation();
    tramiteSeleccionado.value = null;
    selectedTramiteData.value = null;

    // Restablecer las selecciones dependientes
    declaracionSeleccionado.value = null;
    selectedDeclaracionData.value = null;
    obligacionSeleccionado.value = null;
    selectedObligacionData.value = null;
    tipoDeclaracionSeleccionado.value = null;
    selectedTipoDeclaracionData.value = null;
};

// declaracion
const declaracionSeleccionado = ref<number | null>(null);
const selectedDeclaracionData = ref<Types | null>(null);
const onDeclaracionSelected = (declaracion: Types) => {
    selectedDeclaracionData.value = declaracion;
};
const quitarSeleccionDeclaracion = (event: Event) => {
    event.stopPropagation();
    declaracionSeleccionado.value = null;
    selectedDeclaracionData.value = null;

    // Restablecer las selecciones dependientes
    obligacionSeleccionado.value = null;
    selectedObligacionData.value = null;
    tipoDeclaracionSeleccionado.value = null;
    selectedTipoDeclaracionData.value = null;
};

// tipo_obligacion
const obligacionSeleccionado = ref<number | null>(null);
const selectedObligacionData = ref<Types | null>(null);
const onObligacionSelected = (obligacion: Types) => {
    selectedObligacionData.value = obligacion;
};
const quitarSeleccionObligacion = (event: Event) => {
    event.stopPropagation();
    obligacionSeleccionado.value = null;
    selectedObligacionData.value = null;

    // Restablecer las selecciones dependientes
    tipoDeclaracionSeleccionado.value = null;
    selectedTipoDeclaracionData.value = null;
};

// tipo_declaracion
const tipoDeclaracionSeleccionado = ref<number | null>(null);
const selectedTipoDeclaracionData = ref<Types | null>(null);
const onTipoDeclaracionSelected = (tipoDeclaracion: Types) => {
    selectedTipoDeclaracionData.value = tipoDeclaracion;
};
const quitarSeleccionTipoDeclaracion = (event: Event) => {
    event.stopPropagation();
    tipoDeclaracionSeleccionado.value = null;
    selectedTipoDeclaracionData.value = null;
    // Restablecer las selecciones dependientes

};



</script>

<style></style>