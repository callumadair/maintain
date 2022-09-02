<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
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

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-6">
                <div class="p-2 overflow-hidden">
                    <div class="grid grid-cols-4 gap-4 overflow-hidden">
                        <div v-for="item in items">
                            <ItemCard :item="item"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
