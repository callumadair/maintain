<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

defineProps({
    item: Object,
});

const destroy = (id) => Inertia.delete(route('items.destroy', id));
</script>

<template>
    <AppLayout :title="item.name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ item.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{ item.description }}
                </div>
            </div>

            <div v-if="item.images.length > 0">
<!--                <ItemGallery :images="item.images" />-->
                <img :src="item.images[0]['image_path']" alt="image">
            </div>
        </div>

        <div>
            <button >
                <Link :href="route('items.edit', item.id)" :data="item">
                    Edit
                </Link>
            </button>

            <button @click="destroy(item.id)">
                    Delete
            </button>
        </div>

    </AppLayout>
</template>
