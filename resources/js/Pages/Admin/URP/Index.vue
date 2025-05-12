<template>
    <Main>
        <div
            class="fixed left-0 top-0 right-0 flex justify-between md:hidden items-center bg-gray-50 dark:bg-gray-950 p-3 z-10">
            <Link :href="route('panel.admin')" class="dark:text-gray-300 py-2 px-4">
            <Icon icon="hugeicons:arrow-left-02" class="text-3xl" />
            </Link>
            <h2 class="text-xl font-bold dark:text-gray-300">Administrar Permisos</h2>
        </div>

        <!-- Tabs -->
        <div class="border-b dark:border-gray-600 mb-5 mt-20 md:mt-0 flex gap-1 flex-wrap">
            <button @click="tabActive = 'usuarios'"
                class="px-3 py-2 rounded-t-md transition-all duration-200 ease-in-out" :class="tabActive === 'usuarios'
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                Usuarios
            </button>
            <button @click="tabActive = 'roles'" class="px-3 py-2 rounded-t-md transition-all duration-200 ease-in-out"
                :class="tabActive === 'roles'
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                Roles
            </button>
            <button @click="tabActive = 'permisos'"
                class="px-3 py-2 rounded-t-md transition-all duration-200 ease-in-out" :class="tabActive === 'permisos'
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                Permisos
            </button>
        </div>


        <div v-if="tabActive === 'permisos'">
            <DataTable :columns="permisosColum" :data="props.permisos">
                <!-- Titulo -->
                <template #title>
                    <p class="bg-red-500 text-white px-3 rounded-lg py-1 my-1">Tabla Permisos</p>
                </template>
                <!-- Contenido -->
                <template #body="{ rows }">
                    <tr v-for="row in rows" :key="row.id">
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.name }}</td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                            <button
                                class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:bookmark-edit-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Editar</p>
                            </button>
                            <button
                                class="bg-red-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:delete-2-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Eliminar</p>
                            </button>
                            <button
                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:external-link-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Asignado</p>
                            </button>
                        </td>
                    </tr>
                </template>
            </DataTable>
        </div>
        <div v-if="tabActive === 'roles'">
            <DataTable :columns="rolesColum" :data="props.roles">
                <!-- Titulo -->
                <template #title>
                    <p class="bg-blue-500 text-white px-3 rounded-lg py-1 my-1">Tabla Roles</p>
                </template>
                <!-- Contenido -->
                <template #body="{ rows }">
                    <tr v-for="row in rows" :key="row.id">
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.name }}</td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                            <button
                                class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:bookmark-edit-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Editar</p>
                            </button>
                            <button
                                class="bg-red-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:delete-2-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Eliminar</p>
                            </button>
                            <Link :href="route('panel.admin.rol', row.id)"
                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                            <Icon icon="mingcute:external-link-fill" class="text-xl" />
                            <p class="m-0 p-0 font-bold text-md">Permisos</p>
                            </Link>
                        </td>
                    </tr>
                </template>
            </DataTable>
        </div>

        <div v-if="tabActive === 'usuarios'">
            <DataTable :columns="usuariosColum" :data="props.usuarios">
                <!-- Titulo -->
                <template #title>
                    <p class="bg-blue-500 text-white px-3 rounded-lg py-1 my-1">Tabla Usuarios</p>
                </template>
                <!-- Contenido -->
                <template #body="{ rows }">
                    <tr v-for="row in rows" :key="row.id">
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.id }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.name }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ new Date(row.created_at).toLocaleDateString('es-ES') }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                            <button
                                class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Configuracion</p>
                            </button>
                            <button
                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:key-1-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Roles y Permisos</p>
                            </button>
                        </td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </Main>

</template>

<script setup lang='ts'>
import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref } from 'vue';

import Main from '@/Layouts/Main.vue';
import DataTable from '@/Components/DataTable.vue';

interface Permiso {
    name: string;
}
interface Role {
}
interface Usuario {
}

const props = defineProps<{
    permisos: Permiso[];
    roles: Role[];
    usuarios: Usuario[];
}>();

const permisosColum = [
    { key: 'name', name: 'name', label: 'Nombre', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];
const rolesColum = [
    { key: 'name', name: 'name', label: 'Nombre', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];

const usuariosColum = [
    { key: 'id', name: 'id', label: 'ID', sortable: true },
    { key: 'name', name: 'name', label: 'Nombre', sortable: true },
    { key: 'creado', name: 'creado', label: 'Creado', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];

const tabActive = ref('usuarios');

</script>

<style></style>