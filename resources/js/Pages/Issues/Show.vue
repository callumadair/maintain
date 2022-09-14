<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import Gallery from '@/Pages/Components/Gallery.vue';
import ItemCard from '@/Pages/Items/Partials/ItemCard.vue';

import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import {PropType} from "vue";
import Issue = App.Models.Issue;

const props = defineProps({
    issue: {
        type: Object as PropType<Issue>,
        required: true,
    },
});


const destroy = () => Inertia.delete(route('issues.destroy', props.issue.id));
</script>

<template>
    <AppLayout :title="issue.title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ issue.title }}
            </h2>
        </template>

        <ContentStyle>
            <template #content>

                <div id="associated_users"
                     class="flex space-x-24 justify-center text-center">
                    <div class="space-y-3">
                        <p class="text-xl">Originator</p>
                        <p>{{ issue.originator.name }}</p>
                    </div>
                    <div class="space-y-3">
                        <p class="text-xl">Assignee</p>
                        <p>{{ issue.assignee.name }}</p>
                    </div>
                </div>

                <div class="border-[1px] border-gray-200 rounded-lg"/>

                <div v-if="issue.description"
                     id="issue_description"
                     class="p-2 text-center">
                    {{ issue.description }}
                </div>

                <div v-if="issue.images.length > 0">
                    <Gallery :images="issue.images"/>
                </div>

                <div class="grid justify-center text-center">
                    <div class="w-96 grid rounded-lg overflow-hidden border-2">
                        <label class="p-2"
                               for="item_link">
                            Item this problem refers to:
                        </label>
                        <div class="border border-1 border-gray-200 rounded-lg"/>
                        <Link id="item_link"
                              :href="route('items.show', issue.item_id)"
                              class="p-2">
                            <ItemCard :item="issue.item"/>
                        </Link>
                    </div>
                </div>

                <div class="border-[1px] border-gray-200 rounded-lg"/>

                <div class="pb-4 flex justify-center">
                    <div class="flex overflow-hidden space-x-4">
                        <Link id="issue_edit_link"
                              :data="issue"
                              :href="route('issues.edit', issue.id)">
                            <div class="p-4 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                                Edit
                            </div>
                        </Link>

                        <button id="issue_delete_button"
                                type="button"
                                @click="destroy">
                            <span class="p-4 rounded-lg bg-red-600 text-white hover:bg-red-400">
                                Delete
                            </span>
                        </button>
                    </div>
                </div>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
