<template>
    <Main>
        <div
            class="fixed left-0 top-0 right-0 flex justify-between md:hidden items-center bg-gray-50 dark:bg-gray-950 p-3 z-10">
            <Link :href="route('dashboard')" class="dark:text-gray-300 py-2 px-4">
            <Icon icon="hugeicons:arrow-left-02" class="text-3xl" />
            </Link>
            <div class="flex gap-4 items-center">
                <div class="p-2 bg-red-500 rounded-lg">
                    <Icon icon="mingcute:classify-add-2-fill" class="text-2xl text-white" />
                </div>
                <h2 class="text-xl font-bold dark:text-gray-300">Crear Actividad</h2>
            </div>
        </div>

        <!-- Modal en medio que muestra un mensaje si tiene_ejercicios  == false -->
        <div v-if="!tiene_ejercicios"
            class="fixed inset-0 flex items-center justify-center bg-black/70 backdrop-blur-md z-50 animate-fadeIn"
            @click="tiene_ejercicios = true">

            <!-- Modal Card -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-8 max-w-md w-11/12 text-center relative border border-indigo-100 dark:border-indigo-900 animate-zoomIn overflow-hidden"
                @click.stop>

                <!-- Decorative Background Pattern -->
                <!-- <div class="absolute -top-32 -right-32 w-64 h-64 bg-indigo-600/10 rounded-full"></div>
                <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-indigo-600/10 rounded-full"></div> -->

                <!-- Close Button -->
                <button @click="tiene_ejercicios = true"
                    class="absolute top-3 right-3 p-1.5 rounded-full text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Content -->
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Aún no tienes ejercicios</h2>

                <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-xs mx-auto">
                    Para comenzar una actividad necesitas crear al menos un ejercicio.
                </p>

                <!-- Info Box -->
                <div
                    class="mb-8 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/30 p-5 rounded-xl border border-indigo-100 dark:border-indigo-800/50">
                    <span class="font-semibold text-indigo-700 dark:text-indigo-300">No te preocupes, Te guiaremos para
                        crear tu primer ejercicio. ¡Es muy sencillo!</span>
                </div>

                <!-- Action Button -->
                <Link :href="route('index.crear.ejercicio')"
                    class="group w-full bg-blue-600 text-white py-3.5 px-6 rounded-xl font-medium duration-100 hover:shadow-xl flex items-center justify-center relative overflow-hidden active:scale-90 transition-all">

                <span class="relative text-base font-bold">Comenzar</span>
                <Icon icon="mingcute:arrow-right-fill" class="text-2xl relative ml-2" />
                </Link>

                <!-- Bottom Text -->
                <p class="mt-4 text-xs text-gray-500 dark:text-gray-500">
                    Podrás crear más ejercicios después
                </p>
            </div>
        </div>

        <div class="lg:flex gap-6 items-start justify-start mt-24 lg:mt-10">
            <div class="mb-6 relative mt-6 w-full md:max-w-[450px] lg:sticky lg:top-24">
                <div class="hidden md:block mb-8">
                    <div class="flex gap-4 items-center">
                        <div class="p-2 bg-red-500 rounded-lg">
                            <Icon icon="mingcute:classify-add-2-fill" class="text-2xl text-white" />
                        </div>
                        <h2 class="text-2xl font-bold dark:text-gray-300">Crear Actividad</h2>
                    </div>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold mb-4 dark:text-white text-center md:text-start">¡Comencemos a
                    <span class="underline decoration-red-500">definir</span> que tipo de <span
                        class=" rounded-lg text-red-500">Actividad</span> quieres realizar!
                </h1>
                <p class="text-blue-600 text-center md:text-start">Sigue las indicaciones para continuar.</p>
            </div>
            <!-- Contenedor principal de tarjetas -->
            <div class="flex flex-wrap gap-6 justify-center w-full text-white mt-24 lg:mt-6">
                <!-- Componente genérico para cada paso del flujo de selección -->
                <SelectorModal v-for="(paso, index) in pasos" :key="paso.id" v-show="debeMostrarPaso(index)"
                    :paso="paso" :title="paso.modalTitle" :data="paso.data" v-model="paso.selectedId"
                    @select-item="(item) => onItemSelected(index, item)"
                    @remove-selection="(e) => quitarSeleccion(e, index)" />

                <!-- Botón para empezar con el ejercicio (solo visible cuando todos los pasos están completados) -->
                <template v-if="todosLosPasosCompletados">
                    <Link :href="route('index.actividad.declaracion.a')"
                        class="relative h-64 w-52 border-3 overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex flex-col items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl cursor-pointer group active:scale-90">
                    <!-- Elementos decorativos de fondo -->
                    <div
                        class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-black/20 to-transparent">
                    </div>
                    <div
                        class="absolute -inset-1 bg-emerald-500 opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300">
                    </div>

                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 z-10">
                        <Icon icon="hugeicons:play" class="text-white text-4xl" />
                    </div>
                    <h3 class="font-semibold text-white text-xl mb-2 z-10">¡Vamos a comenzar!</h3>
                    <p class="text-center text-white/80 text-sm z-10 px-6">
                        Tu actividad está lista para ser rellenada.
                    </p>
                    </Link>
                </template>
            </div>

        </div>
    </Main>
</template>

<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import Main from "@/Layouts/Main.vue";
import ModalFiscal from "@/Components/ModalFiscal.vue";
import SelectorModal from "@/Components/SelectorModal.vue";

// Definición de tipos
interface Types {
    id: number;
    titulo: string;
    descripcion: string;
    disponible: boolean;
}

interface Paso {
    id: string;
    modalTitle: string;
    data: Types[];
    selectedId: number | null;
    selectedData: Types | null;
    label: string;
    placeholder: string;
}

const props = defineProps<{
    tramites_servicios: Types[];
    declaraciones: Types[];
    tipo_obligacion: Types[];
    tipo_declaracion: Types[];
    tiene_ejercicios: boolean;
}>();

const tiene_ejercicios = ref(props.tiene_ejercicios);

// Configuración de los pasos
const pasos = ref<Paso[]>([
    {
        id: 'tramite',
        modalTitle: 'Selecciona un trámite o servicio fiscal',
        data: props.tramites_servicios,
        selectedId: null,
        selectedData: null,
        label: 'Trámite Fiscal',
        placeholder: 'Selecciona un trámite o servicio fiscal.'
    },
    {
        id: 'declaracion',
        modalTitle: 'Selecciona un tipo de declaración',
        data: props.declaraciones,
        selectedId: null,
        selectedData: null,
        label: 'Tipo de Declaración',
        placeholder: 'Selecciona un tipo de declaración.'
    },
    {
        id: 'obligacion',
        modalTitle: 'Selecciona un tipo de obligación',
        data: props.tipo_obligacion,
        selectedId: null,
        selectedData: null,
        label: 'Tipo de Obligación',
        placeholder: 'Selecciona un tipo de obligación.'
    },
    {
        id: 'tipo_declaracion',
        modalTitle: 'Selecciona un tipo de declaración',
        data: props.tipo_declaracion,
        selectedId: null,
        selectedData: null,
        label: 'Tipo de Declaración',
        placeholder: 'Selecciona un tipo de declaración.'
    }
]);

// Método para mostrar un paso según el estado de los anteriores
const debeMostrarPaso = (index: number): boolean => {
    if (index === 0) return true;
    return pasos.value[index - 1].selectedId !== null;
};

// Método para manejar la selección de un item
const onItemSelected = (pasoIndex: number, item: Types) => {
    pasos.value[pasoIndex].selectedData = item;

    // Resetear las selecciones posteriores cuando se cambia una anterior
    for (let i = pasoIndex + 1; i < pasos.value.length; i++) {
        pasos.value[i].selectedId = null;
        pasos.value[i].selectedData = null;
    }
};

// Método para quitar la selección de un paso
const quitarSeleccion = (event: Event, pasoIndex: number) => {
    event.stopPropagation();
    pasos.value[pasoIndex].selectedId = null;
    pasos.value[pasoIndex].selectedData = null;

    // Resetear las selecciones posteriores
    for (let i = pasoIndex + 1; i < pasos.value.length; i++) {
        pasos.value[i].selectedId = null;
        pasos.value[i].selectedData = null;
    }
};

// Computar si todos los pasos están completados
const todosLosPasosCompletados = computed(() => {
    return pasos.value.every(paso => paso.selectedId !== null);
});
</script>

<style></style>