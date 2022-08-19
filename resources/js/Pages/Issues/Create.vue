<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

defineProps({
    originator: Object,
    item: Object,
});

const form = useForm({
    issue_title: null,
    issue_description: null,
    issue_images: null,
    item_id: usePage().props.value.item.id,
    originator_id: usePage().props.value.originator.id,
    //temporarily set the assignee id to the originator id value.
    assignee_id: usePage().props.value.originator.id,
})

const submit = () => form.post(route('issues.store'));
</script>

<template>
    <AppLayout title="Add a new issue">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add an issue
            </h2>
        </template>

        <ContentStyle>
            <template #content>
                <form class="grid grid-cols-1 space-x-2 space-y-6 p-3 m-3 place-items-center"
                      @submit.prevent="submit">
                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_title"
                        class="text-lg">
                            Title
                        </label>
                        <input id="issue_title"
                               v-model="form.issue_title"
                               class="m-3 rounded-lg text-center border-transparent bg-gray-50"
                               type="text">
                    </div>


                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_description"
                        class="text-lg">
                            Description
                        </label>
                        <textarea id="issue_description"
                                  v-model="form.issue_description"
                                  class="resize-none m-3 rounded-lg text-center border-transparent w-72 h-36 bg-gray-50"/>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_images"
                        class="text-lg">
                            Images
                        </label>
                        <input id="issue_images"
                               accept="image/png, image/jpeg, image/jpg"
                               multiple
                               name="image"
                               type="file"
                               @input="form.issue_images = $event.target.files"
                               class="file:rounded-lg file:p-2 file:bg-white file:border-transparent hover:file:text-indigo-400 hover:file:bg-gray-50 m-3 p-2 border-solid border-2 rounded-lg border-gray-300">
                    </div>

                    <div class="py-6">
                        <button :disabled="form.processing"
                                type="submit">
                            <span class="m-2 p-4 space-x-2 hover:bg-gray-50 hover:text-indigo-400 rounded-lg">
                            Create Issue
                            </span>
                        </button>
                    </div>
                </form>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
