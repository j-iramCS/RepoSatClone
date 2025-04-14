<template>
    <div class="w-full">
        <label v-if="label" :for="id" class="block mb-1 text-sm font-medium text-white">
            {{ label }}
            <span v-if="required" class="text-red-500">*</span>
        </label>

        <div class="relative">
            <!-- Icono izquierdo -->
            <div v-if="leftIcon" class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <span class="text-white">{{ leftIcon }}</span>
            </div>

            <!-- Input para número con formato -->
            <input v-if="type === 'number'" :id="id" ref="inputRef" :value="displayValue" :placeholder="placeholder"
                :disabled="disabled" :readonly="readonly" :class="[
                    'w-full px-3 py-2 border rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors',
                    leftIcon ? 'pl-10' : '',
                    rightIcon || clearable ? 'pr-10' : '',
                    disabled
                        ? 'bg-gray-100 cursor-not-allowed text-white'
                        : 'bg-transparent',
                    v$.$error
                        ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                        : 'border-gray-500',
                    customClass,
                ]" type="text" inputmode="numeric" @input="handleNumberInput" @blur="handleBlur"
                @focus="handleFocus" />

            <!-- Input para otros tipos -->
            <input v-else :id="id" ref="inputRef" :value="modelValue" :type="type" :placeholder="placeholder"
                :disabled="disabled" :readonly="readonly" @input="handleInput" @blur="handleBlur" @focus="handleFocus"
                :class="[
                    'w-full px-3 py-2 border rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors',
                    leftIcon ? 'pl-10' : '',
                    rightIcon || clearable ? 'pr-10' : '',
                    disabled
                        ? 'bg-gray-100 cursor-not-allowed text-white'
                        : 'bg-transparent',
                    v$.$error
                        ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                        : 'border-gray-500',
                    customClass,
                ]" />

            <!-- Botón para limpiar el input -->
            <div v-if="clearable && (modelValue !== null && modelValue !== undefined && modelValue !== '')"
                class="absolute inset-y-0 top-2 right-0 flex items-center pr-3 cursor-pointer" @click="clearInput">
                <span class="p-1 bg-slate-800 rounded-full hover:bg-red-400 transition-colors">
                    <Icon icon="material-symbols:close" class="text-white text-xl" />
                </span>
            </div>

            <!-- Icono derecho -->
            <div v-else-if="rightIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <span class="text-gray-500">{{ rightIcon }}</span>
            </div>
        </div>

        <!-- Mensajes de error de validación -->
        <template v-if="v$.$error">
            <p v-for="error in v$.$errors" :key="error.$uid" class="mt-1 text-sm text-red-600">
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
import { ref, computed, onMounted, watch } from "vue";
import { Icon } from "@iconify/vue";
import { useVuelidate } from "@vuelidate/core";
import {
    required,
    email,
    minLength,
    maxLength,
    numeric,
    minValue,
    maxValue,
} from "@vuelidate/validators";

interface Props {
    modelValue: string | number;
    defaultValue?: string | number;
    type?: string;
    label?: string;
    placeholder?: string;
    required?: boolean;
    disabled?: boolean;
    readonly?: boolean;
    clearable?: boolean;
    leftIcon?: string;
    rightIcon?: string;
    error?: string;
    helpText?: string;
    customClass?: string;
    id?: string;
    maxlength?: number;
    rules?: any; // Nuevo prop para las reglas de validación

    // Propiedades específicas para números
    numberFormat?: boolean;
    decimalPlaces?: number;
    thousandsSeparator?: string;
    decimalSeparator?: string;
    min?: number;
    max?: number;
}

const props = withDefaults(defineProps<Props>(), {
    type: "text",
    required: false,
    disabled: false,
    readonly: false,
    clearable: false,
    id: () => `input-${Math.random().toString(36).substring(2, 9)}`,
    rules: () => ({}), // Valor por defecto para rules

    // Propiedades específicas para números
    numberFormat: true,
    decimalPlaces: 2,
    thousandsSeparator: ",",
    decimalSeparator: ".",
});

const emit = defineEmits([
    "update:modelValue",
    "input",
    "blur",
    "focus",
    "clear",
]);

const inputRef = ref<HTMLInputElement | null>(null);
const isFocused = ref(false);
const internalValue = ref(props.modelValue);

// Mensajes de error en español para cada tipo de validador
const errorMessages = {
    required: "Este campo es obligatorio",
    email: "Por favor, introduce una dirección de correo electrónico válida",
    minLength: (params: any) =>
        `Este campo debe tener al menos ${params.min} caracteres`,
    maxLength: (params: any) =>
        `Este campo no debe exceder los ${params.max} caracteres`,
    numeric: "Este campo solo acepta valores numéricos",
    minValue: (params: any) => `El valor mínimo permitido es ${params.min}`,
    maxValue: (params: any) => `El valor máximo permitido es ${params.max}`,
};

// Función para obtener el mensaje de error según el tipo de validación
const getErrorMessage = (validator: string, params: any) => {
    const message = errorMessages[validator as keyof typeof errorMessages];
    if (typeof message === "function") {
        return message(params);
    }
    return message || `Error de validación: ${validator}`;
};

// Configuración de Vuelidate
const rules = computed(() => {
    const localRules: any = {};

    // Agregar reglas basadas en las props
    if (props.required) {
        localRules.required = required;
    }

    if (props.type === "email") {
        localRules.email = email;
    }

    if (props.maxlength) {
        localRules.maxLength = maxLength(props.maxlength);
    }

    if (props.type === "number") {
        localRules.numeric = numeric;

        if (props.min !== undefined) {
            localRules.minValue = minValue(props.min);
        }

        if (props.max !== undefined) {
            localRules.maxValue = maxValue(props.max);
        }
    }

    // Combinar con las reglas personalizadas pasadas como prop
    return {
        internalValue: { ...localRules, ...props.rules },
    };
});

const v$ = useVuelidate(rules, { internalValue });

// Inicializar con el valor por defecto solo si se proporciona uno
if (
    (props.modelValue === "" ||
        props.modelValue === undefined ||
        props.modelValue === null) &&
    props.defaultValue !== undefined
) {
    internalValue.value = props.defaultValue;
    // Emitir el valor por defecto al padre
    emit("update:modelValue", props.defaultValue);
}

// Para números con formato
const displayValue = computed(() => {
    if (props.type !== "number" || !props.numberFormat || isFocused.value) {
        return internalValue.value;
    }

    // Si no hay valor, devolver cadena vacía en lugar de 0
    if (internalValue.value === "" || internalValue.value === null || internalValue.value === undefined) {
        return "";
    }

    // Formatear solo si hay un valor numérico
    return formatNumber(Number(internalValue.value));
});

// Función para formatear números
const formatNumber = (value: number): string => {
    if (isNaN(value)) return "";

    // Creamos nuestro propio formato personalizado en lugar de usar Intl.NumberFormat
    let result = value.toFixed(props.decimalPlaces); // Esto da "287.00" para value=287

    // Convertimos a string y separamos la parte entera de la decimal
    const parts = result.split('.');
    const integerPart = parts[0];
    const decimalPart = parts.length > 1 ? parts[1] : '';

    // Formatear la parte entera con separadores de miles
    let formattedInteger = '';
    for (let i = 0; i < integerPart.length; i++) {
        if (i > 0 && (integerPart.length - i) % 3 === 0) {
            formattedInteger += props.thousandsSeparator;
        }
        formattedInteger += integerPart[i];
    }

    // Juntar todo con el separador decimal apropiado
    return decimalPart ?
        formattedInteger + props.decimalSeparator + decimalPart :
        formattedInteger;
};

// Función para parsear números formateados
const parseFormattedNumber = (value: string): number | null => {
    // Si el valor está vacío, devolver null (no 0)
    if (!value || value.trim() === "") {
        return null;
    }

    // Eliminar todos los separadores de miles
    const cleanValue = value
        .replace(new RegExp(`\\${props.thousandsSeparator}`, "g"), "")
        // Reemplazar el separador decimal si es diferente del punto
        .replace(props.decimalSeparator, ".");

    const parsed = parseFloat(cleanValue);
    return isNaN(parsed) ? null : parsed;
};

// Manejadores de eventos
const handleInput = async (event: Event) => {
    const target = event.target as HTMLInputElement;
    const newValue = target.value;

    // Implementar la restricción de longitud en JavaScript en lugar de depender del atributo maxlength
    if (props.maxlength && newValue.length > props.maxlength) {
        // Si el valor excede la longitud máxima, truncarlo
        target.value = newValue.slice(0, props.maxlength);
        internalValue.value = target.value;
    } else {
        internalValue.value = newValue;
    }

    await v$.value.$validate();
    emit("update:modelValue", internalValue.value);
    emit("input", internalValue.value);
};

const handleNumberInput = async (event: Event) => {
    const target = event.target as HTMLInputElement;
    const rawValue = target.value;

    // Si el valor está vacío, manejarlo como tal
    if (!rawValue || rawValue.trim() === "") {
        internalValue.value = "";
        emit("update:modelValue", "");
        await v$.value.$validate();
        emit("input", "");
        return;
    }

    // Permitir solo números, separador decimal y separador de miles
    const validChars = `0123456789${props.decimalSeparator}${props.thousandsSeparator}`;
    const filteredValue = rawValue
        .split("")
        .filter((char) => validChars.includes(char))
        .join("");

    if (isFocused.value) {
        // Durante el focus, mostramos el valor sin formato para facilitar la edición
        target.value = filteredValue;
        const numericValue = parseFormattedNumber(filteredValue);

        // Si el valor es null (vacío), mantenerlo como cadena vacía
        if (numericValue === null) {
            internalValue.value = "";
            emit("update:modelValue", "");
        }
        // Aplicar restricciones min/max si están definidas
        else if (props.min !== undefined && numericValue < props.min) {
            internalValue.value = props.min;
            emit("update:modelValue", props.min);
        } else if (props.max !== undefined && numericValue > props.max) {
            internalValue.value = props.max;
            emit("update:modelValue", props.max);
        } else {
            internalValue.value = numericValue;
            emit("update:modelValue", numericValue);
        }
    } else {
        // Formatear el número
        const numericValue = parseFormattedNumber(filteredValue);

        // Si el valor es null (vacío), mantenerlo como cadena vacía
        if (numericValue === null) {
            internalValue.value = "";
            emit("update:modelValue", "");
        } else {
            internalValue.value = numericValue;
            emit("update:modelValue", numericValue);
        }
    }

    await v$.value.$validate();
    emit("input", target.value);
};

const handleBlur = async (event: FocusEvent) => {
    isFocused.value = false;
    await v$.value.$validate();
    emit("blur", event);

    if (props.type === "number" && props.numberFormat) {
        // Al perder el foco, aseguramos que el valor se muestre formateado
        const target = event.target as HTMLInputElement;

        // Si el campo está vacío, mantenerlo vacío
        if (!target.value || target.value.trim() === "") {
            internalValue.value = "";
            emit("update:modelValue", "");
            return;
        }

        // Parseamos el valor actual
        const numericValue = parseFormattedNumber(target.value);

        // Si el valor es null o NaN, mantenerlo como cadena vacía
        if (numericValue === null) {
            internalValue.value = "";
            target.value = "";
            emit("update:modelValue", "");
        } else {
            // Actualizamos el valor interno
            internalValue.value = numericValue;
            // Formateamos para mostrar
            target.value = formatNumber(numericValue);
            // Emitimos el valor correcto
            emit("update:modelValue", numericValue);
        }
    }
};

const handleFocus = (event: FocusEvent) => {
    isFocused.value = true;
    emit("focus", event);

    if (props.type === "number" && props.numberFormat) {
        // Al enfocar, mostramos el valor sin formato para facilitar la edición
        const target = event.target as HTMLInputElement;

        // Si el campo está vacío, mantenerlo vacío
        if (!target.value || target.value.trim() === "") {
            return;
        }

        const numericValue = parseFormattedNumber(target.value);

        if (numericValue !== null) {
            // Mostramos el valor sin formato para facilitar la edición
            target.value = String(numericValue);
        } else {
            target.value = "";
        }
    }
};

const clearInput = async () => {
    internalValue.value = "";
    await v$.value.$validate();
    emit("update:modelValue", "");
    emit("clear");

    // Enfocar el input después de limpiarlo
    if (inputRef.value) {
        inputRef.value.focus();
    }
};

// Cuando cambia el modelValue externamente, actualizar el valor interno
watch(
    () => props.modelValue,
    async (newValue) => {
        internalValue.value = newValue;
        await v$.value.$validate();

        if (props.type === "number" && inputRef.value && !isFocused.value) {
            // Si el valor es vacío, mantener el input vacío
            if (newValue === "" || newValue === null || newValue === undefined) {
                inputRef.value.value = "";
            } else {
                // Si hay un valor numérico, formatearlo
                inputRef.value.value = formatNumber(Number(newValue));
            }
        }
    }
);

// Inicialización
onMounted(async () => {
    if (
        (props.modelValue === "" ||
            props.modelValue === undefined ||
            props.modelValue === null) &&
        props.defaultValue !== undefined
    ) {
        // Si no hay modelValue pero sí defaultValue, usamos el defaultValue
        internalValue.value = props.defaultValue;
        emit("update:modelValue", props.defaultValue);
    }

    if (props.type === "number" && props.numberFormat && inputRef.value) {
        // Si el valor es vacío, mantener el input vacío
        if (internalValue.value === "" || internalValue.value === null || internalValue.value === undefined) {
            inputRef.value.value = "";
        } else {
            // Si hay un valor numérico, formatearlo
            inputRef.value.value = formatNumber(Number(internalValue.value));
        }
    }

    await v$.value.$validate();
});

// Exponer Vuelidate para que el componente padre pueda acceder a él
defineExpose({
    v$,
});
</script>