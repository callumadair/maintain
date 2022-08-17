<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Layouts/Partials/ContentStyle.vue';
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
