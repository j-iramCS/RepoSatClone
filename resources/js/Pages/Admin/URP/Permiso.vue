<template>
    <Main>

        <div class="py-5 flex gap-1 text-gray-600">
            <Link :href="route('panel.admin')" class="hover:text-blue-500 hover:underline">Inicio</Link>/
            <Link :href="route('panel.admin.urp')" class="hover:text-blue-500 hover:underline">URP</Link>/
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-gray-900 p-6 shadow-md rounded-lg dark:text-white">
                <div class="flex gap-2 items-center">
                    <Icon icon="mingcute:key-2-fill" class="text-5xl text-red-500" />
                    <h1 class="text-3xl font-bold text-gray-600">Permiso</h1>
                </div>
                <p class="text-blue-500 font-bold text-xl">{{ props.permiso.name }}</p>
                <p class="mt-3 text-gray-600 border-b text-base dark:border-gray-600 dark:text-gray-300">Este permiso se
                    encuentra en ({{ props.roles.length }}) roles
                </p>

                <div ref="checksRoles" class="grid grid-cols-1 md:grid-cols-2 gap-2 my-2 text-sm">
                    <div v-for="item in props.todosRoles" :key="item.id" class="flex items-center gap-2">
                        <input type="checkbox" :id="'permiso-' + String(item.id)" class="ml-2" :value="item.id"
                            :checked="props.roles.some((rol) => rol.id === item.id)" />
                        <label :for="'permiso-' + String(item.id)">{{ item.name }}</label>
                        <Link :href="route('panel.admin.rol', item.id)" class="">
                        <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                        </Link>
                    </div>
                </div>

                <div class="border-t">
                    <button @click="guardarCheckRoles"
                        class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm mt-5 active:scale-90 transition-transform duration-100">
                        <Icon icon="mingcute:bookmark-add-fill" class="text-xl" />
                        <p class="m-0 p-0 font-bold text-md">Guardar</p>
                    </button>
                </div>


            </div>

            <DataTable :columns="rolesColum" :data="roles">
                <!-- Titulo -->
                <template #title>
                    <div class="flex gap-2 items-center">
                        <Icon icon="mingcute:box-3-fill" class="text-green-500 text-2xl" />
                        <p class="dark:text-white px-3 rounded-lg py-1 my-1 font-normal">Roles con el permiso</p>
                    </div>
                </template>

                <!-- Contenido -->
                <template #body="{ rows }">
                    <tr v-if="isLoading">
                        <td colspan="4" class="text-center py-4 flex gap-2">
                            <Icon icon="line-md:loading-loop" class="text-2xl animate-spin text-blue-500" />
                            <p class="text-sm text-gray-500 dark:text-gray-300">Actualizando...</p>
                        </td>
                    </tr>
                    <tr v-for="row in roles" :key="row.id" v-else>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.id }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.name }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                            <button @click="" title="Eliminar rol del usuario"
                                class="bg-red-500 text-white p-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                <Icon icon="mingcute:delete-2-fill" class="text-lg" />
                                <!-- <p class="m-0 p-0 font-bold text-md">Quitar rol</p> -->
                            </button>

                            <Link :href="route('panel.admin.rol', row.id)" title="Ver Rol"
                                class="bg-blue-500 text-white p-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                            <Icon icon="mingcute:external-link-line" class="text-lg" />
                            <!-- <p class="m-0 p-0 font-bold text-md">Ver usuario</p> -->
                            </Link>

                        </td>
                    </tr>
                </template>


            </DataTable>
        </div>
        <!-- {{ props.rol }} -->

    </Main>
</template>

<script setup lang='ts'>
import Main from '@/Layouts/Main.vue';
import DataTable from '@/Components/DataTable.vue';

import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import axios from 'axios';

interface Rol {
    id: number;
    name: string;
}
interface Permiso {
    id: number;
    name: string;
}

const props = defineProps<{
    permiso: Permiso;
    roles: Rol[];
    todosRoles: Rol[];
}>();

const rolesColum = [
    { key: 'id', name: 'id', label: 'ID', sortable: true },
    { key: 'name', name: 'name', label: 'Nombre', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];
const isLoading = ref(false);

const checksRoles = ref<HTMLElement | null>(null);
    const guardarCheckRoles = async () => {
    try {
        // Obtener los checkboxes marcados
        const marcados: number[] = [];
        if (checksRoles.value) {
            const checkboxes = checksRoles.value.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                const input = checkbox as HTMLInputElement;
                if (input.checked) {
                    marcados.push(Number(input.value));
                }
            });
        }

        // Enviar los checkboxes marcados al servidor
        const response = await axios.post(route('panel.admin.permiso.guardarRol', props.permiso.id), {
            roles: marcados
        });
        console.log(response.data);
        toast(response.data.message, {
            theme: "dark",
            type: "success",
            position: "bottom-center"
        });
    } catch (error: any) {
        console.error(error);
        toast(error.response.data.message, {
            theme: "dark",
            type: "error",
            position: "bottom-center"
        });
    }
};



</script>

<style></style>