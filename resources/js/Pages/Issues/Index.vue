<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import IssueCard from '@/Pages/Issues/Partials/IssueCard.vue';

defineProps({
    issues: Object,
});
</script>

<template>
    <AppLayout title="Issue Log">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Issue Log
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ul>
                        <li v-for="issue in issues">
                            <IssueCard :issue="issue"/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
