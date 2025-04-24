// components/Can.vue
<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'


const props = defineProps<{
    permission: string
}>()

const page = usePage()
const permissions = computed(() => {
    const auth = page.props.auth as { permissions?: string[] } | undefined
    return (auth?.permissions || []) as string[]
})

const can = computed(() => permissions.value.includes(props.permission))
</script>


<template>
    <slot v-if="can" />
</template>
