<!-- components/TooltipWrapper.vue -->
<template>
    <div class="relative inline-block group">
        <slot />
        <div
            v-if="text"
            class="absolute max-w-[30rem] text-wrap opacity-100 text-center bg-white text-slate-900 z-50 min-w-[20rem] hidden group-hover:block px-3 py-2 text-sm font-medium rounded-lg shadow-sm whitespace-nowrap"
            :class="positionClasses"
        >
            {{ text }}
            <div
                class="absolute w-2 h-2 bg-white transform rotate-45 -translate-x-1/2"
                :class="arrowClasses"
            ></div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

const props = withDefaults(
    defineProps<{
        text: string;
        position?: "top" | "bottom" | "left" | "right";
    }>(),
    {
        position: "top",
    }
);

const positionClasses = computed(() => {
    const classes = {
        top: "bottom-full left-1/2 -translate-x-1/2 mb-2",
        bottom: "top-full left-1/2 -translate-x-1/2 mt-2",
        left: "right-full top-1/2 -translate-y-1/2 mr-2",
        right: "left-full top-1/2 -translate-y-1/2 ml-2",
    };
    return classes[props.position];
});

const arrowClasses = computed(() => {
    const classes = {
        top: "bottom-0 left-1/2 -mb-1",
        bottom: "top-0 left-1/2 -mt-1",
        left: "top-1/2 right-0 -mr-1",
        right: "top-1/2 left-0 -ml-1",
    };
    return classes[props.position];
});
</script>
