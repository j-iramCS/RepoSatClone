<template>
    <Main>

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
        <div class="py-6 grid grid-cols-1 lg:grid-cols-2 gap-4 wysiwyg">
            <Wysiwyg :modelValue="content" @change="handleContentChange" />

            <div class="bg-white dark:bg-gray-900 dark:text-white rounded-lg shadow-md p-6">
                <div v-html="content"></div>
            </div>
        </div>

        <p class="text-2xl mt-6 mb-4 dark:text-white">
            Obligaciones a Declarar
        </p>

        <div class="flex flex-wrap gap-2 justify-around mt-4">
            <div class="flex flex-wrap gap-6 justify-center w-full text-white mt-24 lg:mt-6">
                <!-- Componente genérico para cada paso del flujo de selección -->
                <SelectorModal v-for="(paso, index) in pasos" :key="paso.id" :paso="paso" :title="paso.modalTitle" :disponible="paso.disponible"
                    :data="paso.data" v-model="paso.selectedId" @select-item="(item: any) => onItemSelected(index, item)"
                    @remove-selection="(e: any) => quitarSeleccion(e, index)" />
            </div>
        </div>

    </Main>
</template>

<script setup lang='ts'>
import Select from '@/Components/Select.vue';
import Main from '@/Layouts/Main.vue';
import Input from '@/Components/Input.vue';
import SelectorModal from '@/Components/SelectorModal.vue';

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

interface Paso {
    id: string;
    modalTitle: string;
    data: Types[];
    selectedId: number | null;
    selectedData: Types | null;
    label: string;
    placeholder: string;
    disponible: boolean;
}

// card
const pasos = ref<Paso[]>([
    {
        id: '1',
        modalTitle: 'Selecciona un ejercicio que ya tengas creado sobre ISR personas fisicas. Actividad empresarial y profesional',
        data: dataModal.value,
        selectedId: null,
        selectedData: null,
        label: 'Obligación',
        placeholder: 'ISR personas fisicas. Actividad empresarial y profesional.',
        disponible: false
    },
    {
        id: '2',
        modalTitle: 'Selecciona un ejercicio que ya tengas creado sobre ISR retenciones por asimilados',
        data: dataModal.value,
        selectedId: null,
        selectedData: null,
        label: 'Obligación',
        placeholder: 'ISR retenciones por asimilados.',
        disponible: false
    },
    {
        id: '3',
        modalTitle: 'Selecciona un ejercicio que ya tengas creado sobre ISR Personas fisicas. Arrendamiento de inmuebles (uso o goce)',
        data: dataModal.value,
        selectedId: null,
        selectedData: null,
        label: 'Obligación',
        placeholder: 'ISR Personas fisicas. Arrendamiento de inmuebles (uso o goce)',
        disponible: false
    },
    {
        id: '4',
        modalTitle: 'Selecciona un ejercicio que ya tengas creado sobre Impuesto al valor Agregado. Personas fisicas',
        data: dataModal.value,
        selectedId: null,
        selectedData: null,
        label: 'Obligación',
        placeholder: 'Impuesto al valor Agregado. Personas fisicas',
        disponible: true
    },
    {
        id: '5',
        modalTitle: 'Selecciona un ejercicio que ya tengas creado sobre IVA retenciones',
        data: dataModal.value,
        selectedId: null,
        selectedData: null,
        label: 'Obligación',
        placeholder: 'IVA retenciones',
        disponible: false
    },
]);

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