<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ItemGallery from '@/Pages/Items/Partials/ItemGallery.vue';
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

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex p-2 bg-white overflow-hidden shadow-xl rounded-lg">
                    {{ item.description }}
                </div>

                <div v-if="item.images.length > 0">
                    <ItemGallery :images="item.images"/>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="flex justify-center">
                <div class="flex bg-white shadow-xl rounded-lg overflow-hidden">
                    <Link :href="route('items.edit', item.id)" :data="item">
                        <div class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Edit
                        </div>
                    </Link>


                    <button @click="destroy(item.id)">
                        <span class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Delete
                        </span>
                    </button>

                </div>
            </div>

        </div>

    </AppLayout>
</template>
