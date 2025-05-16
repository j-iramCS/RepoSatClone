<template>
    <Main>

        <div class="py-5 flex gap-1 text-gray-600 dark:text-gray-300">
            <Link :href="route('panel.admin')" class="hover:text-blue-500 hover:underline">Panel-Control</Link>/
            <Link :href="route('panel.admin.urp')" class="hover:text-blue-500 hover:underline font-bold text-blue-500">URP</Link>/
        </div>

        <div class="flex items-center mb-4 gap-4">
            <div
                class="bg-blue-500 dark:bg-gray-900 bg-opacity-20 w-12 h-12 rounded-lg flex items-center justify-center">
                <Icon icon="mingcute:ai-fill" class="text-3xl text-blue-600 dark:text-gray-300" />
            </div>
            <h1 class="text-3xl font-bold dark:text-gray-300">Usuarios, Roles y Permisos</h1>
        </div>
        <p class="text-gray-600 dark:text-gray-300">Administracion de todo el URP</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-5">
            <!-- Caja 1 -->
            <div class="flex gap-2 items-start">
                <!-- Tabs RP -->
                <div class="flex flex-col gap-2 bg-white p-2 rounded-lg shadow-md dark:bg-gray-900">
                    <button @click="tabRP = 'permisos'"
                        class="bg-red-100 dark:bg-opacity-10 p-1 rounded-lg active:scale-90 transition-transform duration-100"
                        title="Agregar nuevo Permiso">
                        <Icon icon="mingcute:key-2-fill" class="text-2xl text-red-500" />
                    </button>
                    <button @click="tabRP = 'roles'"
                        class="bg-green-100 dark:bg-opacity-10 p-1 rounded-lg active:scale-90 transition-transform duration-100"
                        title="Agregar nuevo Rol">
                        <Icon icon="mingcute:box-3-fill" class="text-2xl text-green-500" />
                    </button>
                </div>

                <!-- Contenido principal -->
                <div class="bg-white rounded-lg shadow-md dark:bg-gray-900 w-full">
                    <div v-if="tabRP === 'permisos'" class="relative overflow-hidden px-6 py-4">
                        <div class="absolute -top-40 -left-32 w-64 h-64 bg-red-600/10 rounded-full -z-0"></div>
                        <div class="flex gap-2 items-center">
                            <Icon icon="mingcute:key-2-fill" class="text-2xl text-red-500" />
                            <h1 class="text-xl font-semibold dark:text-white">Crear Permiso</h1>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300">Crear un nuevo permiso para el sistema</p>
                        <Input type="text" v-model="formCrearPermiso.permiso_nombre" custom-class="mt-2" :class="'my-2'"
                            placeholder="Nombre del permiso" clearable />

                        <button @click="crearPermiso"
                            class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                            <Icon icon="mingcute:bookmark-add-fill" class="text-xl" />
                            <p class="m-0 p-0 font-bold text-md">Guardar</p>
                        </button>
                    </div>
                    <div v-if="tabRP === 'roles'" class="relative overflow-hidden px-6 py-4">
                        <div class="absolute -top-40 -left-32 w-64 h-64 bg-green-600/10 rounded-full -z-0"></div>
                        <div class="flex gap-2 items-center">
                            <Icon icon="mingcute:box-3-fill" class="text-2xl text-green-500" />
                            <h1 class="text-xl font-semibold dark:text-white">Crear Rol</h1>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300">Crear un nuevo rol para el sistema</p>
                        <Input type="text" v-model="formCrearRol.rol_nombre" custom-class="mt-2" :class="'my-2'"
                            placeholder="Nombre del Rol" clearable />

                        <button @click="crearRol"
                            class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                            <Icon icon="mingcute:bookmark-add-fill" class="text-xl" />
                            <p class="m-0 p-0 font-bold text-md">Guardar</p>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Caja 2 -->
            <div>
                <!-- Tabs -->
                <div class="border-b dark:border-gray-600 mb-5 flex gap-1 flex-wrap">
                    <button @click="tabActive = 'usuarios'"
                        class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tabActive === 'usuarios'
                            ? 'bg-blue-500 text-white shadow-md'
                            : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                        Usuarios
                    </button>
                    <button @click="tabActive = 'roles'"
                        class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tabActive === 'roles'
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
                    <DataTable :columns="permisosColum" :data="todosPermisos" :items-per-page="5">
                        <!-- Titulo -->
                        <template #title>
                            <div class="flex gap-2 items-center">
                                <Icon icon="mingcute:key-2-fill" class="text-2xl text-red-500" />
                                <p class="dark:text-white px-3 rounded-lg py-1 my-1 font-normal">Permisos
                                </p>
                            </div>
                        </template>
                        <!-- Contenido -->
                        <template #body="{ rows }">
                            <tr v-for="row in rows" :key="row.id">
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                    {{ row.name }}</td>
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                    <Link :href="route('panel.admin.permiso', row.id)"
                                        class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                    <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                    <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                    </Link>
                                </td>
                            </tr>
                        </template>
                    </DataTable>
                </div>
                <div v-if="tabActive === 'roles'">
                    <DataTable :columns="rolesColum" :data="todosRoles" :items-per-page="5">
                        <!-- Titulo -->
                        <template #title>
                            <div class="flex gap-2 items-center">
                                <Icon icon="mingcute:box-3-fill" class="text-2xl text-green-500" />
                                <p class="dark:text-white px-3 rounded-lg py-1 my-1 font-normal">Roles
                                </p>
                            </div>
                        </template>
                        <!-- Contenido -->
                        <template #body="{ rows }">
                            <tr v-for="row in rows" :key="row.id">
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                    {{ row.name }}</td>
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
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
                    <DataTable :columns="usuariosColum" :data="todosUsuarios" :items-per-page="5">
                        <!-- Titulo -->
                        <template #title>
                            <div class="flex gap-2 items-center">
                                <Icon icon="mingcute:group-3-fill" class="text-2xl text-blue-500" />
                                <p class="dark:text-white px-3 rounded-lg py-1 my-1 font-normal">Usuarios
                                </p>
                            </div>
                        </template>
                        <!-- Contenido -->
                        <template #body="{ rows }">
                            <tr v-for="row in rows" :key="row.id">
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                    {{ row.id }}
                                </td>
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                    {{ row.name }}
                                </td>
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                    {{ row.email }}
                                </td>
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                    {{ new Date(row.created_at).toLocaleDateString('es-ES') }}
                                </td>
                                <td
                                    class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
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
            </div>
        </div>


        <div class="bg-white dark:bg-gray-900 p-6 shadow-md rounded-lg dark:text-white">
            <h1 class="text-xl font-semibold dark:text-white">Asignación de roles masivos</h1>
            <div class="grid grid-cols-2 my-5">
                <!-- Roles -->
                <div ref="checksRoles">
                    <h1>Roles</h1>
                    <p class="text-xs">Selecciona N roles</p>
                    <div class="max-h-64 overflow-y-auto">
                        <div v-for="rol in todosRoles" :key="rol.id" class="flex items-center gap-2 my-2">
                            <input type="checkbox" :id="'rol-' + String(rol.id)" class="ml-2" :value="rol.id" />
                            <label :for="'rol-' + String(rol.id)">{{ rol.name }}</label>
                            <Link :href="route('panel.admin.rol', rol.id)" class="">
                            <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                            </Link>
                        </div>
                    </div>

                </div>

                <!-- Usuarios -->
                <div ref="checksUsers">
                    <h1>Usuarios</h1>
                    <p class="text-xs">Seleccionar N usuarios</p>
                    <div class="max-h-64 overflow-y-auto">
                        <div v-for="user in todosUsers" :key="user.id" class="flex items-center gap-2 my-2">
                            <input type="checkbox" :id="'user-' + String(user.id)" class="ml-2" :value="user.id" />
                            <label :for="'user-' + String(user.id)">{{ user.name }}</label>
                            <Link :href="route('panel.admin.usuario', user.id)" class="">
                            <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                            </Link>
                        </div>
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

    </Main>

</template>

<script setup lang='ts'>

// Composables
import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref } from 'vue';
import axios from 'axios';

// Componentes
import Main from '@/Layouts/Main.vue';
import DataTable from '@/Components/DataTable.vue';
import Input from '@/Components/Input.vue';
import ToastLoading from '@/Components/ToastLoading.vue';

import { useToast, POSITION } from "vue-toastification";
const toast = useToast();

// Interfaces
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

// Props
const props = defineProps<{
    todosUsers: User[]; // Todos los usuarios
    todosRoles: Rol[]; // Todos los roles
    todosPermisos: Permiso[]; // Todos los permisos
}>();

const todosUsuarios = ref<User[]>(props.todosUsers);
const todosRoles = ref<Rol[]>(props.todosRoles);
const todosPermisos = ref<User[]>(props.todosPermisos);

// Variables
const tabActive = ref('usuarios');
const tabRP = ref('permisos');
const formCrearPermiso = ref({
    permiso_nombre: '',

});
const formCrearRol = ref({
    rol_nombre: '',
});
const checksUsers = ref<HTMLElement | null>(null);
const checksRoles = ref<HTMLElement | null>(null);

// Columnas de la tablas
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
    { key: 'email', name: 'email', label: 'E-mail', sortable: true },
    { key: 'creado', name: 'creado', label: 'Creado', sortable: true },
    { key: 'acciones', name: 'acciones', label: 'Acciones', sortable: false },
];

// Funciones
const obtenerCheckeadosMasivo = async () => {
    toast.info(ToastLoading, {
        closeOnClick: false,
        hideProgressBar: true,
        timeout: 0,
        draggable: false,
        closeButton: false,
        icon: false,
    });
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
            toast.clear();
            toast.error('Debes seleccionar al menos un usuario y un rol', {
                timeout: 2000,
            });
            return;
        }

        const response = await axios.post(route('panel.admin.guardar.rolesMasivos'), {
            usuarios: usuariosMarcados,
            roles: rolesMarcados
        });

        toast.clear();
        toast.success(response.data.message, {
            timeout: 2000,
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
        toast.clear();
        toast.error(error.response.data.message, {
            timeout: 2000,
        });
    }
};

const crearPermiso = async () => {
    toast.info(ToastLoading, {
        closeOnClick: false,
        hideProgressBar: true,
        timeout: 0,
        draggable: false,
        closeButton: false,
        icon: false,
    });
    try {

        if (formCrearPermiso.value.permiso_nombre == '') {
            toast.clear();
            toast.error('Debes ingresar un nombre para el permiso', {
                timeout: 2000,
            });
            return;
        }
        // panel.admin.crear.permiso
        const response = await axios.post(route('panel.admin.crear.permiso'), {
            name: formCrearPermiso.value.permiso_nombre
        });
        toast.clear();
        toast.success(response.data.message, {
            timeout: 2000,
        });
        formCrearPermiso.value.permiso_nombre = '';
        console.log(response.data.update);
        todosPermisos.value = response.data.update; // Actualiza la lista de todos los permisos
    } catch (error: any) {
        toast.clear();
        toast.error(error.response.data.message, {
            timeout: 2000,
        });
    }
};

const crearRol = async () => {
    toast.info(ToastLoading, {
        closeOnClick: false,
        hideProgressBar: true,
        timeout: 0,
        draggable: false,
        closeButton: false,
        icon: false,
    });
    try {
        if (formCrearRol.value.rol_nombre == '') {
            toast.clear();
            toast.error('Debes ingresar un nombre para el rol', {
                timeout: 2000,
            });
            return;
        }
        const response = await axios.post(route('panel.admin.crear.rol'), {
            name: formCrearRol.value.rol_nombre
        });

        toast.clear();
        toast.success(response.data.message, {
            timeout: 2000,
        });
        formCrearRol.value.rol_nombre = '';
        todosRoles.value = response.data.update; // Actualiza la lista de todos los roles
    } catch (error: any) {
        toast.clear();
        toast.error(error.response.data.message, {
            timeout: 2000,
        });
    }
};





</script>

<style></style>