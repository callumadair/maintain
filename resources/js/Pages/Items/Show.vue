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

        <ContentStyle>
            <template #content>
                <div v-if="item.description"
                     id="item_description"
                     class="p-2 text-center">
                    {{ item.description }}
                </div>

                <div v-if="item.images.length > 0"
                     id="images_gallery">
                    <Gallery :images="item.images"/>
                </div>

                <div v-if="item.issues.length > 0"
                     class="grid justify-center text-center">
                    <div class="p-4 w-96 flex flex-col rounded-lg overflow-hidden border-2">
                        <label class="m-2"
                               for="issues_list">
                            Issues associated with this item.
                        </label>

                        <div class="border-b-2 border-gray-200 rounded-lg"/>

                        <div class="m-2 overflow-y-scroll max-h-24 scrollbar-thin scrollbar-thumb-slate-200">
                            <ul id="issues_list">
                                <li v-for="issue in item.issues">
                                    <Link id="issue_show_link"
                                          :href="route('issues.show', issue.id)">
                                        <div class="p-2 hover:bg-gray-50 hover:text-indigo-400 rounded-lg">
                                            {{ issue.title }}
                                        </div>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div v-if="item.issues.length > 0"
                     class="border-[1px] border-gray-200 rounded-lg"/>

                <div class="pb-4 flex justify-center">
                    <div class="flex justify-center overflow-hidden space-x-4">
                        <Link id="add_issue_link"
                              :href="route('issues.create', item.id)">
                            <div class="p-4 bg-green-600 text-white hover:bg-green-400 rounded-lg">
                                Add a new issue
                            </div>
                        </Link>

                        <Link id="item_edit_link"
                              :data="item"
                              :href="route('items.edit', item.id)">
                            <div class="p-4 bg-blue-600 text-white hover:bg-blue-400 rounded-lg">
                                Edit item
                            </div>
                        </Link>

                        <button id="item_delete_button"
                                type="button"
                                @click="destroy(item.id)">
                                <span class="p-4 bg-red-600 text-white hover:bg-red-400 rounded-lg">
                                    Delete item
                                </span>
                        </button>
                    </div>
                </div>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
