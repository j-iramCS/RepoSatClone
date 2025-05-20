<template>
    <div class="wysiwyg-editor w-full bg-white dark:bg-gray-900 rounded-lg shadow-md dark:text-white" :class="{ 'readonly': props.readonly }">
        <!-- Barra de herramientas (puede estar arriba o abajo según la configuración) -->
        <div v-if="props.toolbarPosition === 'top'"
            class="flex flex-wrap items-center gap-1 p-2 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 dark:text-white rounded-t-lg"
            :class="{ 'opacity-50 pointer-events-none': props.readonly }">
            <!-- Estilo de texto -->
            <div class="flex items-center border-r border-gray-300 dark:border-gray-600 pr-2 mr-2">
                <button v-for="format in textFormats" :key="format.command" @click.prevent="execCommand(format.command)"
                    :class="[
                        'p-1.5 rounded hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors',
                        isActive(format.command) ? 'bg-gray-200 dark:bg-slate-900' : ''
                    ]" :title="format.title" type="button">
                    <Icon :icon="format.icon" class="w-4 h-4" />
                </button>
            </div>

            <!-- Formatos de párrafo -->
            <div class="flex items-center border-r border-gray-300 dark:border-gray-600 pr-2 mr-2 gap-1">
                <select @change="formatBlock(($event.target as HTMLSelectElement)?.value)"
                    class="p-1 border border-gray-300  rounded text-sm bg-transparent dark:border-gray-600 w-28" :value="currentBlockFormat">
                    <option value="" selected disabled>Formatos</option>
                    <option value="p">Párrafo</option>
                    <option value="blockquote">Cita</option>
                    <option value="pre">Código</option>
                </select>
                <select @change="changeFontSize(($event.target as HTMLSelectElement)?.value)"
                    class="p-1 border border-gray-300  rounded text-sm bg-transparent dark:border-gray-600 w-32">
                    <option value="" selected disabled>Tamaño</option>
                    <option v-for="size in fontSizes" :key="size.value" :value="size.value">{{ size.label }}</option>
                </select>
            </div>

            <!-- Alineación -->
            <div class="flex items-center border-r border-gray-300 dark:border-gray-600 pr-2 mr-2">
                <button v-for="align in alignments" :key="align.command" @click.prevent="execCommand(align.command)"
                    :class="[
                        'p-1.5 rounded hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors',
                        isActive(align.command) ? 'bg-gray-200 dark:bg-slate-900' : ''
                    ]" :title="align.title" type="button">
                    <Icon :icon="align.icon" class="w-4 h-4" />
                </button>
            </div>

            <!-- Listas -->
            <div class="flex items-center border-r border-gray-300 dark:border-gray-600 pr-2 mr-2">
                <button v-for="list in lists" :key="list.command" @click.prevent="execCommand(list.command)" :class="[
                    'p-1.5 rounded hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors',
                    isActive(list.command) ? 'bg-gray-200 dark:bg-slate-900' : ''
                ]" :title="list.title" type="button">
                    <Icon :icon="list.icon" class="w-4 h-4" />
                </button>
            </div>

            <!-- Enlaces e imágenes -->
            <div class="flex items-center border-r border-gray-300 dark:border-gray-600 pr-2 mr-2">
                <button @click.prevent="insertLink" class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors"
                    title="Insertar enlace" type="button">
                    <Icon icon="hugeicons:attachment" class="w-4 h-4" />
                </button>
            </div>

            <!-- Colores -->
            <div class="flex items-center border-r border-gray-300 dark:border-gray-600 pr-2 mr-2">
                <div class="relative">
                    <button @click.prevent="showColorPicker = !showColorPicker"
                        class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors flex items-center color-picker-trigger"
                        title="Color de texto" type="button">
                        <Icon icon="hugeicons:colors" class="w-4 h-4" />
                        <span class="ml-1 w-4 h-4 inline-block border border-gray-300 rounded"
                            :style="{ backgroundColor: textColor }"></span>
                    </button>

                    <div v-if="showColorPicker"
                        class="absolute top-10 left-0 p-2 bg-white shadow-lg rounded z-10 grid grid-cols-5 gap-1 color-picker w-40">
                        <button v-for="color in colors" :key="color" @click.prevent="applyColor(color)"
                            class="w-6 h-6 rounded border border-gray-300" :style="{ backgroundColor: color }"
                            type="button"></button>
                    </div>
                </div>
            </div>

            <!-- Opciones adicionales -->
            <div class="flex items-center">
                <button @click.prevent="execCommand('undo')" class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors"
                    title="Deshacer" type="button">
                    <Icon icon="mdi:undo" class="w-4 h-4" />
                </button>
                <button @click.prevent="execCommand('redo')" class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors"
                    title="Rehacer" type="button">
                    <Icon icon="mdi:redo" class="w-4 h-4" />
                </button>
            </div>
        </div>

        <!-- Área editable -->
        <div ref="editorRef" class="p-4 overflow-y-auto focus:outline-none" :style="{
            minHeight: typeof props.minHeight === 'number' ? `${props.minHeight}px` : props.minHeight,
            maxHeight: typeof props.maxHeight === 'number' ? `${props.maxHeight}px` : props.maxHeight
        }" :contenteditable="!props.readonly" :data-placeholder="props.placeholder" :spellcheck="props.spellcheck"
            @input="handleInput" @keydown="handleKeyDown" @mouseup="updateActiveFormats" @keyup="updateActiveFormats"
            @focus="handleFocus" @blur="handleBlur" @paste="handlePaste" @drop="handleDrop" :class="{
                'editor-focused': isFocused,
                'readonly-editor': props.readonly,
                'editor-empty': isPlaceholderVisible,
            }" v-html="initialContent"></div>

        <!-- Barra de herramientas en la parte inferior -->
        <div v-if="props.toolbarPosition === 'bottom'"
            class="flex flex-wrap items-center gap-1 p-2 border-t border-gray-200 bg-gray-50 rounded-b-lg"
            :class="{ 'opacity-50 pointer-events-none': props.readonly }">
            <!-- Mismo contenido que la barra de herramientas superior -->
            <!-- Estilo de texto -->
            <div class="flex items-center border-r border-gray-300 pr-2 mr-2">
                <button v-for="format in textFormats" :key="format.command" @click.prevent="execCommand(format.command)"
                    :class="[
                        'p-1.5 rounded hover:bg-gray-200 transition-colors',
                        isActive(format.command) ? 'bg-gray-200 dark:bg-slate-900' : ''
                    ]" :title="format.title" type="button">
                    <Icon :icon="format.icon" class="w-4 h-4" />
                </button>
            </div>
        </div>

        <!-- Contador de caracteres -->
        <div class="p-2 border-t border-gray-200 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 text-xs text-gray-500 flex justify-between items-center bg-gray-50"
            :class="{ 'rounded-b-lg': props.toolbarPosition !== 'bottom' }">
            <span>{{ characterCount }} caracteres</span>
            <span v-if="!isEmpty && showWordCount">{{ wordCount }} palabras</span>
        </div>

        <!-- Modal para enlaces -->
        <Teleport to="body">
            <div v-if="showLinkModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20"
                @click.self="showLinkModal = false">
                <div class="bg-white p-4 rounded-lg shadow-lg w-96">
                    <h3 class="text-lg font-medium mb-4">Insertar enlace</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                            <input v-model="linkUrl" type="text"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://ejemplo.com" @keydown.enter.prevent="confirmInsertLink"
                                ref="linkUrlInput" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Texto</label>
                            <input v-model="linkText" type="text"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Texto del enlace" @keydown.enter.prevent="confirmInsertLink" />
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button @click.prevent="showLinkModal = false"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300" type="button">
                                Cancelar
                            </button>
                            <button @click.prevent="confirmInsertLink"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" type="button">
                                Insertar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Teleport>

        <Teleport to="body">
            <div v-if="showImagePropertiesModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20"
                @click.self="showImagePropertiesModal = false">
                <div class="bg-white p-4 rounded-lg shadow-lg w-96">
                    <h3 class="text-lg font-medium mb-4">Propiedades de imagen</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ancho (px)</label>
                                <input v-model="imageProperties.width" type="number"
                                    class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Ancho en píxeles" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alto (px)</label>
                                <input v-model="imageProperties.height" type="number"
                                    class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Alto en píxeles" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">URL de la imagen</label>
                            <input v-model="imageProperties.url" type="text"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://ejemplo.com/imagen.jpg" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Texto alternativo</label>
                            <input v-model="imageProperties.alt" type="text"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Descripción de la imagen" />
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button @click.prevent="showImagePropertiesModal = false"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300" type="button">
                                Cancelar
                            </button>
                            <button @click.prevent="applyImageProperties"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" type="button">
                                Aplicar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Teleport>


    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed, watch, nextTick } from 'vue';
import { Icon } from '@iconify/vue';

interface TextFormat {
    command: string;
    title: string;
    icon: string;
}

interface Props {
    modelValue?: string;
    placeholder?: string;
    showWordCount?: boolean;
    autofocus?: boolean;
    maxHeight?: string | number;
    minHeight?: string | number;
    readonly?: boolean;
    spellcheck?: boolean;
    toolbarPosition?: 'top' | 'bottom';
}

const props = withDefaults(defineProps<Props>(), {
    modelValue: '',
    placeholder: 'Comienza a escribir...',
    showWordCount: true,
    autofocus: false,
    maxHeight: '24rem',
    minHeight: '16rem',
    readonly: false,
    spellcheck: true,
    toolbarPosition: 'top'
});

const emit = defineEmits(['update:modelValue', 'change', 'focus', 'blur']);
const onInput = (event: Event) => {
    const value = (event.target as HTMLTextAreaElement).value;
    emit('update:modelValue', value);
    emit('change', value);
};

// Referencias y estados
const editorRef = ref<HTMLElement | null>(null);
const linkUrlInput = ref<HTMLInputElement | null>(null);
const imageUrlInput = ref<HTMLInputElement | null>(null);
const activeFormats = ref<Set<string>>(new Set());
const textColor = ref('#000000');
const showColorPicker = ref(false);
const showLinkModal = ref(false);
const showImageModal = ref(false);
const linkUrl = ref('');
const linkText = ref('');
const imageUrl = ref('');
const imageAlt = ref('');
const characterCount = ref(0);
const wordCount = ref(0);
const savedSelection = ref<Range | null>(null);
const initialContent = ref('');
const isPlaceholderVisible = ref(true);
const isFocused = ref(false);
const isEditorReady = ref(false);
const currentBlockFormat = ref('');

// Evitar que v-html cause problemas con el placeholder
const setInitialContent = () => {
    if (props.modelValue) {
        initialContent.value = props.modelValue;
        isPlaceholderVisible.value = false;
    } else {
        initialContent.value = ''; // Dejamos el editor vacío en lugar de insertar el placeholder
        isPlaceholderVisible.value = true;
    }
};

// Configuración de herramientas
const textFormats: TextFormat[] = [
    { command: 'bold', title: 'Negrita', icon: 'hugeicons:text-bold' },
    { command: 'italic', title: 'Cursiva', icon: 'hugeicons:text-italic' },
    { command: 'underline', title: 'Subrayado', icon: 'material-symbols-light:format-underlined-rounded' },
    { command: 'strikeThrough', title: 'Tachado', icon: 'hugeicons:text-strikethrough' },
    // { command: 'superscript', title: 'Superíndice', icon: 'hugeicons:text-superscript' },
    // { command: 'subscript', title: 'Subíndice', icon: 'hugeicons:text-subscript' }
];

const alignments: TextFormat[] = [
    { command: 'justifyLeft', title: 'Alinear a la izquierda', icon: 'hugeicons:align-box-middle-left' },
    { command: 'justifyCenter', title: 'Centrar', icon: 'hugeicons:align-box-middle-center' },
    { command: 'justifyRight', title: 'Alinear a la derecha', icon: 'hugeicons:align-box-middle-right' },
    { command: 'justifyFull', title: 'Justificar', icon: 'hugeicons:text-align-justify-center' }
];

const lists: TextFormat[] = [
    { command: 'insertUnorderedList', title: 'Lista no ordenada', icon: 'hugeicons:paragraph-bullets-point-01' },
    { command: 'insertOrderedList', title: 'Lista ordenada', icon: 'hugeicons:paragraph-bullets-point-02' }
];

// Colores predefinidos y más organizados
const colors = [
    // Negros y blancos
    '#000000', '#5C5C5C', '#9E9E9E', '#CCCCCC', '#FFFFFF',
    // Rojos
    '#F44336', '#E91E63', '#9C27B0', '#FF5252', '#FF1744',
    // Naranjas y amarillos
    '#FF9800', '#FFC107', '#FFEB3B', '#FFD54F', '#FFE082',
    // Verdes
    '#4CAF50', '#8BC34A', '#CDDC39', '#00C853', '#69F0AE',
    // Azules
    '#2196F3', '#03A9F4', '#00BCD4', '#0D47A1', '#1565C0',
    // Púrpuras
    '#673AB7', '#3F51B5', '#9575CD', '#4527A0', '#7E57C2',
];

const fontSizes = [
    { value: '1', label: 'Muy pequeño' },
    { value: '2', label: 'Pequeño' },
    { value: '3', label: 'Normal' },
    { value: '5', label: 'Grande' },
    { value: '6', label: 'Más grande' },
    { value: '7', label: 'Máximo' },
];

// Métodos auxiliares
const isEmpty = computed(() => {
    if (!editorRef.value) return true;
    const content = editorRef.value.innerText || '';
    return content.trim() === '';
});

const execCommand = (command: string, value: string = '') => {
    // Enfocar el editor si no lo está
    if (document.activeElement !== editorRef.value) {
        editorRef.value?.focus();
    }

    // Restaurar la selección si tenemos una guardada
    restoreSelection();

    document.execCommand(command, false, value);
    updateActiveFormats();
    emitContent();
};

const formatBlock = (block: string) => {
    if (!block) return;

    // Enfocar el editor si no lo está
    if (document.activeElement !== editorRef.value) {
        editorRef.value?.focus();
    }

    // Restaurar la selección si tenemos una guardada
    restoreSelection();

    document.execCommand('formatBlock', false, `<${block}>`);
    updateActiveFormats();
    emitContent();
};

const isActive = (command: string): boolean => {
    return activeFormats.value.has(command);
};

const updateActiveFormats = () => {
    if (!isEditorReady.value) return;

    activeFormats.value.clear();

    try {
        if (document.queryCommandState('bold')) activeFormats.value.add('bold');
        if (document.queryCommandState('italic')) activeFormats.value.add('italic');
        if (document.queryCommandState('underline')) activeFormats.value.add('underline');
        if (document.queryCommandState('strikeThrough')) activeFormats.value.add('strikeThrough');
        if (document.queryCommandState('superscript')) activeFormats.value.add('superscript');
        if (document.queryCommandState('subscript')) activeFormats.value.add('subscript');
        if (document.queryCommandState('justifyLeft')) activeFormats.value.add('justifyLeft');
        if (document.queryCommandState('justifyCenter')) activeFormats.value.add('justifyCenter');
        if (document.queryCommandState('justifyRight')) activeFormats.value.add('justifyRight');
        if (document.queryCommandState('justifyFull')) activeFormats.value.add('justifyFull');
        if (document.queryCommandState('insertUnorderedList')) activeFormats.value.add('insertUnorderedList');
        if (document.queryCommandState('insertOrderedList')) activeFormats.value.add('insertOrderedList');

        // Obtener el color actual
        const currentColor = document.queryCommandValue('foreColor');
        if (currentColor) {
            textColor.value = rgbToHex(currentColor);
        }

        // Detectar el formato de bloque actual
        detectCurrentBlockFormat();
    } catch (error) {
        console.error('Error al actualizar formatos activos:', error);
    }
};

const changeFontSize = (size: string) => {
    if (!size) return;

    if (document.activeElement !== editorRef.value) {
        editorRef.value?.focus();
    }

    restoreSelection();
    document.execCommand('fontSize', false, size);
    updateActiveFormats();
    emitContent();
};

const isResizingImage = ref(false);
const currentResizeImage = ref<HTMLImageElement | null>(null);
const initialResizeData = ref({
    startX: 0,
    startY: 0,
    startWidth: 0,
    startHeight: 0,
    aspectRatio: 1
});

const startImageResize = (e: MouseEvent, img: HTMLImageElement) => {
    e.preventDefault();
    e.stopPropagation();

    isResizingImage.value = true;
    currentResizeImage.value = img;

    // Guardar posición inicial y dimensiones
    initialResizeData.value = {
        startX: e.clientX,
        startY: e.clientY,
        startWidth: img.clientWidth,
        startHeight: img.clientHeight,
        aspectRatio: img.clientWidth / img.clientHeight
    };

    // Añadir clases visuales para indicar el redimensionamiento
    img.classList.add('resizing');

    // Añadir listeners de eventos temporales
    document.addEventListener('mousemove', handleImageResize);
    document.addEventListener('mouseup', endImageResize);
};
const handleImageResize = (e: MouseEvent) => {
    if (!isResizingImage.value || !currentResizeImage.value) return;

    e.preventDefault();

    const deltaX = e.clientX - initialResizeData.value.startX;

    // Calcular nueva anchura manteniendo el ratio de aspecto
    let newWidth = initialResizeData.value.startWidth + deltaX;
    newWidth = Math.max(50, newWidth); // mínimo 50px de ancho

    const newHeight = newWidth / initialResizeData.value.aspectRatio;

    // Aplicar nuevas dimensiones
    currentResizeImage.value.style.width = `${newWidth}px`;
    currentResizeImage.value.style.height = `${newHeight}px`;
};

const endImageResize = () => {
    if (currentResizeImage.value) {
        currentResizeImage.value.classList.remove('resizing');
    }

    isResizingImage.value = false;
    currentResizeImage.value = null;

    // Eliminar los eventos temporales
    document.removeEventListener('mousemove', handleImageResize);
    document.removeEventListener('mouseup', endImageResize);

    // Emitir el contenido actualizado
    emitContent();
};

const setupImageHandlers = () => {
    if (!editorRef.value) return;

    // Agregar observador para nuevas imágenes
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeName === 'IMG') {
                        setupImageResizeHandlers(node as HTMLImageElement);
                    }
                });
            }
        });
    });

    observer.observe(editorRef.value, {
        childList: true,
        subtree: true
    });

    // Configurar imágenes existentes
    const existingImages = editorRef.value.querySelectorAll('img');
    existingImages.forEach(img => {
        setupImageResizeHandlers(img);
    });
};

const setupImageResizeHandlers = (img: HTMLImageElement) => {
    // Crear controlador de redimensionamiento
    const resizeHandle = document.createElement('div');
    resizeHandle.className = 'image-resize-handle';

    // Añadir manejador de eventos para iniciar el redimensionamiento
    resizeHandle.addEventListener('mousedown', (e) => {
        startImageResize(e, img);
    });

    // Añadir el controlador a la imagen (o al contenedor padre si es necesario)
    const imageWrapper = document.createElement('div');
    imageWrapper.className = 'image-wrapper';

    // Reemplazar la imagen con el contenedor que incluye la imagen y el control
    img.parentNode?.insertBefore(imageWrapper, img);
    imageWrapper.appendChild(img);
    imageWrapper.appendChild(resizeHandle);

    // Aplicar estilos iniciales a la imagen
    img.style.maxWidth = '100%';

    // Añadir manejador de doble clic para abrir modal de propiedades de imagen
    img.addEventListener('dblclick', (e) => {
        e.preventDefault();
        openImagePropertiesModal(img);
    });
};

const showImagePropertiesModal = ref(false);
const editingImage = ref<HTMLImageElement | null>(null);
const imageProperties = ref({
    width: '',
    height: '',
    alt: '',
    url: ''
});

// Abrir modal de propiedades de imagen
const openImagePropertiesModal = (img: HTMLImageElement) => {
    editingImage.value = img;

    imageProperties.value = {
        width: img.style.width?.replace('px', '') || '',
        height: img.style.height?.replace('px', '') || '',
        alt: img.alt || '',
        url: img.src || ''
    };

    showImagePropertiesModal.value = true;
};

const applyImageProperties = () => {
    if (!editingImage.value) return;

    if (imageProperties.value.width) {
        editingImage.value.style.width = `${imageProperties.value.width}px`;
    }

    if (imageProperties.value.height) {
        editingImage.value.style.height = `${imageProperties.value.height}px`;
    }

    if (imageProperties.value.alt) {
        editingImage.value.alt = imageProperties.value.alt;
    }

    if (imageProperties.value.url && imageProperties.value.url !== editingImage.value.src) {
        editingImage.value.src = imageProperties.value.url;
    }

    showImagePropertiesModal.value = false;
    emitContent();
};

// Detectar el formato de bloque actual
const detectCurrentBlockFormat = () => {
    const selection = window.getSelection();
    if (!selection || selection.rangeCount === 0) return;

    const node = selection.getRangeAt(0).commonAncestorContainer;
    let checkNode: Node | null = node.nodeType === 3 ? node.parentNode : node; // Texto o elemento

    while (checkNode && checkNode !== editorRef.value) {
        const nodeName = (checkNode as Element).nodeName.toLowerCase();
        if (['h1', 'h2', 'h3', 'p', 'blockquote', 'pre'].includes(nodeName)) {
            currentBlockFormat.value = nodeName;
            return;
        }
        checkNode = checkNode.parentNode;
    }

    // Si no encontramos un formato, asumimos párrafo por defecto
    currentBlockFormat.value = '';
};

const rgbToHex = (rgb: string): string => {
    // Convertir formato RGB a HEX
    if (!rgb.startsWith('rgb')) return rgb;

    const match = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    if (!match) return '#000000';

    const r = parseInt(match[1], 10).toString(16).padStart(2, '0');
    const g = parseInt(match[2], 10).toString(16).padStart(2, '0');
    const b = parseInt(match[3], 10).toString(16).padStart(2, '0');

    return `#${r}${g}${b}`;
};

const applyColor = (color: string) => {
    textColor.value = color;
    execCommand('foreColor', color);
    showColorPicker.value = false;
};

// Guardar y restaurar la selección
const saveSelection = () => {
    const selection = window.getSelection();
    if (selection && selection.rangeCount > 0 && editorRef.value && editorRef.value.contains(selection.anchorNode)) {
        savedSelection.value = selection.getRangeAt(0).cloneRange();
    }
};

const restoreSelection = () => {
    if (savedSelection.value && editorRef.value) {
        const selection = window.getSelection();
        if (selection) {
            try {
                selection.removeAllRanges();
                selection.addRange(savedSelection.value);
            } catch (e) {
                console.error('Error al restaurar la selección:', e);
                // Crear un nuevo rango al final del contenido como fallback
                const range = document.createRange();
                range.selectNodeContents(editorRef.value);
                range.collapse(false); // Colapsar al final
                selection.removeAllRanges();
                selection.addRange(range);
            }
        }
    }
};

// Manejo de enlaces
const insertLink = () => {
    saveSelection();

    const selection = window.getSelection();
    if (selection && selection.toString()) {
        linkText.value = selection.toString();
    } else {
        linkText.value = '';
    }

    linkUrl.value = '';
    showLinkModal.value = true;

    nextTick(() => {
        linkUrlInput.value?.focus();
    });
};

const confirmInsertLink = () => {
    if (!linkUrl.value) {
        showLinkModal.value = false;
        return;
    }

    // Asegurarse de que la URL sea válida
    let url = linkUrl.value;
    if (!/^https?:\/\//i.test(url)) {
        url = 'https://' + url;
    }

    // Restaurar la selección guardada
    editorRef.value?.focus();
    restoreSelection();

    // Si no hay texto seleccionado, usar el texto proporcionado
    const selection = window.getSelection();
    if (selection && (!selection.toString() || selection.toString() === '')) {
        if (linkText.value) {
            const linkNode = document.createElement('a');
            linkNode.href = url;
            linkNode.target = '_blank';
            linkNode.rel = 'noopener noreferrer';
            linkNode.textContent = linkText.value;

            if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                range.deleteContents();
                range.insertNode(linkNode);

                // Mover el cursor después del enlace
                range.setStartAfter(linkNode);
                range.setEndAfter(linkNode);
                selection.removeAllRanges();
                selection.addRange(range);
            }
        }
    } else {
        // Si hay texto seleccionado, convertirlo en enlace
        document.execCommand('createLink', false, url);

        // Modificar los atributos del enlace recién creado
        const links = editorRef.value?.querySelectorAll('a[href="' + url + '"]');
        links?.forEach(link => {
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
        });
    }

    emitContent();
    showLinkModal.value = false;
};

// Manejo del placeholder
const handleFocus = (e: FocusEvent) => {
    isFocused.value = true;

    if (isPlaceholderVisible.value && editorRef.value) {
        // NO borrar el HTML aquí si estamos en modo de placeholder
        // Solo cambiar el estado
        isPlaceholderVisible.value = false;
    }

    nextTick(() => {
        updateActiveFormats();
    });

    emit('focus', e);
};

const handleBlur = (e: FocusEvent) => {
    isFocused.value = false;

    if (isEmpty.value && editorRef.value) {
        isPlaceholderVisible.value = true;
        // NO modificar el contenido HTML aquí
    }

    emit('blur', e);
};
// Manejar pegado de contenido
const handlePaste = (e: ClipboardEvent) => {
    e.preventDefault();

    // Intentar obtener archivos de imagen pegados directamente
    const items = e.clipboardData?.items;
    let imageInserted = false;

    if (items) {
        for (let i = 0; i < items.length; i++) {
            if (items[i].type.indexOf('image') !== -1) {
                const file = items[i].getAsFile();
                if (file) {
                    // Manejar la imagen pegada (por ejemplo, cargarla o mostrarla)
                    handlePastedImage(file);
                    imageInserted = true;
                    break;
                }
            }
        }
    }

    // Si no se pegó una imagen, manejar el texto o HTML
    if (!imageInserted) {
        const text = e.clipboardData?.getData('text/plain') || '';
        const html = e.clipboardData?.getData('text/html') || '';

        if (html) {
            // Limpiar el HTML
            const cleanedHtml = sanitizeHtml(html);
            document.execCommand('insertHTML', false, cleanedHtml);

            // Configurar las imágenes recién pegadas
            nextTick(() => {
                if (editorRef.value) {
                    const pastedImages = editorRef.value.querySelectorAll('img:not(.configured)');
                    pastedImages.forEach(img => {
                        setupImageResizeHandlers(img as HTMLImageElement);
                        img.classList.add('configured');
                    });
                }
            });
        } else {
            document.execCommand('insertText', false, text);
        }
    }

    updateActiveFormats();
    emitContent();
};

const handlePastedImage = (file: File) => {
    // Crear URL de objeto para la imagen
    const imageUrl = URL.createObjectURL(file);

    // Crear elemento de imagen
    const img = document.createElement('img');
    img.src = imageUrl;
    img.alt = 'Imagen pegada';
    img.className = 'pasted-image';

    // Insertar la imagen en la posición del cursor
    const selection = window.getSelection();
    if (selection && selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        range.deleteContents();
        range.insertNode(img);

        // Mover el cursor después de la imagen
        range.setStartAfter(img);
        range.setEndAfter(img);
        selection.removeAllRanges();
        selection.addRange(range);

        // Configurar manejadores de redimensionamiento
        nextTick(() => {
            setupImageResizeHandlers(img);
        });
    }
};

const handleImageLoad = (e: Event) => {
    const img = e.target as HTMLImageElement;
    if (img && img.naturalWidth === 0) {
        // La imagen no se cargó correctamente
        console.warn('La imagen no se cargó correctamente:', img.src);
        // Opcionalmente, añadir una clase CSS o un icono de error
        img.classList.add('img-load-error');
        img.setAttribute('title', 'La imagen no pudo cargarse');
    }
};

// Función básica para sanitizar HTML
const sanitizeHtml = (html: string): string => {
    const div = document.createElement('div');
    div.innerHTML = html;

    // Eliminar etiquetas de script y estilos
    const scripts = div.querySelectorAll('script, style');
    scripts.forEach(script => script.remove());

    // Eliminar atributos peligrosos
    const allElements = div.querySelectorAll('*');
    allElements.forEach(el => {
        const attrs = el.attributes;
        for (let i = attrs.length - 1; i >= 0; i--) {
            const attrName = attrs[i].name;
            // Eliminar manipuladores de eventos y atributos javascript:
            if (attrName.startsWith('on') ||
                (el.getAttribute(attrName) || '').includes('javascript:')) {
                el.removeAttribute(attrName);
            }
        }
    });

    return div.innerHTML;
};

// Manejar arrastrar y soltar
const handleDrop = (e: DragEvent) => {
    e.preventDefault();

    // Por ahora, solo prevenimos el comportamiento por defecto
    // En una implementación completa, se manejaría la carga de imágenes, etc.

    return false;
};

// Eventos
const handleInput = () => {
    // Si el editor deja de estar vacío, actualizar el estado del placeholder
    if (isPlaceholderVisible.value && !isEmpty.value) {
        isPlaceholderVisible.value = false;
    }

    updateWordAndCharCount();
    emitContent();
};

const handleKeyDown = (e: KeyboardEvent) => {
    // Agregar soporte para atajos de teclado comunes
    if (e.ctrlKey || e.metaKey) {
        if (e.key === 'b') {
            e.preventDefault();
            execCommand('bold');
        } else if (e.key === 'i') {
            e.preventDefault();
            execCommand('italic');
        } else if (e.key === 'u') {
            e.preventDefault();
            execCommand('underline');
        } else if (e.key === 'z') {
            e.preventDefault();
            execCommand('undo');
        } else if (e.key === 'y' || (e.key === 'z' && e.shiftKey)) {
            e.preventDefault();
            execCommand('redo');
        }
    }

    // Tecla Tab para indentación
    if (e.key === 'Tab') {
        e.preventDefault();
        document.execCommand('insertHTML', false, '&nbsp;&nbsp;&nbsp;&nbsp;');
    }
};

const updateWordAndCharCount = () => {
    if (!editorRef.value) return;

    const content = editorRef.value.innerText || '';
    characterCount.value = content.length;

    // Contar palabras (mejorado para manejar múltiples espacios)
    const words = content.trim().split(/\s+/);
    wordCount.value = content.trim() === '' ? 0 : words.length;
};

const emitContent = () => {
    if (!editorRef.value) return;

    // Emitir el contenido actual del editor

    if (editorRef.value) {
        const html = editorRef.value.innerHTML;
        emit('update:modelValue', html);
        emit('change', html);
    }

    // emit('update:modelValue', isEmpty.value ? '' : editorRef.value.innerHTML);
    // emit('change', isEmpty.value ? '' : editorRef.value.innerHTML);
};

// Inicialización
onMounted(() => {
    setInitialContent();

    if (editorRef.value) {
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'childList') {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeName === 'IMG') {
                            const img = node as HTMLImageElement;
                            img.addEventListener('load', handleImageLoad);
                            img.addEventListener('error', () => {
                                console.error('Error al cargar la imagen:', img.src);
                                img.classList.add('img-load-error');
                                img.setAttribute('title', 'La imagen no pudo cargarse');
                            });
                        }
                    });
                }
            });
        });

        observer.observe(editorRef.value, {
            childList: true,
            subtree: true
        });
    }

    // Permitir que el DOM se estabilice antes de inicializar completamente
    nextTick(() => {
        setupImageHandlers();

        if (editorRef.value) {
            // Aplicar el placeholder usando atributos de datos y CSS
            if (!props.modelValue) {
                isPlaceholderVisible.value = true;
            }

            // Auto-foco si se ha configurado
            if (props.autofocus) {
                editorRef.value.focus();
                if (isPlaceholderVisible.value) {
                    editorRef.value.innerHTML = '';
                    isPlaceholderVisible.value = false;
                }
            }

            // Actualizar contadores iniciales
            updateWordAndCharCount();

            // Marcar el editor como listo
            isEditorReady.value = true;
        }
    });

    // Cerrar el selector de colores al hacer clic fuera
    document.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        if (showColorPicker.value && !target.closest('.color-picker') && !target.closest('.color-picker-trigger')) {
            showColorPicker.value = false;
        }
    });

    // Manejar clics fuera del editor para guardar la selección
    document.addEventListener('mousedown', (e) => {
        const target = e.target as HTMLElement;
        if (editorRef.value && target !== editorRef.value && !editorRef.value.contains(target)) {
            // No guardar la selección si estamos haciendo clic en un modal
            if (!target.closest('.fixed.inset-0')) {
                saveSelection();
            }
        }
    });

    // Manejar comandos de deshacer/rehacer mediante teclado a nivel de documento
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'z' && !e.shiftKey && isFocused.value) {
            e.preventDefault();
            execCommand('undo');
        } else if ((e.ctrlKey || e.metaKey) && ((e.key === 'y') || (e.key === 'z' && e.shiftKey)) && isFocused.value) {
            e.preventDefault();
            execCommand('redo');
        }
    });
});

// Observar cambios en el modelValue
watch(() => props.modelValue, (newValue) => {
    if (editorRef.value) {
        if (newValue) {
            // Solo actualizar si el contenido es diferente y no es el placeholder
            if (newValue !== editorRef.value.innerHTML && !isPlaceholderVisible.value) {
                editorRef.value.innerHTML = newValue;
                isPlaceholderVisible.value = false;
            } else if (isPlaceholderVisible.value) {
                editorRef.value.innerHTML = newValue;
                isPlaceholderVisible.value = false;
            }
        } else if (!isPlaceholderVisible.value) {
            // Si no hay valor y no estamos mostrando el placeholder
            if (document.activeElement !== editorRef.value) {
                editorRef.value.innerHTML = props.placeholder;
                isPlaceholderVisible.value = true;
            } else {
                editorRef.value.innerHTML = '';
            }
        }

        updateWordAndCharCount();
    }
});
</script>

<style scoped>
/* Estilos adicionales para los diferentes tamaños de fuente */
:deep([style*="font-size: xx-small"]),
:deep([size="1"]) {
    font-size: 0.7rem !important;
}

:deep([style*="font-size: x-small"]),
:deep([size="2"]) {
    font-size: 0.8rem !important;
}

:deep([style*="font-size: small"]),
:deep([size="3"]) {
    font-size: 0.9rem !important;
}

:deep([style*="font-size: medium"]),
:deep([size="4"]) {
    font-size: 1rem !important;
}

:deep([style*="font-size: large"]),
:deep([size="5"]) {
    font-size: 1.2rem !important;
}

:deep([style*="font-size: x-large"]),
:deep([size="6"]) {
    font-size: 1.4rem !important;
}

:deep([style*="font-size: xx-large"]),
:deep([size="7"]) {
    font-size: 1.6rem !important;
}


:deep(blockquote) {
    border-left: 4px solid #e2e8f0;
    padding-left: 1rem;
    margin: 1rem 0;
    color: #4a5568;
}

:deep(pre) {
    background-color: #f7fafc;
    padding: 1rem;
    border-radius: 0.25rem;
    overflow-x: auto;
    font-family: monospace;
}

:deep(h1) {
    font-size: 1.875rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

:deep(h2) {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.25rem;
    margin-bottom: 0.75rem;
}

:deep(h3) {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
}

:deep(p) {
    margin-bottom: 0.5rem;
}

:deep(ul),
:deep(ol) {
    padding-left: 1.5rem;
    margin: 0.5rem 0;
}

:deep(ul) {
    list-style-type: disc;
}

:deep(ol) {
    list-style-type: decimal;
}

:deep(a) {
    color: #3182ce;
    text-decoration: underline;
}

/* Añadir estilos para el editor cuando está enfocado */
.wysiwyg-editor :deep([contenteditable="true"]:focus) {
    outline: none;
    border-color: #3182ce;
}

/* Efecto de transición suave para los botones al hacer hover */
.wysiwyg-editor button {
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.wysiwyg-editor button:active {
    transform: scale(0.95);
}

/* Estilos para el texto del placeholder */
.wysiwyg-editor .editor-empty[contenteditable="true"]:empty:before {
    content: attr(data-placeholder);
    color: #9ca3af;
    font-style: italic;
    pointer-events: none;
    display: block;
    /* Asegurar que el placeholder se muestre correctamente */
}

/* Estilos para modo solo lectura */
.wysiwyg-editor.readonly {
    opacity: 0.9;
}

.wysiwyg-editor .readonly-editor {
    background-color: #f9fafb;
    cursor: default;
    user-select: text;
}

/* Mejoras de accesibilidad - foco visible para navegación por teclado */
.wysiwyg-editor button:focus-visible {
    outline: 2px solid #3182ce;
    outline-offset: 2px;
}

/* Animación suave para modales */
.wysiwyg-editor .fixed {
    animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}
</style>