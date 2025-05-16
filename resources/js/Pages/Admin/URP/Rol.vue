<template>
    <Main>

        <div class="py-5 flex gap-1 text-gray-600">
            <Link :href="route('panel.admin')" class="hover:text-blue-500 hover:underline">Panel-Control</Link>/
            <Link :href="route('panel.admin.urp')" class="hover:text-blue-500 hover:underline">URP</Link>/
            <span class="hover:text-blue-500 hover:underline font-bold text-blue-500">Rol - {{ props.rol.name }}</span>/
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-gray-900 p-6 shadow-md rounded-lg dark:text-white">
                <div class="flex gap-2 items-center">
                    <Icon icon="mingcute:box-3-fill" class="text-5xl text-green-500" />
                    <h1 class="text-3xl font-bold text-gray-600">Rol</h1>
                </div>
                <p class="text-blue-500 font-bold text-xl">{{ props.rol.name }}</p>
                <p class="mt-3 text-gray-600 border-b text-base dark:border-gray-600 dark:text-gray-300">Permisos que
                    contiene este rol ({{ props.permisosAsignados.length }})
                </p>

                <div ref="checksPermisos" class="grid grid-cols-1 md:grid-cols-2 gap-2 my-2 text-sm">
                    <div v-for="item in props.todosPermisos" :key="item.id" class="flex items-center gap-2">
                        <input type="checkbox" :id="'permiso-' + String(item.id)" class="ml-2" :value="item.id"
                            :checked="props.permisosAsignados.some((permiso) => permiso.id === item.id)" />
                        <label :for="'permiso-' + String(item.id)">{{ item.name }}</label>
                        <Link :href="route('panel.admin.permiso', item.id)" class="">
                        <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                        </Link>
                    </div>
                </div>

                <div class="border-t flex gap-2">
                    <button @click="obtenerCheckeados()"
                        class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm mt-5 active:scale-90 transition-transform duration-100">
                        <Icon icon="mingcute:bookmark-add-fill" class="text-xl" />
                        <p class="m-0 p-0 font-bold text-md">Aplicar</p>
                    </button>
                    <button @click="eliminarRol()"
                        class="bg-red-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm mt-5 active:scale-90 transition-transform duration-100">
                        <Icon icon="mingcute:delete-2-fill" class="text-xl" />
                        <p class="m-0 p-0 font-bold text-md">Eliminar Rol</p>
                    </button>

                </div>
            </div>

            <DataTable :columns="usersColum" :data="usuariosConRol">
                <!-- Titulo -->
                <template #title>
                    <div class="flex gap-2 items-center">
                        <Icon icon="mingcute:group-3-fill" class="text-2xl text-blue-500" />
                        <p class="dark:text-white px-3 rounded-lg py-1 my-1 font-normal">Usuarios con el Rol
                        </p>
                    </div>
                </template>

                <!-- Contenido -->
                <template #body="{ rows }">
                    <tr v-for="row in usuariosConRol" :key="row.id">
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
                            <button @click="eliminarRolUsuario(props.rol.id, row.id)" title="Eliminar rol del usuario"
                                class="bg-red-500 text-white p-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                <Icon icon="mingcute:delete-2-fill" class="text-lg" />
                                <!-- <p class="m-0 p-0 font-bold text-md">Quitar rol</p> -->
                            </button>

                            <Link :href="route('panel.admin.usuario', row.id)" title="Ver usuario"
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
import ToastLoading from '@/Components/ToastLoading.vue';

import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref } from 'vue';
import axios from 'axios';

import { useToast, POSITION } from "vue-toastification";
const toast = useToast();

interface Rol {
    id: number;
    name: string;
}
interface Permiso {
    id: number;
    name: string;
}
interface User {
    id: number;
    name: string;
    email: string;
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

const checksPermisos = ref<HTMLElement | null>(null);
const obtenerCheckeados = async () => {
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
        const marcados: number[] = [];
        if (checksPermisos.value) {
            const checkboxes = checksPermisos.value.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                const input = checkbox as HTMLInputElement;
                if (input.checked) {
                    marcados.push(Number(input.value));
                }
            });
        }

        // Enviar los checkboxes marcados al servidor
        const response = await axios.post(route('panel.admin.rol.guardarPermisos', props.rol.id), {
            permisos: marcados
        });
        toast.clear();
        toast.success(response.data.message, {
            timeout: 2000,
        });
    } catch (error: any) {
        toast.clear();
        toast.error(error.response.data.message, {
            timeout: 2000,
        });
    }
};

const usuariosConRol = ref<User[]>([...props.usersConRol]);
const eliminarRolUsuario = async (rolId: number, userId: number) => {

    toast.info(ToastLoading, {
        closeOnClick: false,
        hideProgressBar: true,
        timeout: 0,
        draggable: false,
        closeButton: false,
        icon: false,
    });

    try {
        const response = await axios.post(route('panel.admin.eliminar.rol.usuario', [rolId, userId]));

        // Eliminar al usuario de la lista
        usuariosConRol.value = usuariosConRol.value.filter(user => user.id !== userId);
        toast.clear();
        toast.success(response.data.message, {
            timeout: 2000,
        });
    } catch (error: any) {
        toast.clear();
        toast.error(error.response.data.message, {
            timeout: 2000,
        });
    }
};

const eliminarRol = async () => {
    toast.info(ToastLoading, {
        closeOnClick: false,
        hideProgressBar: true,
        timeout: 0,
        draggable: false,
        closeButton: false,
        icon: false,
    });

    try {
        const response = await axios.post(route('panel.admin.eliminar.rol'), {
            id: props.rol.id
        });
        toast.clear();
        toast.success(response.data.message, {
            timeout: 2000,
        });
        setTimeout(() => {
            window.location.href = route('panel.admin.urp');
        }, 500);


    } catch (error: any) {
        toast.clear();
        toast.error(error.response.data.message, {
            timeout: 2000,
        });
    }
};


</script>

<style></style>