<script setup>
import {Link} from '@inertiajs/inertia-vue3';

defineProps({
    item: Object,
});
</script>

<template>
    <div>
        <Link :href="route('items.show', item.id)">
            <div class="text-center p-3 hover:bg-gray-50 hover:text-indigo-400">
                {{ item.name }}
            </div>
        </Link>
    </div>
</template>
