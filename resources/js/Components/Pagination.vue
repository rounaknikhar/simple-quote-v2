<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: {
        type: Object,
    },
});

</script>
<template>
    <div v-if="links.length > 3" class="my-5">
        <div class="flex flex-wrap -mb-1 justify-center">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" :key="key"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded bg-base text-gray-400 text-disabled"
                    v-html="link.label" />
                <Link v-else v-auto-animate
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:border-primary hover:text-dark"
                    :class="{ 'bg-primary text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>
