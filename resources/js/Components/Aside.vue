<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from 'vue';
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

// Propiedades para el manejo del sidebar
defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close", "toggleSidebar"]);

const closeSidebar = () => {
    emit("close");
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

// Inicializar el modo oscuro al cargar el componente
onMounted(() => {
    if (darkMode.value) {
        document.documentElement.classList.add('dark');
    }
});
</script>

<template>
    <div>
        <!-- Sidebar -->
        <div
            :class="[
                'fixed inset-y-0 left-0 z-30 w-64 transform transition-transform duration-300 md:bg-transparent ease-in-out border-r border-gray-300 dark:border-gray-600',
                isOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0',
            ]"
        >
            <div class="flex-1 flex flex-col relative z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex gap-2">
                        <h1 class="dark:text-white font-bold text-2xl">
                            SAT<span class="text-green-500">y</span>
                        </h1>
                        <Icon
                            icon="game-icons:axolotl"
                            class="text-blue-500 text-3xl"
                        />
                    </div>
                    <button
                        class="md:hidden flex justify-center p-2 hover:bg-slate-900 rounded-lg"
                        @click="closeSidebar"
                    >
                        <Icon
                            icon="ri:close-large-line"
                            class="text-red-500 text-xl"
                        />
                    </button>
                </div>
                
                <p class="border-b border-slate-300 dark:border-slate-600"></p>
                
                <div class="h-full overflow-y-auto mt-4">
                    <nav class="space-y-1 px-2">
                        <Link
                            :href="route('dashboard')"
                            class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-slate-500 hover:text-white hover:bg-indigo-500 hover:dark:bg-slate-700"
                        >
                            <Icon icon="hugeicons:home-05" class="text-xl" />
                            <span>Inicio</span>
                        </Link>
                        
                        <Link
                            :href="route('dashboard')"
                            class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-slate-500 hover:text-white hover:bg-indigo-500 hover:dark:bg-slate-700"
                        >
                            <Icon icon="hugeicons:add-team" class="text-xl" />
                            <span>Grupos</span>
                        </Link>
                        
                        <div class="py-3">
                            <div
                                class="px-3 text-xs font-medium uppercase text-slate-500"
                            >
                                Collections
                            </div>
                            <div class="mt-2"></div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Header incorporado (anteriormente estaba separado) -->
        <header
            class="fixed top-0 right-0 z-20 flex items-center justify-between px-4 py-[15px] md:px-6 left-0 md:left-64 border-b border-gray-300 dark:border-gray-600 backdrop-blur-sm"
        >
            <!-- Mobile menu button -->
            <button
                class="md:hidden flex justify-center items-center hover:bg-gray-100 dark:hover:bg-gray-800 p-2 rounded-md"
                @click="emit('toggleSidebar')"
            >
                <Icon icon="hugeicons:menu-square" class="text-indigo-500 text-xl" />
            </button>
            <div>
                <div class="bg-red-500 rounded-lg">
                    <ResponsiveNavLink 
                        :href="route('logout')" 
                        method="post" 
                        as="button"
                        class="w-full flex items-center justify-center p-2 text-white hover:text-red-200 hover:bg-red-600 rounded-lg transition-colors duration-300"
                    >
                        <Icon icon="ic:baseline-logout" class="text-lg text-white" />
                    </ResponsiveNavLink>
                </div>
            </div>
            <div class="flex items-center gap-2 md:gap-4">
                <!-- Botón de modo oscuro -->
                <button 
                    @click="toggleDarkMode"
                    class="rounded-md p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300"
                    :title="darkMode ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
                >
                    <Icon 
                        :icon="darkMode ? 'ph:sun' : 'ph:moon'" 
                        class="text-lg" 
                    />
                </button>
                <div class="h-8 w-8 overflow-hidden rounded-full">
                    <img
                        src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg"
                        alt="Avatar"
                        class="h-full w-full object-cover"
                    />
                </div>
            </div>
        </header>
    </div>
</template>