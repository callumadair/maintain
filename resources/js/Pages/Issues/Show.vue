<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import Gallery from '@/Pages/Components/Gallery.vue';
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


const destroy = (id: number) => Inertia.delete(route('issues.destroy', id));
</script>

<template>
    <AppLayout :title="issue.title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ issue.title }}
            </h2>
        </template>

        <ContentStyle v-if="issue.description">
            <template #content>
                {{ issue.description }}
            </template>
        </ContentStyle>

        <div v-if="issue.images.length > 0">
            <Gallery :images="issue.images"/>
        </div>

        <div class="pb-6 pt-8">
            <div class="grid justify-center text-center">
                <div class="grid p-2 bg-white shadow-xl rounded-lg overflow-hidden w-96">
                    <label class="p-2"
                           for="item_link">
                        {{ issue.title }}'s item
                    </label>
                    <div class="border border-1 my-2 border-gray-300 rounded-lg"/>
                    <Link id="item_link"
                          :href="route('items.show', issue.item_id)"
                          class="p-2 hover:text-indigo-400">
                        {{ issue.item.name }}
                    </Link>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="flex justify-center">
                <div class="flex bg-white shadow-xl rounded-lg overflow-hidden">
                    <Link :data="issue"
                          :href="route('issues.edit', issue.id)">
                        <div class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Edit
                        </div>
                    </Link>

                    <button type="button"
                            @click="destroy(issue.id)">
                        <span class="p-4 hover:bg-gray-50 hover:text-indigo-400">
                            Delete
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
