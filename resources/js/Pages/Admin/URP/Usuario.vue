<template>
    <Main>

        <div class="py-5 flex gap-1 text-gray-600 dark:text-green-300">
            <Link :href="route('panel.admin')" class="hover:text-blue-500 hover:underline">Inicio</Link>/
            <Link :href="route('panel.admin.urp')" class="hover:text-blue-500 hover:underline">URP</Link>/
        </div>

        <div class="mb-8">
            <div class="flex items-center mb-4 gap-4">
                <div
                    class="bg-blue-500 dark:bg-gray-900 bg-opacity-20 w-12 h-12 rounded-lg flex items-center justify-center">
                    <Icon icon="mingcute:ai-fill" class="text-3xl text-blue-600 dark:text-gray-300" />
                </div>
                <h1 class="text-3xl font-bold dark:text-gray-300">Administración del Usuario</h1>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-900 p-6 shadow-md rounded-lg dark:text-white">
            <div class="flex gap-2 items-center">
                <Icon icon="mingcute:user-3-fill" class="text-5xl text-blue-500" />
                <div class="">
                    <p class="uppercase font-bold text-xl">{{ props.usuario.name }}</p>
                    <p class="text-gray-500">{{ props.usuario.email }}</p>
                </div>
            </div>

            <p class="pt-5">Fecha del registro</p>
            <p class="text-gray-500">
                {{ new Date(props.usuario.created_at).toLocaleDateString('es-ES') }}
            </p>
        </div>

        <!-- Tabs -->
        <div class="border-b dark:border-gray-600 mb-5 flex gap-1 flex-wrap mt-5">
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

        <div v-if="tabActive === 'roles'">
            <p
                class="mb-5 text-sm text-gray-700 dark:text-gray-300 bg-blue-50 dark:bg-gray-800 border-l-4 border-blue-500 p-4 rounded-md">
                Aquí se muestran todos los roles disponibles. Los que están marcados ya están asignados al usuario.
                Marca o desmarca para agregar o quitar roles.
            </p>

            <div ref="checksRoles" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="item in props.todosRoles" :key="item.id" class="flex items-center gap-2">
                    <input type="checkbox" :id="'rol-' + String(item.id)" class="ml-2" :value="item.id"
                        :checked="props.roles.some((rol) => rol.id === item.id)" />
                    <label :for="'rol-' + String(item.id)">{{ item.name }}</label>
                    <Link :href="route('panel.admin.rol', item.id)" class="">
                    <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                    </Link>
                </div>
            </div>

            <div class="border-t mt-5">
                <button @click="checkeadosRoles"
                    class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm mt-5 active:scale-90 transition-transform duration-100">
                    <Icon icon="mingcute:bookmark-add-fill" />
                    <p class="m-0 p-0 font-bold">Guardar</p>
                </button>
            </div>

        </div>
        <div v-if="tabActive === 'permisos'">
            <p
                class="mb-5 text-sm text-gray-700 dark:text-gray-300 bg-blue-50 dark:bg-gray-800 border-l-4 border-blue-500 p-4 rounded-md">
                Aquí se muestran todos los permisos disponibles. Los que están marcados ya están asignados al usuario.
                Marca o desmarca para agregar o quitar permisos. <span class="font-bold">Si un rol ya cuenta con un
                    permiso, lo ideal es no asignarlo directamente. Primero verifica si dicho permiso ya está asociado a
                    un rol.
                </span>
            </p>

            <div ref="checksPermisos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="item in props.todosPermisos" :key="item.id" class="flex items-center gap-2">
                    <input type="checkbox" :id="'permiso-' + String(item.id)" class="ml-2" :value="item.id"
                        :checked="props.permisos.some((permiso) => permiso.id === item.id)" />
                    <label :for="'permiso-' + String(item.id)">{{ item.name }}</label>
                    <Link :href="route('panel.admin.permiso', item.id)" class="">
                    <Icon icon="mingcute:external-link-line" class="text-blue-500" />
                    </Link>
                </div>
            </div>

            <div class="border-t mt-5">
                <button @click="checkeadosPermisos"
                    class="bg-blue-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm mt-5 active:scale-90 transition-transform duration-100">
                    <Icon icon="mingcute:bookmark-add-fill" />
                    <p class="m-0 p-0 font-bold">Guardar</p>
                </button>
            </div>

        </div>
    </Main>
</template>

<script setup lang='ts'>
import Main from '@/Layouts/Main.vue';
import ToastLoading from '@/Components/ToastLoading.vue';

// Composables
import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref } from 'vue';
import axios from 'axios';
import { useToast, POSITION } from "vue-toastification";
const toast = useToast();

interface User {
    id: number;
    name: string;
    email: string;
    created_at: string;
}

const props = defineProps<{
    usuario: User;
    roles: Array<any>;
    permisos: Array<any>;
    todosRoles: Array<any>;
    todosPermisos: Array<any>;
}>();

const tabActive = ref<string>('roles');

const checksRoles = ref<HTMLElement | null>(null);
const checkeadosRoles = async () => {
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
        if (checksRoles.value) {
            const checkboxes = checksRoles.value.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                const input = checkbox as HTMLInputElement;
                if (input.checked) {
                    marcados.push(Number(input.value));
                }
            });
        }

        // Enviar los datos al servidor
        const response = await axios.post(route('panel.admin.guardar.roles'), {
            usuario: props.usuario.id,
            roles: marcados,
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

const checksPermisos = ref<HTMLElement | null>(null);
const checkeadosPermisos = async () => {
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
        const response = await axios.post(route('panel.admin.guardar.permisos'), {
            usuario: props.usuario.id,
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



</script>

<style></style>