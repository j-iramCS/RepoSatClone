<!-- ModalFiscal.vue -->
<template>
    <div>
        <button @click="disponible ? openModal() : null" :class="classcustom">
            <slot name="button-open" :selected-dato="getSelectedOption()">
            </slot>
        </button>

        <!-- Fondo oscuro con transiciÃ³n -->
        <transition name="fade">
            <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 z-40 backdrop-blur-sm"
                @click.self="closeModal"></div>
        </transition>

        <!-- Modal con transiciÃ³n -->
        <transition name="slide">
            <div v-if="isOpen"
                class="fixed inset-y-0 right-0 z-50 w-full max-w-full sm:max-w-xl bg-gray-50 dark:bg-gray-900 shadow-xl overflow-hidden">
                <div class="h-full flex flex-col">
                    <!-- Encabezado sticky -->
                    <div class="sticky top-0 z-10 p-4 border-b dark:border-gray-600 flex justify-between items-center"
                        :class="{ 'shadow-sm': isScrolled }">
                        <h2 class="text-gray-900 dark:text-gray-300">{{ title }}</h2>
                        <button @click="closeModal"
                            class="p-1 rounded-full text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-500"
                            aria-label="Cerrar modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Contenido desplazable -->
                    <div class="flex-1 overflow-y-auto p-4" @scroll="handleScroll" ref="modalContent">
                        <div class="max-w-5xl mx-auto p-6 rounded-xl">
                            <div class="columns-1 lg:columns-2 gap-4">
                                <div v-for="item in data" :key="item.id"
                                    class="relative overflow-hidden rounded-xl shadow-md transition-all duration-300 break-inside-avoid mb-4"
                                    :class="[
                                        item.disponible
                                            ? 'cursor-pointer'
                                            : 'opacity-80',
                                        seleccionado === item.id
                                            ? 'ring-4 ring-blue-400 scale-105'
                                            : item.disponible
                                                ? 'hover:ring-2 hover:ring-blue-200 hover:-translate-y-1 hover:shadow-lg transform'
                                                : '',
                                    ]" @click="
                                        item.disponible &&
                                        seleccionarDato(item.id)
                                        ">
                                    <!-- Fondo con gradiente -->
                                    <div :class="`absolute inset-0 bg-slate-700 sopasxd opacity-25`"></div>

                                    <!-- CÃ­rculos decorativos -->
                                    <div
                                        class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-10 -mt-10">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 w-16 h-16 bg-white opacity-10 rounded-full -ml-8 -mb-8">
                                    </div>

                                    <!-- Overlay de bloqueado -->
                                    <div v-if="!item.disponible"
                                        class="absolute inset-0 bg-gray-900 bg-opacity-30 backdrop-blur-sm flex flex-col items-center justify-center z-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white mb-2"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <span class="text-white font-medium text-sm">NO DISPONIBLE</span>
                                    </div>

                                    <!-- Contenido -->
                                    <div class="p-5 relative z-10 bg-gray-800">
                                        <div class="flex items-center space-x-3">
                                            <div :class="`p-2 rounded-lg text-white bg-blue-500`">
                                            </div>
                                            <h3 class="font-semibold">
                                                {{ item.titulo }}
                                            </h3>
                                        </div>

                                        <p class="text-gray-600 text-sm mb-3">
                                            {{ item.descripcion }}
                                        </p>

                                        <!-- Indicador de seleccionado -->
                                        <div v-if="
                                            seleccionado === item.id &&
                                            item.disponible
                                        "
                                            class="absolute top-3 right-3 w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- si no vide data -->
                            <div v-if="!data || data.length === 0" class="text-center text-gray-500 dark:text-gray-400">
                                <p>
                                    No hay datos disponibles
                                </p>
                                <button class="px-6 py-2 bg-blue-600 text-white rounded-md mt-5 font-bold active:scale-90 transition-transform duration-100 hover:bg-blue-700">
                                    <span>Crear un ejercicio nuevo</span>
                                </button>
                            </div>

                            <!-- BotÃ³n de continuar -->
                            <div class="mt-8 text-center" v-if="seleccionado">
                                <button
                                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-indigo-500 transition-colors shadow-md"
                                    @click="continuar">
                                    Continuar con el dato seleccionado
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Footer sticky -->
                    <template v-if="buttons">
                        <div class="sticky bottom-0 bg-white p-4 border-t flex justify-end space-x-3">
                            <button @click="closeModal"
                                class="px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-500">
                                Cancelar
                            </button>
                            <button
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 shadow-sm hover:shadow-md">
                                Aceptar
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed, defineEmits } from "vue";
import { Icon } from "@iconify/vue";

interface Types {
    id: number;
    titulo: string;
    descripcion: string;
    disponible?: boolean;
}

interface Props {
    title?: string;
    buttons?: boolean;
    data?: Types[];
    classcustom?: string;
    modelValue?: number | null;
    disponible?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    title: "Titulo del Modal Fiscal",
    buttons: false,
    classcustom: "",
    modelValue: null,
    disponible: false,
});

// Definimos los eventos emitidos
const emit = defineEmits(["update:modelValue", "select-dato"]);

const isOpen = ref(false);
const isScrolled = ref(false);
const modalContent = ref<HTMLElement | null>(null);

const openModal = () => {
    isOpen.value = true;
    document.body.style.overflow = "hidden";
};

const closeModal = () => {
    isOpen.value = false;
    document.body.style.overflow = "";
};

const handleScroll = () => {
    if (modalContent.value) {
        isScrolled.value = modalContent.value.scrollTop > 5;
    }
};

// Manejar tecla Escape
const handleKeyDown = (e: KeyboardEvent) => {
    if (e.key === "Escape" && isOpen.value) {
        closeModal();
    }
};

// Event listeners
onMounted(() => {
    window.addEventListener("keydown", handleKeyDown);
    // Inicializar con el valor del modelo, si existe
    if (props.modelValue !== null) {
        seleccionado.value = props.modelValue;
    }
});

onUnmounted(() => {
    window.removeEventListener("keydown", handleKeyDown);
    document.body.style.overflow = "";
});

// Creamos un computed que observa el modelValue
const seleccionado = computed({
    get: () => props.modelValue,
    set: (value) => {
        emit("update:modelValue", value);
    },
});

// Para TypeScript, definimos los tipos de eventos
const seleccionarDato = (id: number): void => {
    seleccionado.value = id;
    // Emitimos el evento con el trÃ¡mite seleccionado
    const datoSeleccionado = props.data?.find((t) => t.id === id);
    if (datoSeleccionado) {
        emit("select-dato", datoSeleccionado);
    }
};

const continuar = (): void => {
    // console.log("Continuar con el dato", seleccionado.value);
    closeModal();
    // La selecciÃ³n ya se ha emitido mediante 'update:modelValue'
};

// MÃ©todo para obtener el trÃ¡mite seleccionado
const getSelectedOption = (): Types | null => {
    if (seleccionado.value === null) return null;
    return props.data?.find((t) => t.id === seleccionado.value) || null;
};
</script>

<style scoped>
/* AnimaciÃ³n de fade */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.25s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* AnimaciÃ³n de slide */
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.slide-enter-from {
    transform: translateX(100%);
}

.slide-leave-to {
    transform: translateX(100%);
}

/* AnimaciÃ³n de lista */
.list-enter-active {
    transition: all 0.3s ease-out;
}

.list-leave-active {
    transition: all 0.2s ease-in;
}

.list-enter-from {
    opacity: 0;
    transform: translateX(20px);
}

.list-leave-to {
    opacity: 0;
    transform: translateX(-20px);
}

/* Mejorar rendimiento de animaciones */
@media (prefers-reduced-motion: no-preference) {
    * {
        scroll-behavior: smooth;
    }
}
</style>
