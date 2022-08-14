<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Layouts/Partials/ContentStyle.vue';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

defineProps({
    issue: Object,
});

const destroy = (id) => Inertia.delete(route('issues.destroy', id));
</script>

<template>
    <AppLayout :title="issue.title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ issue.title }}
            </h2>
        </template>

        <ContentStyle>
            <template #content>
                {{ issue.description }}
            </template>
        </ContentStyle>

        <div class="py-6">
            <div class="flex justify-center">
                <div class="flex bg-white shadow-xl rounded-lg overflow-hidden">
                    <Link :href="route('issues.edit', issue.id)" :data="issue">
                        <div class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Edit
                        </div>
                    </Link>

                    <button @click="destroy(issue.id)">
                        <span class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Delete
                        </span>
                    </button>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
