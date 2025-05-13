<template>
    <Main>
        <div
            class="fixed left-0 top-0 right-0 flex justify-between md:hidden items-center bg-gray-50 dark:bg-gray-950 p-3 z-10">
            <Link :href="route('panel.admin')" class="dark:text-gray-300 py-2 px-4">
            <Icon icon="hugeicons:arrow-left-02" class="text-3xl" />
            </Link>
            <h2 class="text-xl font-bold dark:text-gray-300">Administrar Permisos</h2>
        </div>

        <div class="bg-white dark:bg-gray-900 p-6 shadow-md rounded-lg dark:text-white mt-20 md:mt-0">
            <h1 class="text-2xl font-semibold text-gray-600 dark:text-white">Asignación de roles masivos</h1>
            <p class="text-xs">Selecciona a N usuarios y N roles para asignarse en conjunto</p>
            <div class="grid grid-cols-2 my-5">
                <!-- Roles -->
                <div ref="checksRoles">
                    <h1>Roles</h1>
                    <p class="text-xs">Todos los roles creados actualmente</p>
                    <div v-for="rol in props.todosRoles" :key="rol.id" class="flex items-center gap-2 my-2">
                        <input type="checkbox" :id="'rol-' + String(rol.id)" class="ml-2" :value="rol.id" />
                        <label :for="'rol-' + String(rol.id)">{{ rol.name }}</label>
                        <Link :href="route('panel.admin.rol', rol.id)" class="">
                        <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                        </Link>
                    </div>
                </div>

                <!-- Usuarios -->
                <div ref="checksUsers">
                    <h1>Usuarios</h1>
                    <p class="text-xs">Todos los usuarios disponibles actualmente</p>
                    <div v-for="user in props.todosUsers" :key="user.id" class="flex items-center gap-2 my-2">
                        <input type="checkbox" :id="'user-' + String(user.id)" class="ml-2" :value="user.id" />
                        <label :for="'user-' + String(user.id)">{{ user.name }}</label>
                        <Link :href="route('panel.admin.usuario', user.id)" class="">
                        <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                        </Link>
                    </div>
                </div>
            </div>

            <div>
                <button @click="obtenerCheckeadosMasivo"
                    class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm mt-5 active:scale-90 transition-transform duration-100">
                    <Icon icon="mingcute:bookmark-add-fill" class="text-xl" />
                    <p class="m-0 p-0 font-bold text-md">Guardar</p>
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b dark:border-gray-600 mb-5 flex gap-1 flex-wrap mt-5">
            <button @click="tabActive = 'usuarios'"
                class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tabActive === 'usuarios'
                    ? 'bg-blue-500 text-white shadow-md'
                    : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                Usuarios
            </button>
            <button @click="tabActive = 'roles'" class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100"
                :class="tabActive === 'roles'
                    ? 'bg-blue-500 text-white shadow-md'
                    : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                Roles
            </button>
            <button @click="tabActive = 'permisos'"
                class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tabActive === 'permisos'
                    ? 'bg-blue-500 text-white shadow-md'
                    : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                Permisos
            </button>
        </div>

        <div v-if="tabActive === 'permisos'">
            <DataTable :columns="permisosColum" :data="props.permisos">
                <!-- Titulo -->
                <template #title>
                    <p>Todos los Permisos</p>
                </template>
                <!-- Contenido -->
                <template #body="{ rows }">
                    <tr v-for="row in rows" :key="row.id">
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.name }}</td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                            <button disabled
                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100 cursor-not-allowed">
                                <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                <p class="m-0 p-0 font-bold text-md">Ajustes</p>
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
                    <p>Todos los Roles</p>
                </template>
                <!-- Contenido -->
                <template #body="{ rows }">
                    <tr v-for="row in rows" :key="row.id">
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                            {{ row.name }}</td>
                        <td
                            class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                            <Link :href="route('panel.admin.rol', row.id)"
                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
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
                    <p>Todos los Usuarios</p>
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
                            <Link :href="route('panel.admin.usuario', row.id)"
                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                            </Link>
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
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import axios from 'axios';

import Main from '@/Layouts/Main.vue';
import DataTable from '@/Components/DataTable.vue';

interface Permiso {
    id: number;
    name: string;
}
interface Rol {
    id: number;
    name: string;
}
interface User {
    id: number;
    name: string;
}

const props = defineProps<{
    permisos: Permiso[];
    roles: Rol[];
    usuarios: User[];
    todosUsers: User[];
    todosRoles: Rol[];
}>();

const permisosColum = [
    { key: 'name', name: 'name', label: 'Permiso', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];
const rolesColum = [
    { key: 'name', name: 'name', label: 'Rol', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];
const usuariosColum = [
    { key: 'id', name: 'id', label: 'ID', sortable: true },
    { key: 'name', name: 'name', label: 'Nombre de Usuario', sortable: true },
    { key: 'creado', name: 'creado', label: 'Creado', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];

const tabActive = ref('usuarios');


const checksUsers = ref<HTMLElement | null>(null);
const checksRoles = ref<HTMLElement | null>(null);

const obtenerCheckeadosMasivo = async () => {
    try {
        // Obtener los checkboxes marcados
        const usuariosMarcados: number[] = [];
        if (checksUsers.value) {
            const checkboxes = checksUsers.value.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                const input = checkbox as HTMLInputElement;
                if (input.checked) {
                    usuariosMarcados.push(Number(input.value));
                }
            });
        }

        const rolesMarcados: number[] = [];
        if (checksRoles.value) {
            const checkboxes = checksRoles.value.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                const input = checkbox as HTMLInputElement;
                if (input.checked) {
                    rolesMarcados.push(Number(input.value));
                }
            });
        }

        if (usuariosMarcados.length == 0 || rolesMarcados.length == 0) {
            toast('Debes seleccionar al menos un usuario y un rol', {
                theme: "dark",
                type: "error"
            });
            return;
        }

        const response = await axios.post(route('panel.admin.guardar.rolesMasivos'), {
            usuarios: usuariosMarcados,
            roles: rolesMarcados
        });

        toast(response.data.message, {
            theme: "dark",
            type: "success"
        });

        // Limpiar los checkboxes
        if (checksUsers.value) {
            const checkboxes = checksUsers.value.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                const input = checkbox as HTMLInputElement;
                input.checked = false;
            });
        }
        if (checksRoles.value) {
            const checkboxes = checksRoles.value.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                const input = checkbox as HTMLInputElement;
                input.checked = false;
            });
        }

    } catch (error: any) {
        console.error(error);
        toast(error.response.data.message, {
            theme: "dark",
            type: "error"
        });
    }
};



</script>

<style></style>