<script lang="ts" setup>
import JetNavLink from '@/Jetstream/NavLink.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ItemCard from '@/Pages/Items/Partials/ItemCard.vue';

import BoxIso from 'iconoir/icons/box-iso.svg';

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
            <div class="ml-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Inventory
                </h2>

                <nav class="mt-4 py-2 flex flex-row space-x-6  bg-white">
                    <img :src="BoxIso"
                         alt="Inventory icon"/>

                    <JetNavLink :active="route().current('items.index.all')"
                                :href="route('items.index.all')"
                                class="text-base">
                        <h3 class="mb-2">All Items</h3>
                    </JetNavLink>

                    <JetNavLink :active="route().current('items.index.functional')"
                                :href="route('items.index.functional')"
                                class="text-base">
                        <h3 class="mb-2">Functional</h3>
                    </JetNavLink>

                    <JetNavLink :active="route().current('items.index.disabled')"
                                :href="route('items.index.disabled')"
                                class="text-base">
                        <h3 class="mb-2">Disabled</h3>
                    </JetNavLink>
                </nav>
            </div>
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
