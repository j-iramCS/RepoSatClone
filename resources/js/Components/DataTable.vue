<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import { Icon } from '@iconify/vue/dist/iconify.js';

interface Column {
    key: string;
    label: string;
    sortable?: boolean;
}

interface Props {
    columns: Column[];
    data: any[];
    itemsPerPage?: number;
}

const props = defineProps<Props>();
const emit = defineEmits(['row-click']);

// Estado
const searchQuery = ref('');
const currentSort = ref({ key: '', direction: 'asc' });
const currentPage = ref(1);
const itemsPerPage = ref(props.itemsPerPage || 10);

// Filtrado por búsqueda
const filteredData = computed(() => {
    if (!searchQuery.value) return props.data;

    const query = searchQuery.value.toLowerCase();
    return props.data.filter(item => {
        return Object.keys(item).some(key => {
            const value = item[key];
            if (value === null || value === undefined) return false;
            return String(value).toLowerCase().includes(query);
        });
    });
});

// Ordenamiento
const sortedData = computed(() => {
    const data = [...filteredData.value];

    if (!currentSort.value.key) return data;

    return data.sort((a, b) => {
        const valueA = a[currentSort.value.key];
        const valueB = b[currentSort.value.key];

        // Manejar diferentes tipos de datos
        if (typeof valueA === 'string' && typeof valueB === 'string') {
            return currentSort.value.direction === 'asc'
                ? valueA.localeCompare(valueB)
                : valueB.localeCompare(valueA);
        }

        // Para números y otros tipos
        if (currentSort.value.direction === 'asc') {
            return valueA > valueB ? 1 : -1;
        } else {
            return valueA < valueB ? 1 : -1;
        }
    });
});

// Paginación
const paginatedData = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage.value;
    const endIndex = startIndex + itemsPerPage.value;
    return sortedData.value.slice(startIndex, endIndex);
});

const totalPages = computed(() => {
    return Math.ceil(filteredData.value.length / itemsPerPage.value);
});

const pageNumbers = computed(() => {
    const pages = [];
    const maxVisiblePages = 5;

    if (totalPages.value <= maxVisiblePages) {
        for (let i = 1; i <= totalPages.value; i++) {
            pages.push(i);
        }
    } else {
        // Mostrar siempre la primera página
        pages.push(1);

        // Determinar páginas del centro
        let startPage = Math.max(2, currentPage.value - 1);
        let endPage = Math.min(totalPages.value - 1, currentPage.value + 1);

        // Ajustar para mostrar 3 páginas en el medio
        if (startPage === 2) endPage = Math.min(4, totalPages.value - 1);
        if (endPage === totalPages.value - 1) startPage = Math.max(2, totalPages.value - 3);

        // Añadir elipsis si es necesario
        if (startPage > 2) pages.push('...');

        // Añadir páginas del medio
        for (let i = startPage; i <= endPage; i++) {
            pages.push(i);
        }

        // Añadir elipsis si es necesario
        if (endPage < totalPages.value - 1) pages.push('...');

        // Mostrar siempre la última página
        pages.push(totalPages.value);
    }

    return pages;
});

// Métodos
const handleSort = (column: Column) => {
    if (!column.sortable) return;

    if (currentSort.value.key === column.key) {
        currentSort.value.direction = currentSort.value.direction === 'asc' ? 'desc' : 'asc';
    } else {
        currentSort.value = { key: column.key, direction: 'asc' };
    }
};

const goToPage = (page: number) => {
    currentPage.value = page;
};

const handleRowClick = (row: any) => {
    emit('row-click', row);
};

// Reset de la paginación cuando cambia la búsqueda
watch(searchQuery, () => {
    currentPage.value = 1;
});
</script>

<template>
    <div class="w-full bg-white dark:bg-gray-900 rounded-lg shadow-lg">
        <!-- Header con búsqueda -->
        <div
            class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 flex flex-row flex-wrap justify-between items-center gap-2">
            <h2 class="text-lg md:text-base font-semibold text-gray-800 dark:text-gray-100 md:mb-0">
                <slot name="title">Data Table</slot>
            </h2>

            <div class="relative">
                <input v-model="searchQuery" type="text" placeholder="Buscar..."
                    class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100" />
                <Icon icon="hugeicons:search-01"
                    class="dark:text-gray-600 text-gray-300 absolute top-[10px] left-[11px] text-xl" />
            </div>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th v-for="column in columns" :key="column.key" @click="handleSort(column)" :class="[
                            'px-6 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider',
                            column.sortable ? 'cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700' : ''
                        ]">
                            <div class="flex items-center space-x-1 justify-center">
                                <span>{{ column.label }}</span>
                                <span v-if="column.sortable" class="inline-flex flex-col">
                                    <Icon :icon="'material-symbols:arrow-drop-up-rounded'" :class="[
                                        'w-3 h-3',
                                        currentSort.key === column.key && currentSort.direction === 'asc'
                                            ? 'text-blue-500'
                                            : 'text-gray-400'
                                    ]" />
                                    <Icon :icon="'material-symbols:arrow-drop-down-rounded'" :class="[
                                        'w-3 h-3',
                                        currentSort.key === column.key && currentSort.direction === 'desc'
                                            ? 'text-blue-500'
                                            : 'text-gray-400'
                                    ]" />
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    <slot name="body" :rows="paginatedData" :columns="columns">
                        <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex" @click="handleRowClick(row)"
                            class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                            <td v-for="column in columns" :key="`${rowIndex}-${column.key}`"
                                class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                <slot :name="`cell-${column.key}`" :row="row" :value="row[column.key]">
                                    {{ row[column.key] }}
                                </slot>
                            </td>
                        </tr>
                        <tr v-if="!paginatedData.length">
                            <td :colspan="columns.length"
                                class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                No se encontraron registros
                            </td>
                        </tr>
                    </slot>
                </tbody>

            </table>
        </div>

        <!-- Paginación -->
        <div
            class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between">
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3 sm:mb-0">
                <span>Mostrando {{ (currentPage - 1) * itemsPerPage + 1 }} a {{ Math.min(currentPage * itemsPerPage,
                    filteredData.length) }} de {{ filteredData.length }} resultados</span>
            </div>

            <div class="flex items-center space-x-1 flex-wrap">
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                    class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    :class="{ 'bg-white dark:bg-gray-800': currentPage !== 1, 'bg-gray-100 dark:bg-gray-700': currentPage === 1 }">
                    Anterior
                </button>

                <button v-for="page in pageNumbers" :key="page" @click="typeof page === 'number' && goToPage(page)"
                    :disabled="page === '...'" :class="[
                        'px-3 py-1 rounded-md border text-sm',
                        page === currentPage
                            ? 'bg-blue-500 border-blue-500 text-white'
                            : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300'
                    ]">
                    {{ page }}
                </button>

                <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                    class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    :class="{ 'bg-white dark:bg-gray-800': currentPage !== totalPages, 'bg-gray-100 dark:bg-gray-700': currentPage === totalPages }">
                    Siguiente
                </button>
            </div>
        </div>
    </div>
</template>