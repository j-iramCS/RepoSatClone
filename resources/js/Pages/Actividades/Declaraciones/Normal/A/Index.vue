<template>
    <Main>
        <h2 class="text-xl font-bold mb-4 dark:text-white">
            Datos de Identificación
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
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
                            placeholder="Ingrese su RFC" clearable default-value="XXXXXXXXXXXXXXXXXX" :required="true"
                            :rules="{
                                maxLength: maxLength(18),
                                minLength: minLength(18),
                            }" />
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
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

        <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
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
    </Main>
</template>

<script setup lang='ts'>
import Select from '@/Components/Select.vue';
import Main from '@/Layouts/Main.vue';
import Input from '@/Components/Input.vue';

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


const filtroPeriodos = computed(() => {
    if (!formActividad.value.selectedPeriodicidad) return [];
    return props.total_periodos.filter(periodo =>
        periodo.periodicidad_id === formActividad.value.selectedPeriodicidad
    );
});

</script>

<style></style>