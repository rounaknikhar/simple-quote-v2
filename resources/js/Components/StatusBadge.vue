<script setup>
import Badge from 'primevue/badge';
defineProps({
    statusObject: {
        type: Object,
    },
});
</script>

<template>
    <Badge value="6" severity="success" class="text-white" v-if="statusObject.id === 2">{{ statusObject.name }}</Badge>
    <Badge value="6" severity="danger" v-else-if="statusObject.id === 3">{{ statusObject.name }}</Badge>
    <Badge value="6" severity="info" v-else>{{ statusObject.name }}</Badge>
</template>
