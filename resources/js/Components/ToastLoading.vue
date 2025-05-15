<template>
  <div class="container">
    <div class="flex gap-2 items-center">
      <Icon icon="mingcute:loading-3-line" class="animate-spin text-2xl" />
      <h3 class="card-title">Cargando, por favor espere...</h3>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue';
</script>