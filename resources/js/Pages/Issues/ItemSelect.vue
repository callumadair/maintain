<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';

import {PropType} from "vue";
import Item = App.Models.Item;

const props = defineProps({
    items: {
        type: Array as PropType<Array<Item>>,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Item Selection Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Select an Item
            </h2>
        </template>

        <ContentStyle>
            <template #content>
                <ul>
                    <li v-for="item in items">
                        {{ item.name}}
                    </li>
                </ul>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
