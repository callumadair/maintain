<script setup>
import {Link} from '@inertiajs/inertia-vue3';

defineProps({
    issue: Object,
});
</script>

<template>
    <div>
        <Link :data="issue"
              :href="route('issues.show', issue.id)">
            <div class="text-center p-3 hover:bg-gray-50 hover:text-indigo-400">
                {{ issue.title }}
            </div>
        </Link>
    </div>
</template>
