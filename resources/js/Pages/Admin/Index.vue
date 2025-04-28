<template>
  <Main>
    <!-- Cabecera con efectos de degradado y mejora visual -->
    <div class="flex flex-col md:flex-row flex-wrap justify-between items-start md:items-center mb-8">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Panel de Control</h1>
        <p class="text-gray-600">Administración central del sistema</p>
      </div>
      <div class="flex mt-3 flex-wrap">
        <div class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm mr-2 flex items-center justify-center">
          <Icon icon="mdi:clock-outline" class="mr-1" />
          {{ currentDate }}
        </div>
        <div class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm flex items-center justify-center">
          <Icon icon="mdi:account" class="mr-1" />
          Admin
        </div>
      </div>
    </div>

    <!-- Panel de métricas principales con mejores indicadores visuales -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <!-- Usuarios -->
      <div class="bg-white dark:bg-[#171b2e] p-5 rounded-lg shadow-md border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold dark:text-white">Usuarios Registrados</h2>
          <Icon icon="mdi:account-check" class="text-blue-500 text-2xl" />
        </div>
        <p class="text-3xl font-bold mt-2 dark:text-white">9</p>
      </div>

      <!-- Tasa de Conversión -->
      <div class="bg-white dark:bg-[#171b2e] p-5 rounded-lg shadow-md border-l-4 border-purple-500 hidden">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold dark:text-white">Tasa de Conversión</h2>
          <Icon icon="mdi:chart-line" class="text-purple-500 text-2xl" />
        </div>
        <p class="text-3xl font-bold mt-2 dark:text-white">23.8%</p>
      </div>

      <!-- Certificaciones -->
      <div class="bg-white dark:bg-[#171b2e] p-5 rounded-lg shadow-md border-l-4 border-amber-500 hidden">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold dark:text-white">Certificaciones</h2>
          <Icon icon="mdi:certificate" class="text-amber-500 text-2xl" />
        </div>
        <p class="text-3xl font-bold mt-2 dark:text-white">142</p>
      </div>

      <!-- Nuevo: Eficiencia del Sistema -->
      <div class="bg-white dark:bg-[#171b2e] p-5 rounded-lg shadow-md border-l-4 border-green-500 hidden">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold dark:text-white">Eficiencia</h2>
          <Icon icon="mdi:gauge" class="text-green-500 text-2xl" />
        </div>
        <p class="text-3xl font-bold mt-2 dark:text-white">98.2%</p>
      </div>
    </div>

    <!-- Vista rápida y actividad reciente con tabs -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <!-- Gráfico de resumen (simplificado) -->
      <Link href="/admin/usuarios"
        class="bg-white dark:bg-[#171b2e] p-5 rounded-lg shadow-md flex flex-col items-center justify-center hover:shadow-lg transition-all duration-300">
      <div class="bg-blue-100 p-3 rounded-full mb-3 dark:bg-blue-900">
        <Icon icon="hugeicons:user-group-02" class="text-2xl text-blue-500 dark:text-blue-300" />
      </div>
      <span class="text-sm font-semibold dark:text-white">Gestión de Usuarios</span>
      <div class="text-blue-500 text-xs flex items-center mt-2 dark:text-blue-300">
        <Icon icon="mdi:arrow-right" class="mr-1" />
        <span>Administrar cuentas</span>
      </div>
      </Link>

      <Link href="/admin/reportes"
        class="bg-white dark:bg-[#171b2e] p-5 rounded-lg shadow-md flex flex-col items-center justify-center hover:shadow-lg transition-all duration-300">
      <div class="bg-red-100 p-3 rounded-full mb-3 dark:bg-red-900">
        <Icon icon="hugeicons:access" class="text-2xl text-red-500 dark:text-red-300" />
      </div>
      <span class="text-sm font-semibold dark:text-white">Roles y Permisos</span>
      <div class="text-red-500 text-xs flex items-center mt-2 dark:text-red-300">
        <Icon icon="mdi:arrow-right" class="mr-1" />
        <span>Configurar accesos</span>
      </div>
      </Link>

      <!-- Actividad reciente mejorada -->
      <div class="bg-white rounded-lg shadow-md dark:bg-[#171b2e]">
        <div class="p-4 border-b dark:border-gray-600">
          <h2 class="text-lg font-semibold dark:text-white">Actividad Reciente</h2>
        </div>
        <div class="p-4">
          <ul class="space-y-4">
            <li class="flex items-start">
              <div class="bg-blue-100 p-2 rounded-full mr-3">
                <Icon icon="mdi:account-plus" class="text-blue-600" />
              </div>
              <div>
                <p class="text-sm font-medium dark:text-white">Se registraron 24 nuevos usuarios</p>
                <p class="text-xs text-gray-500">Hoy, 10:42 AM</p>
              </div>
            </li>
            <li class="flex items-start">
              <div class="bg-green-100 p-2 rounded-full mr-3">
                <Icon icon="mdi:cash-multiple" class="text-green-600" />
              </div>
              <div>
                <p class="text-sm font-medium dark:text-white">Facturación mensual completada</p>
                <p class="text-xs text-gray-500">Ayer, 11:20 PM</p>
              </div>
            </li>
            <li class="flex items-start">
              <div class="bg-red-100 p-2 rounded-full mr-3">
                <Icon icon="mdi:alert" class="text-red-600" />
              </div>
              <div>
                <p class="text-sm font-medium dark:text-white">Alerta: 3 intentos fallidos</p>
                <p class="text-xs text-gray-500">17/04/2025, 8:32 AM</p>
              </div>
            </li>
          </ul>
          <button
            class="w-full mt-4 text-sm text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
            Ver todas las actividades →
          </button>
        </div>
      </div>
    </div>

  </Main>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Icon } from "@iconify/vue/dist/iconify.js";
import { Link } from "@inertiajs/vue3";
import Main from "@/Layouts/Main.vue";

// Fecha actual formateada
const currentDate = ref(new Date().toLocaleDateString('es-MX', {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric'
}));

// Aquí puedes agregar cualquier lógica adicional que necesites
onMounted(() => {
  // Código de inicialización si es necesario
});
</script>