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
            <div class="grid text-center place-items-center p-3 hover:bg-gray-50 hover:text-indigo-400">
                {{ issue.title }}
                <div v-if="issue.images.length > 0"
                     class="w-48 place-items-center">
                    <img :src="issue.images[0]['image_path']"
                         alt="First image linked to this issue, if it has any.">
                </div>
            </div>
        </Link>
    </div>
</template>
