<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import IssueCard from '@/Pages/Issues/Partials/IssueCard.vue';
import {PropType} from "vue";
import Issue = App.Models.Issue;

const props = defineProps({
    issues: {
        type: Array as PropType<Array<Issue>>,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Issue Log">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Issue Log
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-6">
                <div class="p-2 overflow-hidden">
                    <div class="grid grid-cols-4 gap-4 overflow-hidden">
                        <div v-for="issue in issues">
                            <IssueCard :issue="issue"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
