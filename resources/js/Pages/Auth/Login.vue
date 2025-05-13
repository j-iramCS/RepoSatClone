<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
        },
    });
};
</script>

<template>

    <Head title="Iniciar Sesión | Proyecto" />

    <div class="min-h-screen bg-[#050714] flex items-center justify-center p-4">
        <!-- Contenedor principal -->
        <div class="max-w-5xl w-full relative z-10">

            <div class="flex justify-between gap-5 mb-5 md:hidden items-center">
                <Link :href="route('welcome')" class="text-gray-300 py-2 px-4">
                <Icon icon="hugeicons:arrow-left-02" class="text-3xl" />
                </Link>
                <h2 class="text-xl font-bold text-gray-300">Proyecto</h2>
            </div>

            <!-- Header con logo -->
            <header class="mb-10 items-center justify-center md:justify-between gap-5 hidden md:flex">
                <div class="flex items-center">
                    <div class=" rounded-full h-12 w-12 flex items-center justify-center mr-4">
                        <Icon icon="ix:project" class="text-9xl text-blue-600" />
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white">Proyecto</h1>
                </div>

                <Link :href="route('welcome')"
                    class="bg-gray-900 hover:bg-slate-800 text-gray-300 py-2 px-4 rounded-md transition items-center gap-2 justify-center flex">
                <Icon icon="hugeicons:arrow-left-02" class="text-2xl" />
                <span>Regresar</span>
                </Link>

            </header>

            <!-- Contenedor de la tarjeta de login -->
            <div
                class="flex flex-col lg:flex-row overflow-hidden bg-gray-900 bg-opacity-50 backdrop-filter backdrop-blur-lg rounded-2xl">
                <!-- Columna izquierda (imagen/ilustración) -->
                <div class="lg:w-1/2 relative overflow-hidden hidden lg:block">
                    <!-- Elementos decorativos -->
                    <div class="absolute w-40 h-40 -top-10 -left-10 bg-blue-500 opacity-10 rounded-full"></div>
                    <div class="absolute w-32 h-32 bottom-10 right-10 bg-purple-500 opacity-10 rounded-full"></div>

                    <!-- Contenido de la columna izquierda -->
                    <div
                        class="relative z-10 h-full flex flex-col justify-center p-12 text-white border-r border-gray-700">
                        <div class="mb-10">
                            <h1 class="text-4xl font-bold mb-4">
                                <span class="text-white">¡Bienvenido de nuevo!</span>
                            </h1>
                            <p class="text-white text-opacity-80 text-lg">
                                Accede a tu cuenta para gestionar tus proyectos y aprovechar todas las funcionalidades.
                            </p>
                        </div>

                        <!-- Características destacadas -->
                        <div class="space-y-6 mt-auto">
                            <div class="flex items-center">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-white font-medium">
                                        Datos Seguros
                                    </h3>
                                    <p class="text-white text-opacity-70 text-sm">
                                        Tu información está protegida con encriptación avanzada
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-purple-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-white font-medium">
                                        Diseño Moderno
                                    </h3>
                                    <p class="text-white text-opacity-70 text-sm">
                                        UI elegante construida con Vue 3 y Tailwind CSS
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-white font-medium">
                                        Rápido y Eficiente
                                    </h3>
                                    <p class="text-white text-opacity-70 text-sm">
                                        Rendimiento óptimo y experiencia de usuario superior
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha (formulario) -->
                <div class="lg:w-1/2 p-8 md:p-12">

                    <!-- Logo/Encabezado -->
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold text-white">Iniciar Sesión</h2>
                        <p class="text-gray-300 mt-2">Ingresa tus credenciales para acceder a tu cuenta</p>
                    </div>

                    <!-- Mensaje de status si existe -->
                    <div v-if="status"
                        class="mb-6 p-4 bg-blue-900 bg-opacity-20 border border-blue-800 rounded-xl text-sm font-medium text-blue-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ status }}
                    </div>

                    <!-- Formulario de login -->
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Campo de email -->
                        <div class="space-y-2">
                            <InputLabel for="email" value="Correo Electrónico"
                                class="block text-white font-medium text-sm" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <Icon icon="hugeicons:mail-01" class="text-gray-400 text-xl" />
                                </div>
                                <TextInput id="email" type="email"
                                    class="pl-10 pr-4 py-3 mt-1 block w-full rounded-xl shadow-sm transition-all duration-300 bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    v-model="form.email" required autofocus autocomplete="username"
                                    placeholder="ejemplo@correo.com" />
                            </div>
                            <InputError class="mt-1 text-red-400 text-sm" :message="form.errors.email" />
                        </div>

                        <!-- Campo de contraseña -->
                        <div class="space-y-2">
                            <InputLabel for="password" value="Contraseña"
                                class="block text-white font-medium text-sm" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <Icon icon="hugeicons:square-lock-01" class="text-gray-400 text-xl" />
                                </div>
                                <TextInput id="password" type="password"
                                    class="pl-10 pr-4 py-3 mt-1 block w-full rounded-xl shadow-sm transition-all duration-300 bg-gray-700 border-gray-600 text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    v-model="form.password" required autocomplete="current-password"
                                    placeholder="••••••••" />
                            </div>
                            <InputError class="mt-1 text-red-400 text-sm" :message="form.errors.password" />
                        </div>

                        <!-- Opción "Recordarme" -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center cursor-pointer">
                                <Checkbox name="remember" v-model:checked="form.remember"
                                    class="rounded border-gray-600 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-gray-700" />
                                <span class="ml-2 text-sm text-gray-300">Recordar mi sesión</span>
                            </label>

                            <Link v-if="canResetPassword" :href="route('password.request')"
                                class="text-sm text-blue-400 hover:text-blue-300 transition-colors font-medium">
                            ¿Olvidaste tu contraseña?
                            </Link>
                        </div>

                        <!-- Botón de ingreso -->
                        <div>
                            <button type="submit" :disabled="form.processing"
                                class="w-full flex justify-center bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800"
                                :class="{
                                    'opacity-75 cursor-not-allowed':
                                        form.processing,
                                }">
                                <span v-if="form.processing" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Procesando...
                                </span>
                                <span v-else class="flex items-center gap-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Iniciar Sesión
                                </span>
                            </button>
                        </div>

                        <!-- Separador -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-600"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-gray-800 text-gray-400">o</span>
                            </div>
                        </div>

                        <!-- Registro -->
                        <div class="text-center">
                            <p class="text-gray-300 text-sm">
                                ¿No tienes una cuenta?
                                <Link :href="route('register')"
                                    class="font-medium text-blue-400 hover:text-blue-300 transition-colors">
                                Regístrate ahora
                                </Link>
                            </p>
                        </div>
                    </form>

                    <!-- Footer del formulario -->
                    <div class="mt-8 pt-6 border-t border-gray-600 text-center text-gray-400 text-xs">
                        <p>
                            © {{ new Date().getFullYear() }} Proyecto.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Animaciones de pulso para elementos de fondo (opcional) */
@keyframes pulse-slow {

    0%,
    100% {
        transform: scale(1);
        opacity: 0.05;
    }

    50% {
        transform: scale(1.05);
        opacity: 0.1;
    }
}

.animate-pulse-slow {
    animation: pulse-slow 10s ease-in-out infinite;
}
</style>