<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    item: Object,
});
</script>

<template>
    <div>
        <Link>{{ item.name }}</Link>
    </div>
</template>
