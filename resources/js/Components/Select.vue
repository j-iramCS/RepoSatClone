<template>
    <div class="w-full">
        <label
            v-if="label"
            :for="id"
            class="block mb-1 text-sm font-medium text-white"
        >
            {{ label }}
            <span v-if="required" class="text-red-500">*</span>
        </label>

        <div class="relative w-full" ref="selectRef">
            <!-- Campo de selección principal -->
            <div
                @click="toggleDropdown"
                class="flex mt-2 items-center justify-between dark:text-white w-full px-3 py-2 bg-transparent border rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                :class="[
                    isOpen ? 'border-blue-500' : 'border-gray-300 dark:border-gray-600',
                    v$.$error
                        ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                        : '',
                    disabled ? 'bg-gray-100 cursor-not-allowed text-white' : '',
                    customClass,
                ]"
            >
                <div
                    class="flex flex-wrap gap-1 items-center max-w-full overflow-hidden"
                >
                    <!-- Mostrar etiquetas seleccionadas si es multiple -->
                    <div
                        v-if="multiple && selectedOptions.length > 0"
                        class="flex flex-wrap gap-1"
                    >
                        <div
                            v-for="option in selectedOptions"
                            :key="option.value"
                            class="flex items-center px-2 py-1 text-sm bg-blue-100 text-blue-800 rounded-md"
                        >
                            <span class="max-w-xs truncate">{{
                                option.label
                            }}</span>
                            <button
                                @click.stop="removeOption(option)"
                                class="ml-1 text-blue-500 hover:text-blue-700"
                                :disabled="disabled"
                            >
                                &times;
                            </button>
                        </div>
                    </div>

                    <!-- Mostrar opción seleccionada si no es multiple -->
                    <div
                        v-else-if="!multiple && internalValue"
                        class="truncate"
                    >
                        {{ getSelectedLabel }}
                    </div>

                    <!-- Placeholder -->
                    <div v-else class="text-gray-400">{{ placeholder }}</div>
                </div>

                <svg
                    class="w-5 h-5 text-gray-400 transition-transform duration-150"
                    :class="{ 'transform rotate-180': isOpen }"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    ></path>
                </svg>
            </div>

            <!-- Dropdown con las opciones -->
            <div
                v-show="isOpen && !disabled"
                class="absolute z-10 w-full mt-1 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 bg-white dark:text-white rounded-md shadow-lg max-h-60 overflow-auto"
            >
                <!-- Barra de búsqueda -->
                <div
                    v-if="searchable"
                    class="sticky top-0 p-2  border-gray-300 dark:border-gray-600"
                >
                    <input
                        v-model="searchQuery"
                        type="text"
                        class="w-full px-3 py-2 text-sm border bg-transparent border-gray-300 dark:border-gray-600 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        :placeholder="searchPlaceholder"
                        @click.stop
                        ref="searchInput"
                    />
                </div>

                <!-- Lista de opciones -->
                <div v-if="filteredOptions.length > 0" class="py-1">
                    <div
                        v-for="option in filteredOptions"
                        :key="option.value"
                        @click.stop="selectOption(option)"
                        class="px-3 py-2 cursor-pointer hover:bg-indigo-100 hover:text-slate-900 dark:text-white dark:hover:bg-slate-500"
                        :class="{ 'bg-indigo-400 dark:bg-slate-600 text-white': isSelected(option) }"
                    >
                        <div class="flex items-center">
                            <input
                                v-if="multiple"
                                type="checkbox"
                                :checked="isSelected(option)"
                                class="w-4 h-4 mr-2 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                @click.stop
                            />
                            {{ option.label }}
                        </div>
                    </div>
                </div>

                <!-- Mensaje cuando no hay resultados -->
                <div v-else class="px-3 py-4 text-sm text-gray-600 dark:text-gray-300 text-center">
                    No se encontraron resultados para "{{ searchQuery }}"
                </div>
            </div>
        </div>

        <!-- Mensajes de error de validación -->
        <template v-if="v$.$error">
            <p
                v-for="error in v$.$errors"
                :key="error.$uid"
                class="mt-1 text-sm text-red-600"
            >
                {{ getErrorMessage(error.$validator, error.$params) }}
            </p>
        </template>

        <!-- Mensaje de error personalizado -->
        <p v-else-if="error" class="mt-1 text-sm text-red-600">{{ error }}</p>

        <!-- Texto de ayuda -->
        <p v-else-if="helpText" class="mt-1 text-sm text-gray-300">
            {{ helpText }}
        </p>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, watch, onMounted, onUnmounted, nextTick } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, minLength } from "@vuelidate/validators";

interface Option {
    value: string | number;
    label: string;
    [key: string]: any; // Para propiedades adicionales
}

interface Props {
    modelValue: string | number | (string | number)[] | any;
    defaultValue?: string | number | (string | number)[] | any;
    options: Option[];
    multiple?: boolean;
    searchable?: boolean;
    placeholder?: string;
    searchPlaceholder?: string;
    label?: string;
    required?: boolean;
    disabled?: boolean;
    error?: string;
    helpText?: string;
    customClass?: string;
    id?: string;
    minOptions?: number;
    maxOptions?: number;
    rules?: any; // Para reglas de validación personalizadas
}

const props = withDefaults(defineProps<Props>(), {
    multiple: false,
    searchable: true,
    placeholder: "Seleccionar...",
    searchPlaceholder: "Buscar...",
    required: false,
    disabled: false,
    id: () => `select-${Math.random().toString(36).substring(2, 9)}`,
    rules: () => ({}),
});

const emit = defineEmits(["update:modelValue", "change", "blur", "focus"]);

// Referencias a elementos DOM
const selectRef = ref<HTMLElement | null>(null);
const searchInput = ref<HTMLInputElement | null>(null);

// Estado local
const isOpen = ref(false);
const searchQuery = ref("");
const internalValue = ref(props.modelValue);

// Inicializar con el valor por defecto si modelValue está vacío
if (
    (props.modelValue === "" ||
        props.modelValue === undefined ||
        props.modelValue === null ||
        (Array.isArray(props.modelValue) && props.modelValue.length === 0)) &&
    props.defaultValue !== undefined
) {
    internalValue.value = props.defaultValue;
    // Emitir el valor por defecto al padre
    emit("update:modelValue", props.defaultValue);
}

// Mensajes de error en español para cada tipo de validador
const errorMessages = {
    required: "Este campo es obligatorio",
    minLength: (params: any) =>
        `Debes seleccionar al menos ${params.min} ${
            params.min === 1 ? "opción" : "opciones"
        }`,
    maxLength: (params: any) =>
        `No puedes seleccionar más de ${params.max} ${
            params.max === 1 ? "opción" : "opciones"
        }`,
};

// Función para obtener el mensaje de error según el tipo de validación
const getErrorMessage = (validator: string, params: any) => {
    const message = errorMessages[validator as keyof typeof errorMessages];
    if (typeof message === "function") {
        return message(params);
    }
    return message || `Error de validación: ${validator}`;
};

// Reglas de validación personalizadas
const minSelectedOptions = (min: number) => (value: any) => {
    if (!value) return false;
    if (!Array.isArray(value)) return true; // No aplicar a selección única
    return value.length >= min;
};

const maxSelectedOptions = (max: number) => (value: any) => {
    if (!Array.isArray(value)) return true; // No aplicar a selección única
    return value.length <= max;
};

// Configuración de Vuelidate
const rules = computed(() => {
    const localRules: any = {};

    // Agregar reglas basadas en las props
    if (props.required) {
        localRules.required = required;
    }

    if (props.multiple && props.minOptions !== undefined) {
        localRules.minLength = minSelectedOptions(props.minOptions);
    }

    if (props.multiple && props.maxOptions !== undefined) {
        localRules.maxLength = maxSelectedOptions(props.maxOptions);
    }

    // Combinar con las reglas personalizadas pasadas como prop
    return {
        internalValue: { ...localRules, ...props.rules },
    };
});

const v$ = useVuelidate(rules, { internalValue });

// Computed properties
const selectedOptions = computed(() => {
    if (!internalValue.value) return [];

    if (Array.isArray(internalValue.value)) {
        return props.options.filter((option) =>
            internalValue.value.includes(option.value)
        );
    } else {
        const selectedOption = props.options.find(
            (option) => option.value === internalValue.value
        );
        return selectedOption ? [selectedOption] : [];
    }
});

const getSelectedLabel = computed(() => {
    if (!internalValue.value) return "";

    const selectedOption = props.options.find(
        (option) => option.value === internalValue.value
    );
    return selectedOption ? selectedOption.label : "";
});

const filteredOptions = computed(() => {
    if (!searchQuery.value) return props.options;

    const query = searchQuery.value.toLowerCase().trim();
    return props.options.filter((option) =>
        option.label.toLowerCase().includes(query)
    );
});

// Métodos
const toggleDropdown = () => {
    if (props.disabled) return;

    isOpen.value = !isOpen.value;

    if (isOpen.value) {
        searchQuery.value = "";
        // Enfocar el campo de búsqueda después de que el dropdown se haya renderizado
        nextTick(() => {
            if (props.searchable && searchInput.value) {
                searchInput.value.focus();
            }
        });
        emit("focus");
    } else {
        handleBlur();
    }
};

const closeDropdown = (e: MouseEvent) => {
    // Solo cerrar si el clic fue fuera del componente
    if (
        isOpen.value &&
        selectRef.value &&
        !selectRef.value.contains(e.target as Node)
    ) {
        isOpen.value = false;
        handleBlur();
    }
};

const handleBlur = async () => {
    await v$.value.$validate();
    emit("blur");
};

const selectOption = async (option: Option) => {
    if (props.disabled) return;

    if (props.multiple) {
        const values = Array.isArray(internalValue.value)
            ? [...internalValue.value]
            : [];
        const index = values.indexOf(option.value);

        if (index === -1) {
            // Verificar si se excede el máximo de opciones
            if (
                props.maxOptions !== undefined &&
                values.length >= props.maxOptions
            ) {
                return;
            }
            values.push(option.value);
        } else {
            values.splice(index, 1);
        }

        internalValue.value = values;
        emit("update:modelValue", values);
        emit("change", values);
    } else {
        internalValue.value = option.value;
        emit("update:modelValue", option.value);
        emit("change", option.value);
        isOpen.value = false;
    }

    await v$.value.$validate();
};

const removeOption = async (option: Option) => {
    if (props.disabled) return;

    if (props.multiple && Array.isArray(internalValue.value)) {
        const values = [...internalValue.value];
        const index = values.indexOf(option.value);

        if (index !== -1) {
            values.splice(index, 1);
            internalValue.value = values;
            emit("update:modelValue", values);
            emit("change", values);
        }
    }

    await v$.value.$validate();
};

const isSelected = (option: Option): boolean => {
    if (Array.isArray(internalValue.value)) {
        return internalValue.value.includes(option.value);
    } else {
        return internalValue.value === option.value;
    }
};

// Cuando cambia el modelValue externamente, actualizar el valor interno
watch(
    () => props.modelValue,
    async (newValue) => {
        internalValue.value = newValue;
        await v$.value.$validate();
    }
);

// Event listeners
onMounted(async () => {
    document.addEventListener("click", closeDropdown);

    // Inicializar con el valor por defecto si modelValue está vacío
    if (
        (props.modelValue === "" ||
            props.modelValue === undefined ||
            props.modelValue === null ||
            (Array.isArray(props.modelValue) &&
                props.modelValue.length === 0)) &&
        props.defaultValue !== undefined
    ) {
        internalValue.value = props.defaultValue;
        emit("update:modelValue", props.defaultValue);
    }

    await v$.value.$validate();
});

onUnmounted(() => {
    document.removeEventListener("click", closeDropdown);
});

// Exponer Vuelidate para que el componente padre pueda acceder a él
defineExpose({
    v$,
});
</script>
