<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 text-center">
                    {{ issue.description }}
                </div>
            </div>
        </div>

        <div>
            <button >
                <Link :href="route('issues.edit', issue.id)" :data="issue">
                    Edit
                </Link>
            </button>

            <button @click="destroy(issue.id)">
                Delete
            </button>
        </div>

    </AppLayout>
</template>
