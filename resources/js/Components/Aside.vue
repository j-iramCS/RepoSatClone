<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted, computed } from 'vue';
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

// Propiedades para el manejo del sidebar
defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close", "toggleSidebar"]);

// Estado para el menú inferior tipo sheet
const isBottomSheetOpen = ref(false);

// Cierra el sidebar tradicional
const closeSidebar = () => {
    emit("close");
};

// Abre/cierra el bottom sheet
const toggleBottomSheet = () => {
    isBottomSheetOpen.value = !isBottomSheetOpen.value;

    // Si está abriendo el bottom sheet, aplicar clase para evitar scroll
    if (isBottomSheetOpen.value) {
        document.body.classList.add('overflow-hidden');
    } else {
        document.body.classList.remove('overflow-hidden');
    }
};

// Lógica para el modo oscuro
const darkMode = ref(localStorage.getItem('darkMode') === 'true');

function toggleDarkMode() {
    darkMode.value = !darkMode.value;
    localStorage.setItem('darkMode', darkMode.value.toString());

    // Aplicar clase dark al elemento HTML
    if (darkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

// Estado actual de la ruta para resaltar la navegación activa
const currentRoute = ref(route().current());
// console.log(currentRoute.value);


// Menú de navegación centralizado para reutilización
const navigationItems = [
    {
        name: 'Inicio',
        route: 'dashboard',
        icon: 'hugeicons:home-05',
        active: computed(() => currentRoute.value === 'dashboard')
    },
    {
        name: 'Grupos',
        route: 'dashboard', // Cambiar a la ruta real de grupos
        icon: 'hugeicons:add-team',
        active: computed(() => currentRoute.value === 'groups')
    },
];

// Enlaces adicionales para el bottom sheet
const additionalLinks = [
    { name: 'Configuración', route: 'dashboard', icon: 'uil:setting' },
    { name: 'Estadísticas', route: 'dashboard', icon: 'uil:chart-pie' },
    { name: 'Favoritos', route: 'dashboard', icon: 'uil:favorite' },
    { name: 'Ayuda', route: 'dashboard', icon: 'uil:question-circle' }
];

// Inicializar el modo oscuro al cargar el componente
onMounted(() => {
    if (darkMode.value) {
        document.documentElement.classList.add('dark');
    }
});
</script>

<template>
    <div class="app-container h-screen flex flex-col">
        <!-- Sidebar SOLO para escritorio -->
        <div :class="[
            'fixed inset-y-0 bottom-0 left-0 z-30 w-64 transform transition-transform duration-300 ease-in-out dark:bg-[#171b2e] bg-white shadow-lg',
            'hidden md:block md:translate-x-0', // Solo visible en desktop
        ]">
            <div class="flex-1 flex flex-col h-full relative z-10">
                <!-- Logo -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <h1 class="font-bold text-2xl flex gap-2 items-center dark:text-white">
                            <!-- <Icon icon="hugeicons:alpha" class="text-red-500 text-2xl" /> -->
                            Proyecto
                        </h1>
                        <!-- <Icon icon="game-icons:axolotl" class="text-blue-500 text-3xl" /> -->
                    </div>
                </div>

                <!-- Acciones (desktop only) -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">

                    <div class="flex gap-2">
                        <div class="h-8 w-8 overflow-hidden rounded-full min-w-8">
                            <img src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg" alt="Avatar"
                                class="h-full w-full object-cover" />
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium dark:text-gray-300 m-0 p-0">Usuario</p>
                            <div class="flex items-center">
                                <p class="text-xs text-gray-600 dark:text-gray-300 p-0 m-0 truncate"
                                    title="usuarioa@gmail.com" style="max-width: 50px;">
                                    castiyo0429
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-300 p-0 m-0">@gmail.com</p>
                            </div>
                        </div>
                        <div class="flex justify-end items-center w-full">
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                                <Icon icon="heroicons:bell" class="text-lg" />
                            </button>

                            <button @click="toggleDarkMode"
                                class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                                <Icon :icon="darkMode ? 'ph:sun' : 'ph:moon'" class="text-lg" />
                            </button>
                        </div>
                    </div>

                </div>

                <div class="h-full overflow-y-auto mt-2">
                    <!-- Navegación principal -->
                    <nav class="space-y-1 px-2">


                        <Can permission="panel-control">
                            <Link :href="route('panel.admin')"
                                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                            <Icon icon="hugeicons:user-settings-01" class="text-xl" />
                            <span>Panel de Control</span>
                            </Link>
                        </Can>

                        <div v-for="item in navigationItems" :key="item.name">
                            <Link :href="route(item.route)" :class="[
                                'flex items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors',
                                item.active
                                    ? ''
                                    : ''
                            ]">
                            <Icon :icon="item.icon" class="text-xl" />
                            <span>{{ item.name }}</span>
                            </Link>
                        </div>

                        <div class="py-3">
                            <div class="px-3 text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                Collections
                            </div>
                            <div class="mt-2 space-y-1">
                                <!-- Añadir colecciones aquí -->
                                <div v-for="link in additionalLinks" :key="link.name">
                                    <Link :href="route(link.route)"
                                        class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                                    <Icon :icon="link.icon" class="text-xl" />
                                    <span>{{ link.name }}</span>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- Footer del sidebar -->
                <div class="mt-auto p-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <!-- <button @click="toggleDarkMode"
                            class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                            <Icon :icon="darkMode ? 'ph:sun' : 'ph:moon'" class="text-lg" />
                            <span>{{ darkMode ? 'Modo claro' : 'Modo oscuro' }}</span>
                        </button> -->

                        <ResponsiveNavLink :href="route('logout')" method="post" as="button"
                            class="flex font-bold items-center gap-1 rounded-md px-3 py-2 text-sm text-red-600 hover:bg-red-100 dark:hover:bg-red-900 dark:text-red-400 transition-colors w-full dark:hover:text-white">
                            <Icon icon="hugeicons:logout-02" class="text-xl" />
                            <span>Cerrar Sesión</span>
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header para escritorio -->
        <header
            class="fixed top-0 right-0 z-20 items-center justify-between px-4 py-4 md:px-6 left-0 bg-white dark:bg-[#171b2e] hidden">
            <!-- Mobile logo y menú -->
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2">
                    <div class="flex items-center">
                        <h1 class="text-indigo-500 font-bold text-2xl flex gap-2 items-center dark:text-white">
                            <!-- <Icon icon="hugeicons:alpha" class="text-red-500 text-2xl" /> -->
                            Proyecto
                        </h1>
                        <!-- <Icon icon="game-icons:axolotl" class="text-blue-500 text-3xl" /> -->
                    </div>
                </div>
            </div>

            <!-- Acciones (desktop only) -->
            <div class="hidden md:flex items-center gap-4">
                <button
                    class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                    <Icon icon="heroicons:bell" class="text-xl" />
                </button>

                <button @click="toggleDarkMode"
                    class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                    <Icon :icon="darkMode ? 'ph:sun' : 'ph:moon'" class="text-xl" />
                </button>

                <div class="h-8 w-8 overflow-hidden rounded-full">
                    <img src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg" alt="Avatar"
                        class="h-full w-full object-cover" />
                </div>
            </div>
        </header>

        <!-- Contenido principal -->
        <main class="flex-grow pt-16 md:pl-64">
            <!-- Aquí va el contenido de tu aplicación -->
            <div class="h-full overflow-y-auto">
                <slot></slot>
            </div>
        </main>

        <!-- Navegación de tipo app para móviles -->
        <nav class="md:hidden fixed bottom-0 inset-x-0 z-30 dark:bg-[#171b2e] shadow-lg bg-white dark:text-white">
            <div class="flex justify-around items-center h-16">
                <Link v-for="(item, index) in navigationItems.slice(0, 3)" :key="item.name" :href="route(item.route)"
                    :class="[
                        'flex flex-col items-center justify-center flex-1 py-2 px-1',
                        item.active
                            ? ''
                            : ''
                    ]">
                <div :class="[
                    'p-1 rounded-full transition-colors',
                    item.active
                        ? ''
                        : ''
                ]">
                    <Icon :icon="item.icon" class="text-2xl" />
                </div>
                <span class="text-xs mt-1">{{ item.name }}</span>
                </Link>

                <!-- Botón para abrir el Bottom Sheet -->
                <button @click="toggleBottomSheet"
                    class="flex flex-col items-center justify-center flex-1 py-2 px-1 text-gray-600 dark:text-gray-400">
                    <div :class="[
                        'p-1 rounded-full transition-colors',
                        isBottomSheetOpen
                            ? 'bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-400'
                            : ''
                    ]">
                        <Icon icon="heroicons:ellipsis-horizontal" class="text-2xl" />
                    </div>
                    <span class="text-xs mt-1">Más</span>
                </button>
            </div>
        </nav>

        <!-- Bottom Sheet Menu para móviles -->
        <div v-if="isBottomSheetOpen" class="md:hidden fixed inset-0 z-40 bg-black bg-opacity-50"
            @click="toggleBottomSheet">
        </div>
        <div :class="[
            'md:hidden fixed bottom-0 inset-x-0 z-50 bg-white dark:bg-[#171b2e] rounded-t-3xl shadow-lg',
            'transform transition-transform duration-300 ease-out',
            isBottomSheetOpen ? 'translate-y-0' : 'translate-y-full'
        ]" style="max-height: 75vh; overflow-y: auto;">
            <!-- Indicador de arrastre -->
            <div class="w-full flex justify-center pt-2 pb-4">
                <div class="w-12 h-1.5 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
            </div>

            <!-- Usuario y acciones rápidas -->
            <div class="px-6 pb-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="h-14 w-14 overflow-hidden rounded-full border-2 border-indigo-500">
                        <img src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg" alt="Avatar"
                            class="h-full w-full object-cover" />
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-medium dark:text-white">Usuario</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">user@example.com</span>
                    </div>
                </div>

                <button @click="toggleDarkMode"
                    class="p-3 bg-gray-100 dark:bg-slate-700 rounded-full text-gray-600 dark:text-gray-300">
                    <Icon :icon="darkMode ? 'ph:sun' : 'ph:moon'" class="text-xl" />
                </button>
            </div>

            <!-- Opciones adicionales -->
            <div class="p-4">
                <div class="grid grid-cols-2 gap-3">
                    <Link v-for="link in additionalLinks" :key="link.name" :href="route(link.route)"
                        class="flex items-center gap-2 p-3 rounded-xl bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-300">
                    <div class="p-2 bg-white dark:bg-slate-800 rounded-lg">
                        <Icon :icon="link.icon" class="text-xl text-indigo-500" />
                    </div>
                    <span class="font-medium">{{ link.name }}</span>
                    </Link>
                </div>

                <!-- Accesos directos -->
                <div class="mt-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2 px-1">ACCESOS RÁPIDOS</h3>
                    <div class="space-y-1">
                        <Link :href="route('dashboard')"
                            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300">
                        <div class="flex items-center gap-2">
                            <Icon icon="heroicons:star" class="text-yellow-500 text-xl" />
                            <span>Mis favoritos</span>
                        </div>
                        <Icon icon="heroicons:chevron-right" class="text-gray-400" />
                        </Link>

                        <Link :href="route('dashboard')"
                            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300">
                        <div class="flex items-center gap-2">
                            <Icon icon="heroicons:document-text" class="text-blue-500 text-xl" />
                            <span>Mis documentos</span>
                        </div>
                        <Icon icon="heroicons:chevron-right" class="text-gray-400" />
                        </Link>
                    </div>
                </div>

                <!-- Botón de cerrar sesión -->
                <div class="mt-6 pb-6">
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button"
                        class="w-full flex items-center justify-center gap-2 p-3 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-xl font-medium">
                        <Icon icon="ic:baseline-logout" class="text-lg" />
                        <span>Cerrar Sesión</span>
                    </ResponsiveNavLink>
                </div>
            </div>
        </div>
    </div>
</template>