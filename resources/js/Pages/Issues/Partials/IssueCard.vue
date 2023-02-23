<script lang="ts" setup>
import {Link} from '@inertiajs/inertia-vue3';
import {PropType} from "vue";
import Issue = App.Models.Issue;

const props = defineProps({
    issue: {
        type: Object as PropType<Issue>,
        required: true
    },
});
</script>

<template>
    <Link :id="'issue_' + issue.id + '_card'"
          :data="issue"
          :href="route('issues.show', issue.id)">
        <div class="grid p-3 h-48 bg-white text-center place-items-center rounded-lg text-lg
             hover:text-indigo-400 hover:border-2 hover:border-indigo-200">
            <p :id="'issue_' + issue.id + '_title'">
                {{ issue.title }}
            </p>
            <div v-if="issue.images.length > 0"
                 class="flex w-36 justify-center">
                <img :src="issue.images[0]['image_path']"
                     alt="First image linked to this issue, if it has any."
                     class="object-scale-down max-h-24">
            </div>
        </div>
    </Link>
</template>
