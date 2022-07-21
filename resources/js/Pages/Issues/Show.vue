<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    issue: Object
});
</script>

<template>
    <AppLayout :title="
    issue.name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ issue.description }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    Hello, world!
                </div>
            </div>
        </div>

    </AppLayout>
</template>
