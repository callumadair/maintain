<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import EditGallery from '@/Pages/Components/EditGallery.vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

defineProps({
    originator: Object,
    issue: Object,
});

const form = useForm({
    issue_title: usePage().props.value.issue.title,
    issue_description: usePage().props.value.issue.description,
    issue_images: usePage().props.value.issue.images,
    item_id: usePage().props.value.issue.item_id,
    originator_id: usePage().props.value.originator.id,
    //temporarily set the assignee id to the originator id value.
    assignee_id: usePage().props.value.originator.id,
})

function submit() {
    form.post(route('issues.update', usePage().props.value.issue));
}
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
                        <label for="issue_title">
                            Title
                        </label>
                        <input id="issue_title"
                               v-model="form.issue_title"
                               type="text">
                    </div>


                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_description">
                            Description
                        </label>
                        <textarea id="issue_description"
                                  v-model="form.issue_description"/>
                    </div>

                    <div v-if="issue.images.length > 0">
                        <EditGallery :images="issue.images"/>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_images">
                            Images
                        </label>
                        <input id="issue_images"
                               accept="image/png, image/jpeg, image/jpg"
                               multiple
                               name="image"
                               type="file"
                               @input="form.issue_images = $event.target.files">
                    </div>

                    <div class="justify-center place-items-center space-x-2 hover:bg-white">
                        <button :disabled="form.processing"
                                type="submit">
                            Update Issue
                        </button>
                    </div>
                </form>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
