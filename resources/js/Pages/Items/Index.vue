<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ItemCard from '@/Pages/Items/Partials/ItemCard.vue';

defineProps({
    items: Object,
});
</script>

<template>
    <AppLayout title="Inventory">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inventory
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ul>
                        <li v-for="item in items">
                            <ItemCard :item="item"/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
