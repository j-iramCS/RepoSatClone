<template>
    <Main>
        <!-- Cabecera con efectos de degradado y mejora visual -->
        <div class="mb-6 bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg text-white">
            <h1 class="text-2xl font-bold">Mis Creaciones</h1>
            <p class="opacity-80">Administra los Ejericios que has creado</p>
            <div class="flex mt-3">
                <div
                    class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm mr-2 flex items-center justify-center">
                    <Icon icon="hugeicons:arrow-down-02" class="mr-1" />
                    {{ max_ejercicios }} Ejercicios Totales
                </div>
            </div>
        </div>

        <!-- Ejercicios -->
        <div class="bg-white dark:bg-[#171b2e] p-5 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold dark:text-white">Ejercicios</h2>
                <Link href="/admin/ejercicios/create"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Crear Ejercicio
                </Link>
            </div>

            <div class="">

            </div>

        </div>

    </Main>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Icon } from "@iconify/vue/dist/iconify.js";
import { Link } from "@inertiajs/vue3";
import axios from 'axios';

import Main from "@/Layouts/Main.vue";

const data = ref<any>({});
const max_ejercicios = ref<any>(0);

// Aquí puedes agregar cualquier lógica adicional que necesites
onMounted(async () => {
    try {
        const response = await axios.post(route('get.data.user.ejercicios'));
        console.log(response.data);


        max_ejercicios.value = response.data.count_ejercicios;


    } catch (error) {
        console.error('Error al obtener los ejercicios:', error);
    }
});
</script>