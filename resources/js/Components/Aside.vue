<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import Tooltip from "./Tooltip.vue";

defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const closeSidebar = () => {
    emit("close");
};
</script>

<template>
    <div
        :class="[
            'fixed inset-y-0 left-0 z-30 w-64 transform transition-transform duration-300 bg-slate-800 md:bg-transparent ease-in-out border-r border-gray-500',
            isOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0',
        ]"
    >
        <div class="flex-1 flex flex-col relative z-10">
            <div class="flex items-center justify-between p-4">
                <div class="flex gap-2">
                    <h1 class="text-white font-bold text-2xl">
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

            <p class="border-b border-slate-700"></p>

            <div class="h-full overflow-y-auto mt-4">
                <nav class="space-y-1 px-2">
                    <Link
                        :href="route('dashboard')"
                        class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700"
                    >
                        <Icon icon="hugeicons:home-05" />
                        <span>Inicio</span>
                    </Link>

                    <Link
                        :href="route('dashboard')"
                        class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700"
                    >
                        <Icon icon="hugeicons:add-team" />
                        <span>Grupos</span>
                    </Link>

                    <div class="py-3">
                        <div
                            class="px-3 text-xs font-medium uppercase text-slate-300"
                        >
                            Collections
                        </div>
                        <div class="mt-2"></div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>
