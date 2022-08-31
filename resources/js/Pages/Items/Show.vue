<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import Gallery from '@/Pages/Components/Gallery.vue';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import {PropType} from "vue";
import Item = App.Models.Item;

const props = defineProps({
    item: {
        type: Object as PropType<Item>,
        required: true,
    },
});

const destroy = (id: number) => Inertia.delete(route('items.destroy', id));
</script>

<template>
    <AppLayout :title="item.name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ item.name }}
            </h2>
        </template>

        <ContentStyle v-if="item.description">
            <template #content>
                {{ item.description }}
            </template>
        </ContentStyle>

        <div v-if="item.images.length > 0">
            <Gallery :images="item.images"/>
        </div>

        <div v-if="item.issues.length > 0"
             class="py-2">
            <div class="grid justify-center text-center ">
                <div class="flex flex-col bg-white shadow-xl rounded-lg overflow-hidden w-96">
                    <label class="m-2"
                           for="issues_list">
                        Issues associated with this item.
                    </label>
                    <div class="m-2 overflow-y-scroll max-h-24 scrollbar-thin scrollbar-thumb-slate-300">
                        <ul id="issues_list">
                            <li v-for="issue in item.issues">
                                <Link :href="route('issues.show', issue.id)">
                                    <div class="p-2 hover:bg-gray-50 hover:text-indigo-400 rounded-lg">
                                        {{ issue.title }}
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="flex justify-center">
                <div class="flex bg-white shadow-xl rounded-lg overflow-hidden justify-center">
                    <Link :data="item" :href="route('issues.create')">
                        <div class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Add a new issue
                        </div>
                    </Link>

                    <Link :data="item" :href="route('items.edit', item.id)">
                        <div class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Edit item
                        </div>
                    </Link>

                    <button type="button"
                            @click="destroy(item.id)">
                        <span class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Delete item
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
