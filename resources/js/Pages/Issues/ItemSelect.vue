<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ItemSelectionCard from "./Partials/ItemSelectionCard.vue";

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

        <div class="grid justify-center">
            <div class="py-6 grid grid-cols-3 gap-x-4 gap-y-2 rounded-lg justify-center">
                <div v-for="item in items"
                     class="my-2 overflow-hidden">
                    <ItemSelectionCard :item="item"/>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
