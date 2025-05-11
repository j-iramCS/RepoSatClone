<template>
    <Main>
        <div
            class="fixed left-0 top-0 right-0 flex justify-between md:hidden items-center bg-gray-50 dark:bg-gray-950 p-3 z-10">
            <Link :href="route('dashboard')" class="dark:text-gray-300 py-2 px-4">
            <Icon icon="hugeicons:arrow-left-02" class="text-3xl" />
            </Link>
            <h2 class="text-xl font-bold dark:text-gray-300">Administrar Usuarios</h2>
        </div>


        <DataTable :columns="columns" :data="data" :items-per-page="5" >

        </DataTable>





    </Main>
</template>

<script setup lang='ts'>
import Main from '@/Layouts/Main.vue';
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

import DataTable from '@/Components/DataTable.vue';

const columns = [
    { key: 'name', label: 'Nombre', sortable: true },
    { key: 'email', label: 'Email', sortable: true },
    { key: 'role', label: 'Rol', sortable: true },
    { key: 'created_at', label: 'Creado el', sortable: true },
];

const data = [
    { name: 'Juan Pérez', email: 'juan@gamilc.com', role: 'Admin', created_at: '2023-10-01' },
    { name: 'María López', email: 'maria@gmail.com', role: 'User', created_at: '2023-10-02' },
];



</script>

<style></style>