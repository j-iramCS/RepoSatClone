<template>
    <Main>
        <div class="pb-6 border-b mb-7 border-slate-700 mt-2">
            <h1 class="text-4xl font-extrabold dark:text-white">
                ¡Comencemos a crear tu ejercicio!
            </h1>
            <p class="text-gray-600 dark:text-gray-300 mt-2">
                En este espacio podrás diseñar ejercicios personalizados
                relacionados con el SAT, ideales para reforzar tus conocimientos
                o evaluar a tu grupo. Puedes compartirlos con la comunidad o
                utilizarlos en tu entorno de estudio. Sigue los pasos a
                continuación para comenzar.
            </p>
        </div>

        <div class="flex flex-wrap gap-4 justify-center text-white mt-6">
            <!-- 1 -->
            <ModalFiscal title="Selecciona un trámite o servicio fiscal" :data="tramitesyservicios"
                v-model="tramiteSeleccionado" @select-tramite="onTramiteSelected">
                <template #button-open="{ selectedDato: selectedTramite }">
                    <!-- Muestra la cartilla con el trámite seleccionado -->

                    <div v-if="selectedTramite"
                        class="h-72 w-[220px] group relative overflow-hidden bg-indigo-500 dark:bg-indigo-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">

                        <!-- Elementos decorativos de fondo -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-24 h-24 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                        </div>

                        <!-- Botón de cerrar -->
                        <button @click.stop="quitarSeleccionTramite"
                            class="absolute top-2 right-2 bg-red-500 dark:bg-red-600 text-white rounded-full p-1 hover:bg-red-600 dark:hover:bg-red-700 transition-colors duration-200 z-10">
                            <Icon icon="material-symbols:close" />
                        </button>

                        <!-- Contenido del trámite -->
                        <div class="flex justify-center items-center h-full w-full relative z-0">
                            <div>
                                <h3 class="font-semibold text-white text-lg mb-3 text-center">
                                    {{ selectedTramite.titulo }}
                                </h3>
                                <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                    {{ selectedTramite.descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Muestra el botón de añadir cuando no hay selección -->
                    <div v-else
                        class="relative h-72 w-[220px] border-4 border-dashed rounded-md bg-white/10 dark:bg-indigo-900/20 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-3 p-4 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/30 transform hover:-translate-y-1">
                        <Icon icon="hugeicons:add-01" class="text-7xl text-indigo-500 dark:text-indigo-300" />
                        <p class="text-center text-gray-700 dark:text-gray-200">
                            Selecciona un trámite o servicio fiscal.
                        </p>
                    </div>
                </template>
            </ModalFiscal>

            <!-- 2 -->
            <template v-if="tramiteSeleccionado && tramiteSeleccionado !== null">
                <ModalFiscal title="Selecciona un tipo de declaración" :data="declaraciones"
                    v-model="declaracionSeleccionado" @select-tramite="onDeclaracionSelected">
                    <template #button-open="{ selectedDato: selectedDeclaracion }">
                        <!-- Muestra la cartilla con el trámite seleccionado -->
                        <div v-if="selectedDeclaracion"
                            class="h-72 w-[220px] group relative overflow-hidden bg-indigo-500 dark:bg-indigo-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">

                            <!-- Elementos decorativos de fondo -->
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-24 h-24 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                            </div>

                            <!-- Botón de cerrar -->
                            <button @click.stop="quitarSeleccionDeclaracion"
                                class="absolute top-2 right-2 bg-red-500 dark:bg-red-600 text-white rounded-full p-1 hover:bg-red-600 dark:hover:bg-red-700 transition-colors duration-200 z-10">
                                <Icon icon="material-symbols:close" />
                            </button>

                            <!-- Contenido del trámite -->
                            <div class="flex justify-center items-center h-full w-full relative z-0">
                                <div>
                                    <h3 class="font-semibold text-white text-lg mb-3 text-center">
                                        {{ selectedDeclaracion.titulo }}
                                    </h3>
                                    <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                        {{ selectedDeclaracion.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Muestra el botón de añadir cuando no hay selección -->
                        <div v-else
                            class="relative h-72 w-[220px] border-4 border-dashed rounded-md bg-white/10 dark:bg-indigo-900/20 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-3 p-4 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/30 transform hover:-translate-y-1">
                            <Icon icon="hugeicons:add-01" class="text-7xl text-indigo-500 dark:text-indigo-300" />
                            <p class="text-center text-gray-700 dark:text-gray-200">
                                Selecciona un tipo de declaración.
                            </p>
                        </div>
                    </template>
                </ModalFiscal>
            </template>

            <!-- 3 -->
            <template v-if="
                declaracionSeleccionado && declaracionSeleccionado !== null
            ">
                <ModalFiscal title="Selecciona un tipo de regimen de impuesto" :data="regimeneimpuesto"
                    v-model="regimenSeleccionado" @select-tramite="onRegimenSelected">
                    <template #button-open="{ selectedDato: selectedRegimen }">
                        <!-- Muestra la cartilla con el trámite seleccionado -->
                        <div v-if="selectedRegimen"
                            class="h-72 w-[220px] group relative overflow-hidden bg-indigo-500 dark:bg-indigo-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">

                            <!-- Elementos decorativos de fondo -->
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-24 h-24 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                            </div>

                            <!-- Botón de cerrar -->
                            <button @click.stop="quitarSeleccionRegimen"
                                class="absolute top-2 right-2 bg-red-500 dark:bg-red-600 text-white rounded-full p-1 hover:bg-red-600 dark:hover:bg-red-700 transition-colors duration-200 z-10">
                                <Icon icon="material-symbols:close" />
                            </button>

                            <!-- Contenido del trámite -->
                            <div class="flex justify-center items-center h-full w-full relative z-0">
                                <div>
                                    <h3 class="font-semibold text-white text-lg mb-3 text-center">
                                        {{ selectedRegimen.titulo }}
                                    </h3>
                                    <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                        {{ selectedRegimen.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Muestra el botón de añadir cuando no hay selección -->
                        <div v-else
                            class="relative h-72 w-[220px] border-4 border-dashed rounded-md bg-white/10 dark:bg-indigo-900/20 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-3 p-4 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/30 transform hover:-translate-y-1">
                            <Icon icon="hugeicons:add-01" class="text-7xl text-indigo-500 dark:text-indigo-300" />
                            <p class="text-center text-gray-700 dark:text-gray-200">
                                Selecciona un tipo de regimen de impuesto.
                            </p>
                        </div>
                    </template>
                </ModalFiscal>
            </template>

            <!-- 4 -->
            <template v-if="regimenSeleccionado && regimenSeleccionado !== null">
                <ModalFiscal title="Selecciona un tipo" :data="iva" v-model="ivaSeleccionado"
                    @select-tramite="onIvaSelected">
                    <template #button-open="{ selectedDato: selectedIVA }">
                        <!-- Muestra la cartilla con el trámite seleccionado -->
                        <div v-if="selectedIVA"
                            class="h-72 w-[220px] group relative overflow-hidden bg-indigo-500 dark:bg-indigo-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">

                            <!-- Elementos decorativos de fondo -->
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-24 h-24 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                            </div>

                            <!-- Botón de cerrar -->
                            <button @click.stop="quitarSeleccionIVA"
                                class="absolute top-2 right-2 bg-red-500 dark:bg-red-600 text-white rounded-full p-1 hover:bg-red-600 dark:hover:bg-red-700 transition-colors duration-200 z-10">
                                <Icon icon="material-symbols:close" />
                            </button>

                            <!-- Contenido del trámite -->
                            <div class="flex justify-center items-center h-full w-full relative z-0">
                                <div>
                                    <h3 class="font-semibold text-white text-lg mb-3 text-center">
                                        {{ selectedIVA.titulo }}
                                    </h3>
                                    <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                                        {{ selectedIVA.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Muestra el botón de añadir cuando no hay selección -->
                        <div v-else
                            class="relative h-72 w-[220px] border-4 border-dashed rounded-md bg-white/10 dark:bg-indigo-900/20 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-3 p-4 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/30 transform hover:-translate-y-1">
                            <Icon icon="hugeicons:add-01" class="text-7xl text-indigo-500 dark:text-indigo-300" />
                            <p class="text-center text-gray-700 dark:text-gray-200">
                                Selecciona un tipo.
                            </p>
                        </div>
                    </template>
                </ModalFiscal>
            </template>

            <!-- Boton para empezar con el ejercicio -->
            <template v-if="ivaSeleccionado && ivaSeleccionado !== null">
                <Link :href="route('crear.ejercicio.a')"
                    class="relative h-72 w-[220px] border-4 bg-yellow-500 rounded-md flex flex-col items-center justify-center transition-all duration-300 hover:border-white hover:bg-emerald-500 transform hover:-translate-y-1 cursor-pointer">
                <Icon icon="hugeicons:play" class="text-white text-7xl" />
                <p class="text-center text-white">Comenzar</p>
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
    icono: string;
    color: string;
    colorText: string;
    descripcion: string;
    disponible: boolean;
}

const { tramitesyservicios, declaraciones } = defineProps<{
    tramitesyservicios: Types[];
    declaraciones: Types[];
    regimeneimpuesto: Types[];
    iva: Types[];
}>();

// TRAMITES
const tramiteSeleccionado = ref<number | null>(null);
const selectedTramiteData = ref<Types | null>(null);
const onTramiteSelected = (tramite: Types) => {
    // Función para actualizar el trámite seleccionado
    selectedTramiteData.value = tramite;
};
const quitarSeleccionTramite = (event: Event) => {
    // Función para quitar la selección del trámite
    event.stopPropagation();
    tramiteSeleccionado.value = null;
    selectedTramiteData.value = null;

    declaracionSeleccionado.value = null;
    regimenSeleccionado.value = null;
    ivaSeleccionado.value = null;
};

// DECLARACIONES
const declaracionSeleccionado = ref<number | null>(null);
const selectedDeclaracionData = ref<Types | null>(null);
const onDeclaracionSelected = (declaracion: Types) => {
    // Función para actualizar la declaración seleccionada
    selectedDeclaracionData.value = declaracion;
};
const quitarSeleccionDeclaracion = (event: Event) => {
    // Función para quitar la selección de la declaración
    event.stopPropagation();
    declaracionSeleccionado.value = null;
    selectedDeclaracionData.value = null;

    regimenSeleccionado.value = null;
    ivaSeleccionado.value = null;
};

// REGIMENES
const regimenSeleccionado = ref<number | null>(null);
const selectedRegimenData = ref<Types | null>(null);
const onRegimenSelected = (regimen: Types) => {
    // Función para actualizar el régimen seleccionado
    selectedRegimenData.value = regimen;
};
const quitarSeleccionRegimen = (event: Event) => {
    // Función para quitar la selección del régimen
    event.stopPropagation();
    regimenSeleccionado.value = null;
    selectedRegimenData.value = null;

    ivaSeleccionado.value = null;
};

// IVA
const ivaSeleccionado = ref<number | null>(null);
const selectedIVAData = ref<Types | null>(null);
const onIvaSelected = (iva: Types) => {
    // Función para actualizar el IVA seleccionado
    selectedIVAData.value = iva;
};
const quitarSeleccionIVA = (event: Event) => {
    // Función para quitar la selección del IVA
    event.stopPropagation();
    ivaSeleccionado.value = null;
    selectedIVAData.value = null;
};

// obtener todo lo que se ha seleccionado
watch(
    [
        tramiteSeleccionado,
        declaracionSeleccionado,
        regimenSeleccionado,
        ivaSeleccionado,
    ],
    ([tramite, declaracion, regimen, iva]) => {
        console.log("Trámite seleccionado:", tramite);
        console.log("Declaración seleccionada:", declaracion);
        console.log("Régimen seleccionado:", regimen);
        console.log("IVA seleccionado:", iva);
    }
);
</script>

<style></style>
