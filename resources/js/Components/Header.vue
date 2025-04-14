<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps<{
    onToggleSidebar: (payload: MouseEvent) => void;
}>();
</script>

<template>
    <header
        class="fixed top-0 right-0 z-20 flex items-center justify-between px-4 py-4 md:px-6 left-0 md:left-64 border-b border-gray-500 backdrop-blur-sm"
    >
        <!-- Mobile menu button -->
        <button
            class="md:hidden flex justify-center items-center hover:bg-slate-900 p-2 rounded-md"
            @click="onToggleSidebar"
        >
            <Icon
                icon="hugeicons:menu-square"
                class="text-indigo-500 text-xl"
            />
        </button>
        <div>
            <div
                class="bg-red-500 rounded-lg"
            >
                <ResponsiveNavLink
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full flex items-center justify-center p-2 text-gray-400 hover:text-red-400 hover:bg-gray-800 rounded-lg transition-colors duration-300"
                >
                    <Icon icon="ic:baseline-logout" class="text-lg text-white" />
                </ResponsiveNavLink>
            </div>
        </div>
        <div class="flex items-center gap-2 md:gap-4">
            <button
                class="rounded-md p-2 text-gray-500 hover:bg-gray-100"
            ></button>
            <button
                class="rounded-md p-2 text-gray-500 hover:bg-gray-100"
            ></button>
            <div class="h-8 w-8 overflow-hidden rounded-full">
                <img
                    src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg"
                    alt="Avatar"
                    class="h-full w-full object-cover"
                />
            </div>
        </div>
    </header>
</template>
