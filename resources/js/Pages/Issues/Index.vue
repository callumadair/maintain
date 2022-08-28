<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import IssueCard from '@/Pages/Issues/Partials/IssueCard.vue';

const props = defineProps({
    issues: {
        type: Array,
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

        <ContentStyle>
            <template #content>
                <ul>
                    <li v-for="issue in issues">
                        <IssueCard :issue="issue"/>
                    </li>
                </ul>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
