<template>
    <Main>
        <div class="bg-white dark:bg-gray-900 p-6 shadow-md rounded-lg mt-10 dark:text-white">
            <div class="flex gap-2 items-center">
                <Icon icon="mingcute:android-2-fill" class="text-5xl text-gray-600" />
                <h1 class="text-3xl font-bold">Rol</h1>
            </div>
            <p class="text-blue-500 font-bold text-xl">{{ props.rol.name }}</p>
            <p class="mt-3 text-gray-600 border-b text-base dark:border-gray-600 dark:text-gray-300">Permisos que
                contiene este rol ({{ props.permisosAsignados.length }})
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 my-5 text-base">
                <div v-for="item in props.todosPermisos" :key="item.id" class="flex items-center gap-2">
                    <input type="checkbox" :id="String(item.id)" class="ml-2"
                        :checked="props.permisosAsignados.some((permiso) => permiso.id === item.id)" />
                    <label :for="String(item.id)">{{ item.name }}</label>
                </div>
            </div>

            <div class="border-t">
                <button
                    class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm mt-5">
                    <Icon icon="mingcute:bookmark-add-fill" class="text-xl" />
                    <p class="m-0 p-0 font-bold text-md">Guardar</p>
                </button>
            </div>

        </div>

        <div>
            <DataTable :columns="usersColum" :data="props.usersConRol" class="mt-5">
                <!-- Titulo -->
                <template #title>
                    <p class="dark:text-white px-3 rounded-lg py-1 my-1 font-normal">Usuarios que contienen el rol</p>
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
                            {{ row.email }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                            <button
                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm">
                                <Icon icon="mingcute:user-remove-2-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Quitar rol</p>
                            </button>
                        </td>
                    </tr>
                </template>


            </DataTable>
        </div>

        <!-- {{ props.personasConRol }} -->

    </Main>
</template>

<script setup lang='ts'>
import Main from '@/Layouts/Main.vue';
import DataTable from '@/Components/DataTable.vue';

import { Icon } from '@iconify/vue';

interface Rol {
    name: string;
}
interface Permiso {
    id: number;
    name: string;
}
interface User {
    id: number;
    name: string;
    created_at: string;
}

const props = defineProps<{
    rol: Rol;
    permisosAsignados: Permiso[];
    todosPermisos: Permiso[];
    usersConRol: User[];
}>();


const usersColum = [
    { key: 'id', name: 'id', label: 'ID', sortable: true },
    { key: 'name', name: 'name', label: 'Nombre', sortable: true },
    { key: 'email', name: 'email', label: 'E-mail', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];

</script>

<style></style>