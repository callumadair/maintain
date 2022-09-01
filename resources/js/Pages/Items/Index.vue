<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import ItemCard from '@/Pages/Items/Partials/ItemCard.vue';

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
    <AppLayout title="Inventory">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inventory
            </h2>
        </template>

        <ContentStyle>
            <template #content>
                <ul>
                    <li v-for="item in items">
                        <ItemCard :item="item"/>
                    </li>
                </ul>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
