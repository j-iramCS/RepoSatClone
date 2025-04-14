<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, watch } from "vue";

const props = withDefaults(
    defineProps<{
        show?: boolean;
        maxWidth?: "sm" | "md" | "lg" | "xl" | "2xl" | "3xl" | "4xl" | "5xl" | "6xl" | "7xl";
        closeable?: boolean;
        title?: string; // Nuevo prop para el título
        hideCloseButton?: boolean; // Nuevo prop para ocultar el botón X
        blurBackground?: boolean; // Nuevo prop para efecto blur
        roundedCorners?: "sm" | "md" | "lg" | boolean; // Nuevo prop para bordes redondeados
        animation?: "fade" | "slide" | "scale" | "none"; // Nuevo prop para diferentes animaciones
    }>(),
    {
        show: false,
        maxWidth: "2xl",
        closeable: true,
        title: "",
        hideCloseButton: false,
        blurBackground: false,
        roundedCorners: "md",
        animation: "scale",
    }
);

const emit = defineEmits(["close"]);
const dialog = ref();
const showSlot = ref(props.show);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = "hidden";
            showSlot.value = true;

            dialog.value?.showModal();
        } else {
            document.body.style.overflow = "";

            setTimeout(() => {
                dialog.value?.close();
                showSlot.value = false;
            }, 200);
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit("close");
    }
};

const closeOnEscape = (e: KeyboardEvent) => {
    if (e.key === "Escape") {
        e.preventDefault();

        if (props.show) {
            close();
        }
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
    document.removeEventListener("keydown", closeOnEscape);

    document.body.style.overflow = "";
});

const maxWidthClass = computed(() => {
    return {
        sm: "sm:max-w-sm",
        md: "sm:max-w-md",
        lg: "sm:max-w-lg",
        xl: "sm:max-w-xl",
        "2xl": "sm:max-w-2xl",
        "3xl": "sm:max-w-3xl",
        "4xl": "sm:max-w-4xl",
        "5xl": "sm:max-w-5xl",
        "6xl": "sm:max-w-6xl",
        "7xl": "sm:max-w-7xl",
    }[props.maxWidth];
});

// Nuevas utilidades de estilo con clases computadas
const overlayClass = computed(() => {
    return props.blurBackground
        ? "absolute inset-0 bg-gray-500/70 backdrop-blur-sm dark:bg-gray-900/80"
        : "absolute inset-0 bg-gray-500/75 dark:bg-gray-900/80";
});

const roundedClass = computed(() => {
    if (props.roundedCorners === false) return "";
    if (props.roundedCorners === true || props.roundedCorners === "md")
        return "rounded-lg";
    return (
        {
            sm: "rounded",
            lg: "rounded-xl",
        }[props.roundedCorners as string] || "rounded-lg"
    );
});

const animationClasses = computed(() => {
    switch (props.animation) {
        case "fade":
            return {
                enter: "ease-out duration-300 opacity-0",
                enterTo: "opacity-100",
                leave: "ease-in duration-200 opacity-100",
                leaveTo: "opacity-0",
            };
        case "slide":
            return {
                enter: "ease-out duration-300 opacity-0 translate-y-4",
                enterTo: "opacity-100 translate-y-0",
                leave: "ease-in duration-200 opacity-100 translate-y-0",
                leaveTo: "opacity-0 translate-y-4",
            };
        case "scale":
            return {
                enter: "ease-out duration-300 opacity-0 scale-95",
                enterTo: "opacity-100 scale-100",
                leave: "ease-in duration-200 opacity-100 scale-100",
                leaveTo: "opacity-0 scale-95",
            };
        case "none":
            return {
                enter: "",
                enterTo: "",
                leave: "",
                leaveTo: "",
            };
        default:
            return {
                enter: "ease-out duration-300 opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95",
                enterTo: "opacity-100 translate-y-0 sm:scale-100",
                leave: "ease-in duration-200 opacity-100 translate-y-0 sm:scale-100",
                leaveTo: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95",
            };
    }
});
</script>

<template>
    <dialog
        class="z-50 m-0 min-h-full min-w-full overflow-y-auto bg-transparent backdrop:bg-transparent"
        ref="dialog"
    >
        <div
            class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
            scroll-region
        >
            <Transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-show="show"
                    class="fixed inset-0 transform transition-all"
                    @click="close"
                >
                    <div :class="overlayClass" />
                </div>
            </Transition>

            <Transition
                enter-active-class="ease-out duration-300"
                :enter-from-class="animationClasses.enter"
                :enter-to-class="animationClasses.enterTo"
                leave-active-class="ease-in duration-200"
                :leave-from-class="animationClasses.leave"
                :leave-to-class="animationClasses.leaveTo"
            >
                <div
                    v-show="show"
                    class="mb-6 transform overflow-hidden bg-gray-100 text-black shadow-xl transition-all sm:mx-auto sm:w-full"
                    :class="[maxWidthClass, roundedClass]"
                >
                    <!-- Título del modal si se proporciona -->
                    <div
                        v-if="title"
                        class="px-6 py-4 border-b flex justify-between items-center"
                    >
                        <h3
                            class="text-lg font-medium text-black"
                        >
                            {{ title }}
                        </h3>
                        <button
                            v-if="!hideCloseButton && closeable"
                            @click="close"
                            class="bg-slate-300 p-1 rounded-full hover:bg-red-500 hover:text-white transition-colors duration-200"
                        >
                            <!-- Icono X simple para cerrar -->
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>

                    <!-- Contenido personalizado -->
                    <div class="p-6">
                        <slot v-if="showSlot" />
                    </div>
                </div>
            </Transition>
        </div>
    </dialog>
</template>
