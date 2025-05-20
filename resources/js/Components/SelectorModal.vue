<!-- SelectorPaso.vue -->
<template>
    <ModalFiscal :title="title" :data="data" :modelValue="modelValue" :disponible="disponible" @update:modelValue="$emit('update:modelValue', $event)" @select-tramite="onItemSelected">
        <template #button-open="{ selectedDato }">
            <div v-if="selectedDato"
                class="h-64 w-52 group relative overflow-hidden bg-gradient-to-br from-indigo-500 to-indigo-700 dark:from-indigo-700 dark:to-indigo-900 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
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

                <button @click.stop="$emit('remove-selection', $event)"
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
                            {{ selectedDato.titulo }}
                        </h3>
                        <div class="h-0.5 w-12 bg-white/30 mx-auto mb-3"></div>
                        <p class="text-gray-100 dark:text-gray-200 text-sm text-center px-2">
                            {{ selectedDato.descripcion }}
                        </p>
                    </div>
                </div>
            </div>
            <div v-else
                :class="{
                    'relative border-2 h-64 w-52 border-3 border-dashed rounded-2xl bg-white/5 dark:bg-indigo-900/10 border-indigo-300 dark:border-indigo-600 flex flex-col items-center justify-center gap-4 p-6 transition-all duration-300 hover:border-indigo-400 dark:hover:border-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-800/20 transform hover:-translate-y-1 shadow-sm hover:shadow-lg active:scale-90 cursor-pointer': disponible,
                    'relative border-2 h-64 w-52 border-3 border-dashed rounded-2xl bg-gray-200 dark:bg-gray-700 border-gray-400 dark:border-gray-600 flex flex-col items-center justify-center gap-4 p-6 cursor-not-allowed opacity-50': !disponible
                }"
                :tabindex="disponible ? 0 : -1"
                :aria-disabled="!disponible"
            >
                <div
                    class="w-16 h-16 bg-indigo-100 dark:bg-indigo-800/30 rounded-full flex items-center justify-center mb-2">
                    <Icon icon="hugeicons:add-01" class="text-4xl text-indigo-500 dark:text-indigo-300" />
                </div>
                <h3 class="font-medium text-indigo-600 dark:text-indigo-300 text-lg">{{ paso.label }}</h3>
                <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                    {{ paso.placeholder }}
                </p>
            </div>
        </template>
    </ModalFiscal>
</template>

<script setup lang="ts">
import { Icon } from "@iconify/vue";
import ModalFiscal from "@/Components/ModalFiscal.vue";

// Definición de tipos
interface Types {
    id: number;
    titulo: string;
    descripcion: string;
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
    paso: Paso;
    title: string;
    data: Types[];
    modelValue: number | null;
    disponible: boolean;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: number | null): void;
    (e: 'select-item', item: Types): void;
    (e: 'remove-selection', event: Event): void;
}>();

const onItemSelected = (item: Types) => {
    emit('select-item', item);
};
</script>

<style></style>