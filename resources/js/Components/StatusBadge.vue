<script setup>
defineProps({
    statusObject: {
        type: Object,
    },
});
</script>

<template>
    <div
        class="badge bg-success text-white shadow-lg"
        v-if="statusObject.id === 2"
    >
        {{ statusObject.name }}
    </div>
    <div
        class="badge bg-light text-error shadow-lg"
        v-else-if="statusObject.id === 3"
    >
        {{ statusObject.name }}
    </div>
    <div class="badge bg-warning text-white shadow-lg" v-else>
        {{ statusObject.name }}
    </div>
</template>
