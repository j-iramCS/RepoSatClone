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
    <Head title="Iniciar Sesión | SimulaTi" />

    <div class="min-h-screen flex flex-col overflow-hidden">
        <!-- Contenedor principal con gradiente de fondo -->
        <div
            class="bg-gradient-to-br from-slate-800 via-slate-900 to-slate-950 flex-grow flex items-center justify-center py-16 px-4 relative"
        >
            <!-- Elementos decorativos animados -->
            <div class="absolute inset-0 overflow-hidden">
                <!-- Círculos decorativos animados -->
                <div
                    class="absolute top-10 left-10 w-64 h-64 bg-green-500 rounded-full opacity-5 blur-3xl animate-pulse-slow"
                ></div>
                <div
                    class="absolute top-40 right-20 w-96 h-96 bg-indigo-500 rounded-full opacity-5 blur-3xl animate-pulse-medium"
                ></div>
                <div
                    class="absolute bottom-20 left-1/3 w-72 h-72 bg-purple-500 rounded-full opacity-5 blur-3xl animate-pulse-fast"
                ></div>

                <!-- Partículas flotantes -->
                <div class="particles">
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                </div>
            </div>

            <!-- Contenedor de la tarjeta de login -->
            <div class="container mx-auto max-w-5xl relative z-10">
                <div
                    class="flex flex-col lg:flex-row overflow-hidden bg-slate-800 rounded-3xl shadow-2xl"
                >
                    <!-- Columna izquierda (imagen/ilustración) -->
                    <div
                        class="lg:w-1/2 relative overflow-hidden hidden lg:block"
                    >
                        <div
                            class="absolute inset-0 bg-slate-950 opacity-50"
                        ></div>
                        <div
                            class="absolute inset-0 opacity-20 bg-pattern"
                        ></div>

                        <!-- Elementos decorativos -->
                        <div
                            class="absolute w-40 h-40 -top-10 -left-10 bg-white opacity-10 rounded-full"
                        ></div>
                        <div
                            class="absolute w-32 h-32 bottom-10 right-10 bg-white opacity-10 rounded-full"
                        ></div>

                        <!-- Contenido de la columna izquierda -->
                        <div
                            class="relative z-10 h-full flex flex-col justify-center p-12 text-white"
                        >
                            <div class="mb-10">
                                <h1 class="text-4xl font-bold mb-2">
                                    <span class="text-white"
                                        >¡Bienvenido de nuevo!</span
                                    >
                                </h1>
                                <p class="text-white text-opacity-80">
                                    Accede a tu cuenta para gestionar tus
                                    simulaciones fiscales y estar preparado para
                                    el SAT.
                                </p>
                            </div>

                            <!-- Características destacadas -->
                            <div class="space-y-6 mt-auto">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                            />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-white font-medium">
                                            Datos Seguros
                                        </h3>
                                        <p
                                            class="text-white text-opacity-70 text-sm"
                                        >
                                            Tu información está protegida con
                                            encriptación avanzada
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                                            />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-white font-medium">
                                            Simulaciones Precisas
                                        </h3>
                                        <p
                                            class="text-white text-opacity-70 text-sm"
                                        >
                                            Cálculos actualizados con normativas
                                            vigentes
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna derecha (formulario) -->
                    <div class="lg:w-1/2 p-8 md:p-12 bg-slate-800">
                        <!-- Logo/Encabezado -->
                        <div class="text-center mb-10">
                            <h2
                                class="text-3xl font-bold text-gray-800 flex items-center justify-center gap-1"
                            >
                                <span class="text-green-500">Simula</span
                                ><span class="text-indigo-500">TI</span>
                            </h2>
                            <p class="text-gray-500 mt-1">
                                La plataforma líder en simulación fiscal
                            </p>
                        </div>

                        <!-- Mensaje de status si existe -->
                        <div
                            v-if="status"
                            class="mb-6 p-4 bg-green-50 border border-green-100 rounded-xl text-sm font-medium text-green-600 flex items-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            {{ status }}
                        </div>

                        <!-- Formulario de login -->
                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Campo de email -->
                            <div class="space-y-2">
                                <InputLabel
                                    for="email"
                                    value="Correo Electrónico"
                                    class="block text-gray-700 font-medium text-sm"
                                />
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                    >
                                        <Icon
                                            icon="hugeicons:mail-01"
                                            class="text-gray-400 text-xl"
                                        />
                                    </div>
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="pl-10 pr-4 py-3 mt-1 block w-full rounded-xl shadow-sm transition-all duration-300"
                                        v-model="form.email"
                                        required
                                        autofocus
                                        autocomplete="username"
                                        placeholder="ejemplo@correo.com"
                                    />
                                </div>
                                <InputError
                                    class="mt-1 text-red-500 text-sm"
                                    :message="form.errors.email"
                                />
                            </div>

                            <!-- Campo de contraseña -->
                            <div class="space-y-2">
                                <InputLabel
                                    for="password"
                                    value="Contraseña"
                                    class="block text-gray-700 font-medium text-sm"
                                />
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                    >
                                        <Icon
                                            icon="hugeicons:square-lock-01"
                                            class="text-gray-400 text-xl"
                                        />
                                    </div>
                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="pl-10 pr-4 py-3 mt-1 block w-full rounded-xl shadow-sm transition-all duration-300"
                                        v-model="form.password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="••••••••"
                                    />
                                </div>
                                <InputError
                                    class="mt-1 text-red-500 text-sm"
                                    :message="form.errors.password"
                                />
                            </div>

                            <!-- Opción "Recordarme" -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center cursor-pointer">
                                    <Checkbox
                                        name="remember"
                                        v-model:checked="form.remember"
                                        class="rounded border-gray-300 text-green-500 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                    />
                                    <span class="ml-2 text-sm text-gray-600"
                                        >Recordar mi sesión</span
                                    >
                                </label>

                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="text-sm text-green-600 hover:text-green-800 transition-colors font-medium"
                                >
                                    ¿Olvidaste tu contraseña?
                                </Link>
                            </div>

                            <!-- Botón de ingreso -->
                            <div>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md transform hover:-translate-y-px focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 flex items-center justify-center"
                                    :class="{
                                        'opacity-75 cursor-not-allowed':
                                            form.processing,
                                    }"
                                >
                                    <span
                                        v-if="form.processing"
                                        class="flex items-center"
                                    >
                                        <svg
                                            class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                        Procesando...
                                    </span>
                                    <span v-else class="flex items-center gap-3">
                                        <Icon icon="mage:login" class="text-xl text-white font-bold" />
                                        Iniciar Sesión
                                    </span>
                                </button>
                            </div>

                            <!-- Separador -->
                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div
                                        class="w-full border-t border-gray-600"
                                    ></div>
                                </div>
                                <div
                                    class="relative flex justify-center text-sm"
                                >
                                    <span
                                        class="px-2 bg-slate-800 text-gray-500"
                                        >o</span
                                    >
                                </div>
                            </div>

                            <!-- Registro -->
                            <div class="text-center">
                                <p class="text-gray-600 text-sm">
                                    ¿No tienes una cuenta?
                                    <Link
                                        :href="route('register')"
                                        class="font-medium text-green-600 hover:text-green-800 transition-colors"
                                    >
                                        Regístrate ahora
                                    </Link>
                                </p>
                            </div>
                        </form>

                        <!-- Footer del formulario -->
                        <div
                            class="mt-8 pt-6 border-t border-gray-600 text-center text-gray-500 text-xs"
                        >
                            <p>
                                © {{ new Date().getFullYear() }} SimulaTi. Todos
                                los derechos reservados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Animaciones de pulso para los círculos grandes de fondo */
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

@keyframes pulse-medium {
    0%,
    100% {
        transform: scale(1);
        opacity: 0.05;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.1;
    }
}

@keyframes pulse-fast {
    0%,
    100% {
        transform: scale(1);
        opacity: 0.05;
    }
    50% {
        transform: scale(1.15);
        opacity: 0.1;
    }
}

.animate-pulse-slow {
    animation: pulse-slow 10s ease-in-out infinite;
}

.animate-pulse-medium {
    animation: pulse-medium 8s ease-in-out infinite;
}

.animate-pulse-fast {
    animation: pulse-fast 6s ease-in-out infinite;
}

/* Patrón de fondo para el panel izquierdo */
.bg-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

/* Animación de partículas flotantes */
.particles {
    position: absolute;
    width: 100%;
    height: 100%;
}

.particle {
    position: absolute;
    width: 6px;
    height: 6px;
    background-color: white;
    border-radius: 50%;
    opacity: 0.2;
}

.particle:nth-child(1) {
    top: 10%;
    left: 20%;
    animation: float 15s linear infinite;
}

.particle:nth-child(2) {
    top: 20%;
    left: 80%;
    animation: float 25s linear infinite;
}

.particle:nth-child(3) {
    top: 50%;
    left: 50%;
    animation: float 20s linear infinite;
}

.particle:nth-child(4) {
    top: 70%;
    left: 30%;
    animation: float 18s linear infinite;
}

.particle:nth-child(5) {
    top: 30%;
    left: 90%;
    animation: float 22s linear infinite;
}

.particle:nth-child(6) {
    top: 90%;
    left: 40%;
    animation: float 19s linear infinite;
}

.particle:nth-child(7) {
    top: 40%;
    left: 10%;
    animation: float 26s linear infinite;
}

.particle:nth-child(8) {
    top: 80%;
    left: 70%;
    animation: float 21s linear infinite;
}

.particle:nth-child(9) {
    top: 60%;
    left: 60%;
    animation: float 24s linear infinite;
}

.particle:nth-child(10) {
    top: 15%;
    left: 45%;
    animation: float 17s linear infinite;
}

.particle:nth-child(11) {
    top: 55%;
    left: 15%;
    animation: float 23s linear infinite;
}

.particle:nth-child(12) {
    top: 75%;
    left: 85%;
    animation: float 16s linear infinite;
}

@keyframes float {
    0% {
        transform: translateY(0) translateX(0);
    }
    25% {
        transform: translateY(-20px) translateX(10px);
    }
    50% {
        transform: translateY(0) translateX(20px);
    }
    75% {
        transform: translateY(20px) translateX(10px);
    }
    100% {
        transform: translateY(0) translateX(0);
    }
}
</style>
