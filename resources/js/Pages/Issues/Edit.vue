<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import EditGallery from '@/Pages/Components/EditGallery.vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

const props = defineProps({
    originator: Object,
    issue: Object,
});

const form = useForm({
    issue_title: usePage().props.value.issue.title,
    issue_description: usePage().props.value.issue.description,
    issue_images: null,
    item_id: usePage().props.value.issue.item_id,
    originator_id: usePage().props.value.originator.id,
    //temporarily set the assignee id to the originator id value.
    assignee_id: usePage().props.value.originator.id,
    images_deleted: null,
})

const submit = () => form.post(route('issues.update', usePage().props.value.issue));

const imagesChangedSet = new Set();

const handleImagesChanged = (image_id) => {
    if (imagesChangedSet.has(image_id)) {
        imagesChangedSet.delete(image_id);
    } else {
        imagesChangedSet.add(image_id);
    }
    form.images_deleted = JSON.stringify(Array.from(imagesChangedSet));
};
</script>

<template>
    <AppLayout title="Edit this issue">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit this issue
            </h2>
        </template>

        <ContentStyle>
            <template #content>
                <form class="grid grid-cols-1 space-x-2 space-y-6 p-3 m-3 place-items-center"
                      @submit.prevent="submit">
                    <div class="grid justify-center place-items-center space-x-2">
                        <label class="text-lg"
                               for="issue_title">
                            Title
                        </label>
                        <input id="issue_title"
                               v-model="form.issue_title"
                               class="m-3 rounded-lg text-center border-transparent bg-gray-50"
                               type="text">
                    </div>


                    <div class="grid justify-center place-items-center space-x-2">
                        <label class="text-lg"
                               for="issue_description">
                            Description
                        </label>
                        <textarea id="issue_description"
                                  v-model="form.issue_description"
                                  class="resize-none m-3 rounded-lg text-center border-transparent w-72 h-36 bg-gray-50"/>
                    </div>

                    <div v-if="issue.images.length > 0">
                        <EditGallery :images="issue.images"
                                     @images-changed="handleImagesChanged"/>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label class="text-lg"
                               for="issue_images">
                            Images
                        </label>
                        <input id="issue_images"
                               accept="image/png, image/jpeg, image/jpg"
                               class="file:rounded-lg file:p-2 file:bg-white file:border-transparent hover:file:text-indigo-400 hover:file:bg-gray-50 p-2 border-solid border-2 rounded-lg border-gray-300"
                               multiple
                               name="image"
                               type="file"
                               @input="form.issue_images = $event.target.files">
                    </div>

                    <div class="justify-center place-items-center space-x-2 hover:bg-white">
                        <button :disabled="form.processing"
                                type="submit">
                            <span class="p-4 rounded-lg hover:bg-gray-50 hover:text-indigo-400">
                                Update Issue
                            </span>
                        </button>
                    </div>
                </form>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
