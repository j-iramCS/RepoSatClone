<template>
    <Main>
        <div class="pb-6 border-b mb-7 border-slate-700 mt-2">
            <h1 class="text-4xl font-extrabold text-blue-500">
                ¡Comencemos a crear tu ejercicio!
            </h1>
            <p class="text-gray-300 mt-2">
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
                        className="h-72 w-[220px] group relative overflow-hidden bg-slate-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div
                            className="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16">
                        </div>
                        <div
                            className="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                        </div>

                        <button @click.stop="quitarSeleccionTramite"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                            <Icon icon="material-symbols:close" />
                        </button>

                        <!-- Contenido del trámite -->
                        <div class="flex justify-center items-center h-full w-full">
                            <div>
                                <h3 class="font-semibold text-white text-lg mb-2">
                                    {{ selectedTramite.titulo }}
                                </h3>
                                <p class="text-gray-300 text-sm text-center px-4">
                                    {{ selectedTramite.descripcion }}
                                </p>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>

                    <!-- Muestra el botón de añadir cuando no hay selección -->
                    <div v-else
                        class="relative h-72 w-[220px] border-4 bg-slate-700 border-dashed rounded-md border-gray-300 flex flex-col items-center justify-center transition-all duration-300 hover:border-white hover:bg-indigo-500 transform hover:-translate-y-1">
                        <Icon icon="hugeicons:add-01" class="text-white text-7xl" />
                        <p class="text-center text-white">
                            Selecciona un trámite o servicio fiscal.
                        </p>
                        <div class="float justify-center items-center absolute -bottom-24">
                            <Icon icon="hugeicons:tap-05" class="text-7xl animate-bounce text-blue-500" />
                        </div>
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
                            className="h-72 w-[220px] group relative overflow-hidden bg-slate-900 p-6 hover:border-blue-500 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div
                                className="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                className="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                            </div>
                            <!-- Botón para quitar la selección -->
                            <button @click.stop="quitarSeleccionDeclaracion"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                <Icon icon="material-symbols:close" />
                            </button>

                            <div class="flex justify-center items-center h-full w-full">
                                <div>
                                    <h3 class="font-semibold text-white text-lg mb-2">
                                        {{ selectedDeclaracion.titulo }}
                                    </h3>
                                    <p class="text-gray-300 text-sm text-center px-4">
                                        {{ selectedDeclaracion.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Muestra el botón de añadir cuando no hay selección -->
                        <div v-else
                            class="relative h-72 w-[220px] border-4 bg-slate-700 border-dashed rounded-md border-gray-300 flex flex-col items-center justify-center transition-all duration-300 hover:border-white hover:bg-indigo-500 transform hover:-translate-y-1">
                            <Icon icon="hugeicons:add-01" class="text-white text-7xl" />
                            <p class="text-center text-white">
                                Selecciona un tipo de declaración.
                            </p>
                            <div class="float justify-center items-center absolute -bottom-24">
                                <Icon icon="hugeicons:tap-05" class="text-7xl animate-bounce text-blue-500" />
                            </div>
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
                            className="h-72 w-[220px] group relative overflow-hidden bg-slate-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div
                                className="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                className="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                            </div>
                            <!-- Botón para quitar la selección -->
                            <button @click.stop="quitarSeleccionRegimen"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                <Icon icon="material-symbols:close" />
                            </button>

                            <div class="flex justify-center items-center h-full w-full">
                                <div>
                                    <h3 class="font-semibold text-white text-lg mb-2">
                                        {{ selectedRegimen.titulo }}
                                    </h3>
                                    <p class="text-gray-300 text-sm text-center px-4">
                                        {{ selectedRegimen.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Muestra el botón de añadir cuando no hay selección -->
                        <div v-else
                            class="relative h-72 w-[220px] border-4 bg-slate-700 border-dashed rounded-md border-gray-300 flex flex-col items-center justify-center transition-all duration-300 hover:border-white hover:bg-indigo-500 transform hover:-translate-y-1">
                            <Icon icon="hugeicons:add-01" class="text-white text-7xl" />
                            <p class="text-center text-white">
                                Selecciona un tipo de regimen de impuesto.
                            </p>
                            <div class="float justify-center items-center absolute -bottom-24">
                                <Icon icon="hugeicons:tap-05" class="text-7xl animate-bounce text-blue-500" />
                            </div>
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
                            className="h-72 w-[220px] group relative overflow-hidden bg-slate-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div
                                className="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16">
                            </div>
                            <div
                                className="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                            </div>
                            <!-- Botón para quitar la selección -->
                            <button @click.stop="quitarSeleccionIVA"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                <Icon icon="material-symbols:close" />
                            </button>

                            <div class="flex justify-center items-center h-full w-full">
                                <div>
                                    <h3 class="font-semibold text-white text-lg mb-2">
                                        {{ selectedIVA.titulo }}
                                    </h3>
                                    <p class="text-gray-300 text-sm text-center px-4">
                                        {{ selectedIVA.descripcion }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Muestra el botón de añadir cuando no hay selección -->
                        <div v-else
                            class="relative h-72 w-[220px] border-4 bg-slate-700 border-dashed rounded-md border-gray-300 flex flex-col items-center justify-center transition-all duration-300 hover:border-white hover:bg-indigo-500 transform hover:-translate-y-1">
                            <Icon icon="hugeicons:add-01" class="text-white text-7xl" />
                            <p class="text-center text-white">
                                Selecciona un tipo.
                            </p>
                            <div class="float justify-center items-center absolute -bottom-24">
                                <Icon icon="hugeicons:tap-05" class="text-7xl animate-bounce text-blue-500" />
                            </div>
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
                <div class="float justify-center items-center absolute -bottom-24">
                    <Icon icon="hugeicons:tap-05" class="text-7xl animate-bounce text-white" />
                </div>
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
