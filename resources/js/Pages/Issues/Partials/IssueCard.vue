<script setup>
import {Link} from '@inertiajs/inertia-vue3';

defineProps({
    issue: Object,
});
</script>

<template>
    <div>
        <Link :href="route('issues.show', issue.id)" :data="issue">
            <div class="text-center p-3 hover:bg-gray-50 hover:text-indigo-400">
                {{ issue.name }}
            </div>
        </Link>
    </div>
</template>
