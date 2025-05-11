<template>
    <Main>

        <div class="py-6 grid grid-cols-2 gap-4 wysiwyg">
            <Wysiwyg :modelValue="content" @change="handleContentChange" />

            <div class="bg-white dark:bg-gray-900 dark:text-white rounded-lg shadow-md p-4">
                <div v-html="content"></div>
            </div>
        </div>

        <!-- Datos de indentificacion -->
        <div>
            <p class="text-2xl mb-4 dark:text-white">
                Datos de Identificación
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="bg-white shadow-md dark:bg-gray-900 p-4 rounded-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm m-0 p-0 dark:text-white">
                                    RFC
                                </p>
                                <Tooltip width="none" position="top"
                                    text="El RFC es un número único que identifica a cada contribuyente en México. Puedes inventar un RFC o puedes dejar el RFC por defecto.">
                                    <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                                </Tooltip>
                            </div>
                            <Input type="text" v-model="formActividad.inputRFC" custom-class="mt-2"
                                placeholder="Ingrese su RFC" clearable default-value="XAXX010101000" :required="true"
                                :rules="{
                                    maxLength: maxLength(13),
                                    minLength: minLength(13),
                                }" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm m-0 p-0 dark:text-white">
                                    CURP
                                </p>
                                <Tooltip width="none" position="top"
                                    text="La CURP es un código único que identifica a cada persona en México. Puedes inventar una CURP o puedes dejar la CURP por defecto.">
                                    <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                                </Tooltip>
                            </div>
                            <Input type="text" v-model="formActividad.inputCURP" custom-class="mt-2"
                                placeholder="Ingrese su RFC" clearable default-value="XXXXXXXXXXXXXXXXXX"
                                :required="true" :rules="{
                                    maxLength: maxLength(18),
                                    minLength: minLength(18),
                                }" />
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md dark:bg-gray-900 p-4 rounded-lg">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm m-0 p-0 dark:text-white">
                                    Apellido Paterno
                                </p>
                                <Tooltip width="none" position="top"
                                    text="El apellido paterno es el primer apellido de la persona. Puedes inventar un apellido o puedes dejar el apellido por defecto.">
                                    <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                                </Tooltip>
                            </div>
                            <Input type="text" v-model="formActividad.inputApellidoPaterno
                                " custom-class="mt-2" placeholder="Ingresa un apellido" clearable default-value="PPP"
                                :required="true" :rules="{
                                    maxLength: maxLength(30),
                                    minLength: minLength(2),
                                }" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm m-0 p-0 dark:text-white">
                                    Apellido Materno
                                </p>
                                <Tooltip width="none" position="top"
                                    text="El apellido materno es el segundo apellido de la persona. Puedes inventar un apellido o puedes dejar el apellido por defecto.">
                                    <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                                </Tooltip>
                            </div>
                            <Input type="text" v-model="formActividad.inputApellidoMaterno
                                " custom-class="mt-2" placeholder="Ingresa un apellido" clearable default-value="MMM"
                                :required="true" :rules="{
                                    maxLength: maxLength(30),
                                    minLength: minLength(2),
                                }" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm m-0 p-0 dark:text-white">
                                    Nombre(s)
                                </p>
                                <Tooltip width="none" position="top"
                                    text="El nombre(s) es el nombre de la persona. Puedes inventar un nombre o puedes dejar el nombre por defecto.">
                                    <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                                </Tooltip>
                            </div>
                            <Input type="text" v-model="formActividad.inputNombres" custom-class="mt-2"
                                placeholder="Ingresa un apellido" clearable default-value="NNN" :required="true" :rules="{
                                    maxLength: maxLength(30),
                                    minLength: minLength(2),
                                }" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md dark:bg-gray-900 p-4 rounded-lg">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-sm m-0 p-0 dark:text-white">
                                Ejercicio
                            </p>
                            <Tooltip width="none" position="top" text="Sin referencias">
                                <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                            </Tooltip>
                        </div>
                        <!-- selec -->
                        <Select v-model="formActividad.selectedEjercicio" :options="props.catalogo_anios"
                            :searchable="false" placeholder="Selecciona un ejercicio" :required="true" />
                    </div>

                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-sm m-0 p-0 dark:text-white">
                                Periodicidad
                            </p>
                            <Tooltip width="none" position="top" text="Sin referencias">
                                <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                            </Tooltip>
                        </div>
                        <!-- selec -->
                        <Select v-model="formActividad.selectedPeriodicidad" :options="props.catalogo_periodicidades"
                            :searchable="false" placeholder="Selecciona un periodo" :required="true" />
                    </div>

                    <div v-if="formActividad.selectedPeriodicidad != '' && formActividad.selectedPeriodicidad != '5'">
                        <div class="flex items-center gap-2">
                            <p class="text-sm m-0 p-0 dark:text-white">
                                Periodo
                            </p>
                            <Tooltip width="none" position="top" text="Sin referencias">
                                <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                            </Tooltip>
                        </div>
                        <!-- selec -->
                        <Select v-model="formActividad.selectedPeriodo" :options="filtroPeriodos" :searchable="false"
                            placeholder="Selecciona un periodo" :required="true" />
                    </div>

                    <div v-if="formActividad.selectedPeriodicidad == '5'">
                        <div class="flex items-center gap-2">
                            <p class="text-sm m-0 p-0 dark:text-white">
                                Fecha de Causación
                            </p>
                            <Tooltip width="none" position="top" text="Sin referencias">
                                <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                            </Tooltip>
                        </div>
                        <!-- selec -->
                        <Input type="date" v-model="formActividad.inputFechaCausacion" custom-class="mt-2"
                            placeholder="Ingresa la fecha" clearable :required="true" />
                    </div>
                    <div v-if="formActividad.selectedPeriodo != '' || formActividad.inputFechaCausacion != ''">
                        <div class="flex items-center gap-2">
                            <p class="text-sm m-0 p-0 dark:text-white">
                                Tipo de declaración
                            </p>
                            <Tooltip width="none" position="top" text="Sin referencias">
                                <Icon icon="material-symbols:help" class="text-xl text-blue-500 cursor-pointer" />
                            </Tooltip>
                        </div>
                        <!-- selec -->
                        <Select v-model="formActividad.selectedTipoDeclaracion
                            " :options="props.tipos_declaracion" :searchable="false"
                            placeholder="Selecciona una declaración" :required="true" />
                    </div>

                </div>
            </div>
        </div>

        <!-- Obligaciones a declarar -->

        <p class="text-2xl mt-6 mb-4 dark:text-white">
            Obligaciones a Declarar
        </p>
        <div class="flex flex-wrap gap-2 justify-around mt-4">
            <!-- 1 -->
            <ModalFiscal title="Selecciona uno de los ejercicios creado por ti sobre este tipo de obligación"
                :data="dataModal" v-model="SeleccionadoB" @select-tramite="onSelectedB">
                <template #button-open="{ selectedDato: selectedB }">
                    <div v-if="selectedB"
                        class="h-80 w-64 group relative overflow-hidden bg-gray-300 dark:bg-gray-700 p-6 rounded-2xl shadow-lg cursor-not-allowed">
                        <div
                            class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-gray-500 opacity-10 rounded-full -mr-16 -mt-16">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-gray-500 opacity-10 rounded-full -ml-12 -mb-12">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-gray-500 opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                        </div>

                        <button disabled
                            class="absolute top-3 right-3 bg-gray-400 dark:bg-gray-600 text-white rounded-full p-1.5 cursor-not-allowed">
                            <Icon icon="material-symbols:close" class="text-lg" />
                        </button>

                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <Icon icon="solar:file-text-bold" class="text-white text-3xl" />
                            </div>
                        </div>

                        <div class="flex justify-center items-center w-full relative z-0">
                            <div>
                                <h3 class="font-semibold text-gray-500 dark:text-gray-300 text-xl mb-3 text-center">
                                    {{ selectedB.titulo }}
                                </h3>
                                <div class="h-0.5 w-12 bg-gray-400 mx-auto mb-3"></div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm text-center px-2">
                                    {{ selectedB.descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else
                        class="relative h-80 w-64 border-3 border-dashed rounded-2xl bg-gray-200 dark:bg-gray-800 border-gray-400 dark:border-gray-600 flex flex-col items-center justify-center gap-4 p-6 cursor-not-allowed">
                        <div
                            class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center mb-2">
                            <Icon icon="hugeicons:lock-password" class="text-5xl text-gray-500 dark:text-gray-400" />
                        </div>
                        <p class="font-medium text-gray-500 dark:text-gray-400 text-lg">ISR retenciones por asimilados.
                            Personas fisicas</p>
                        <p class="text-center text-gray-500 dark:text-gray-400 text-sm">
                            Selecciona un ejercicio de este tipo de obligación.
                        </p>
                    </div>
                </template>
            </ModalFiscal>

            <!-- 2 -->
            <ModalFiscal title="Selecciona uno de los ejercicios creado por ti sobre este tipo de obligación"
                :data="dataModal" v-model="SeleccionadoB" @select-tramite="onSelectedB">
                <template #button-open="{ selectedDato: selectedB }">
                    <div v-if="selectedB"
                        class="h-80 w-64 group relative overflow-hidden bg-gray-300 dark:bg-gray-700 p-6 rounded-2xl shadow-lg cursor-not-allowed">
                        <div
                            class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-gray-500 opacity-10 rounded-full -mr-16 -mt-16">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-gray-500 opacity-10 rounded-full -ml-12 -mb-12">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-gray-500 opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                        </div>

                        <button disabled
                            class="absolute top-3 right-3 bg-gray-400 dark:bg-gray-600 text-white rounded-full p-1.5 cursor-not-allowed">
                            <Icon icon="material-symbols:close" class="text-lg" />
                        </button>

                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <Icon icon="solar:file-text-bold" class="text-white text-3xl" />
                            </div>
                        </div>

                        <div class="flex justify-center items-center w-full relative z-0">
                            <div>
                                <h3 class="font-semibold text-gray-500 dark:text-gray-300 text-xl mb-3 text-center">
                                    {{ selectedB.titulo }}
                                </h3>
                                <div class="h-0.5 w-12 bg-gray-400 mx-auto mb-3"></div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm text-center px-2">
                                    {{ selectedB.descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else
                        class="relative h-80 w-64 border-3 border-dashed rounded-2xl bg-gray-200 dark:bg-gray-800 border-gray-400 dark:border-gray-600 flex flex-col items-center justify-center gap-4 p-6 cursor-not-allowed">
                        <div
                            class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center mb-2">
                            <Icon icon="hugeicons:lock-password" class="text-5xl text-gray-500 dark:text-gray-400" />
                        </div>
                        <p class="font-medium text-gray-500 dark:text-gray-400 text-lg">ISR retenciones por asimilados a
                            salarios.
                            Personas fisicas</p>
                        <p class="text-center text-gray-500 dark:text-gray-400 text-sm">
                            Selecciona un ejercicio de este tipo de obligación.
                        </p>
                    </div>
                </template>
            </ModalFiscal>

            <!-- 3 -->
            <ModalFiscal title="Selecciona uno de los ejercicios creado por ti sobre este tipo de obligación"
                :data="dataModal" v-model="SeleccionadoA" @select-tramite="onSelectedA">
                <template #button-open="{ selectedDato: selectedTramite }">
                    <div v-if="selectedTramite"
                        class="h-80 w-64 group relative overflow-hidden bg-gradient-to-br from-indigo-500 to-indigo-700 dark:from-indigo-700 dark:to-indigo-900 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div
                            class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -mr-16 -mt-16">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-indigo-300 opacity-10 dark:opacity-5 rounded-full -ml-12 -mb-12">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-indigo-300 opacity-5 dark:opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                        </div>

                        <button @click.stop="quitarSeleccionA"
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
                        <p class="font-medium text-indigo-600 dark:text-indigo-300 text-lg">Impuesto al Valor Agregado.
                            Personas fisicas</p>
                        <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                            Selecciona un ejercicio de este tipo de obligación.
                        </p>
                    </div>
                </template>
            </ModalFiscal>

            <!-- 4 -->
            <ModalFiscal title="Selecciona uno de los ejercicios creado por ti sobre este tipo de obligación"
                :data="dataModal" v-model="SeleccionadoB" @select-tramite="onSelectedB">
                <template #button-open="{ selectedDato: selectedB }">
                    <div v-if="selectedB"
                        class="h-80 w-64 group relative overflow-hidden bg-gray-300 dark:bg-gray-700 p-6 rounded-2xl shadow-lg cursor-not-allowed">
                        <div
                            class="absolute top-0 right-0 w-40 h-40 bg-white dark:bg-gray-500 opacity-10 rounded-full -mr-16 -mt-16">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-32 h-32 bg-white dark:bg-gray-500 opacity-10 rounded-full -ml-12 -mb-12">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 w-24 h-24 bg-white dark:bg-gray-500 opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-lg">
                        </div>

                        <button disabled
                            class="absolute top-3 right-3 bg-gray-400 dark:bg-gray-600 text-white rounded-full p-1.5 cursor-not-allowed">
                            <Icon icon="material-symbols:close" class="text-lg" />
                        </button>

                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <Icon icon="solar:file-text-bold" class="text-white text-3xl" />
                            </div>
                        </div>

                        <div class="flex justify-center items-center w-full relative z-0">
                            <div>
                                <h3 class="font-semibold text-gray-500 dark:text-gray-300 text-xl mb-3 text-center">
                                    {{ selectedB.titulo }}
                                </h3>
                                <div class="h-0.5 w-12 bg-gray-400 mx-auto mb-3"></div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm text-center px-2">
                                    {{ selectedB.descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else
                        class="relative h-80 w-64 border-3 border-dashed rounded-2xl bg-gray-200 dark:bg-gray-800 border-gray-400 dark:border-gray-600 flex flex-col items-center justify-center gap-4 p-6 cursor-not-allowed">
                        <div
                            class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center mb-2">
                            <Icon icon="hugeicons:lock-password" class="text-5xl text-gray-500 dark:text-gray-400" />
                        </div>
                        <p class="font-medium text-gray-500 dark:text-gray-400 text-lg">IVA retenciones.
                            Personas fisicas</p>
                        <p class="text-center text-gray-500 dark:text-gray-400 text-sm">
                            Selecciona un ejercicio de este tipo de obligación.
                        </p>
                    </div>
                </template>
            </ModalFiscal>
        </div>



    </Main>
</template>

<script setup lang='ts'>
import Select from '@/Components/Select.vue';
import Main from '@/Layouts/Main.vue';
import Input from '@/Components/Input.vue';
import Tooltip from '@/Components/Tooltip.vue';
import ModalFiscal from '@/Components/ModalFiscal.vue';

import { Icon } from '@iconify/vue';
import { ref, computed } from "vue";
import { useVuelidate } from "@vuelidate/core";
import {
    required,
    minLength,
    maxLength,
    minValue,
    maxValue,
} from "@vuelidate/validators";

const props = defineProps<{
    catalogo_anios: any[];
    catalogo_periodicidades: any[];
    total_periodos: any[];
    tipos_declaracion: any[];
    ejercicios_impuesto_valor_agregado: any[];
}>();

const formActividad = ref({
    inputRFC: 'XAXX010101000',
    inputCURP: 'XXXXXXXXXXXXXXXXXX',
    inputApellidoPaterno: 'PPP',
    inputApellidoMaterno: 'MMM',
    inputNombres: 'NNN',
    selectedTipoDeclaracion: '',
    selectedEjercicio: '',
    selectedPeriodicidad: '',
    selectedPeriodo: '',
    inputFechaCausacion: ''
});


const dataModal = ref(
    props.ejercicios_impuesto_valor_agregado.map((item) => ({
        id: item.id,
        titulo: item.tipo,
        descripcion: item.descripcion,
        disponible: true,
    }))
);

interface Types {
    id: number;
    titulo: string;
    descripcion: string;
    disponible: boolean;
}
// Obligaciones
// 3
const SeleccionadoA = ref<number | null>(null);
const selectedDataA = ref<Types | null>(null);
const onSelectedA = (tramite: Types) => {
    selectedDataA.value = tramite;
};
const quitarSeleccionA = (event: Event) => {
    event.stopPropagation();
    SeleccionadoA.value = null;
    selectedDataA.value = null;
};
// 1
const SeleccionadoB = ref<number | null>(null);
const selectedDataB = ref<Types | null>(null);
const onSelectedB = (tramite: Types) => {
    selectedDataB.value = tramite;
};
const quitarSeleccionB = (event: Event) => {
    event.stopPropagation();
    SeleccionadoB.value = null;
    selectedDataB.value = null;
};


const filtroPeriodos = computed(() => {
    if (!formActividad.value.selectedPeriodicidad) return [];
    return props.total_periodos.filter(periodo =>
        periodo.periodicidad_id === formActividad.value.selectedPeriodicidad
    );
});

import Wysiwyg from '@/Components/Wysiwyg.vue';
const content = ref<any>();
const handleContentChange = (newContent: string) => {
    content.value = newContent;
    console.log(newContent);
};

</script>

<style scoped>
:deep([style*="font-size: xx-small"]),
:deep([size="1"]) {
    font-size: 0.7rem !important;
}

:deep([style*="font-size: x-small"]),
:deep([size="2"]) {
    font-size: 0.8rem !important;
}

:deep([style*="font-size: small"]),
:deep([size="3"]) {
    font-size: 0.9rem !important;
}

:deep([style*="font-size: medium"]),
:deep([size="4"]) {
    font-size: 1rem !important;
}

:deep([style*="font-size: large"]),
:deep([size="5"]) {
    font-size: 1.2rem !important;
}

:deep([style*="font-size: x-large"]),
:deep([size="6"]) {
    font-size: 1.4rem !important;
}

:deep([style*="font-size: xx-large"]),
:deep([size="7"]) {
    font-size: 1.6rem !important;
}


:deep(blockquote) {
    border-left: 4px solid #e2e8f0;
    padding-left: 1rem;
    margin: 1rem 0;
    color: #4a5568;
}

:deep(pre) {
    background-color: #f7fafc;
    padding: 1rem;
    border-radius: 0.25rem;
    overflow-x: auto;
    font-family: monospace;
}

.bg-white.rounded-lg.shadow-md.p-4.wysiwyg :deep(h1) {
    font-size: 1.875rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.bg-white.rounded-lg.shadow-md.p-4.wysiwyg :deep(h2) {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.25rem;
    margin-bottom: 0.75rem;
}

.bg-white.rounded-lg.shadow-md.p-4.wysiwyg :deep(h3) {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
}

.bg-white.rounded-lg.shadow-md.p-4.wysiwyg :deep(p) {
    margin-bottom: 0.5rem;
}

.bg-white.rounded-lg.shadow-md.p-4.wysiwyg :deep(ul),
.bg-white.rounded-lg.shadow-md.p-4.wysiwyg :deep(ol) {
    padding-left: 1.5rem;
    margin: 0.5rem 0;
}

:deep(ul) {
    list-style-type: disc;
}

:deep(ol) {
    list-style-type: decimal;
}

.bg-white.rounded-lg.shadow-md.p-4 :deep(a) {
    color: #3182ce;
    text-decoration: underline;
}

/* Añadir estilos para el editor cuando está enfocado */
.wysiwyg-editor :deep([contenteditable="true"]:focus) {
    outline: none;
    border-color: #3182ce;
}

/* Efecto de transición suave para los botones al hacer hover */
.wysiwyg-editor button {
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.wysiwyg-editor button:active {
    transform: scale(0.95);
}

/* Estilos para el texto del placeholder */
.wysiwyg-editor .editor-empty[contenteditable="true"]:empty:before {
    content: attr(data-placeholder);
    color: #9ca3af;
    font-style: italic;
    pointer-events: none;
    display: block;
    /* Asegurar que el placeholder se muestre correctamente */
}

/* Estilos para modo solo lectura */
.wysiwyg-editor.readonly {
    opacity: 0.9;
}

.wysiwyg-editor .readonly-editor {
    background-color: #f9fafb;
    cursor: default;
    user-select: text;
}

/* Mejoras de accesibilidad - foco visible para navegación por teclado */
.wysiwyg-editor button:focus-visible {
    outline: 2px solid #3182ce;
    outline-offset: 2px;
}

/* Animación suave para modales */
.wysiwyg-editor .fixed {
    animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}
</style>