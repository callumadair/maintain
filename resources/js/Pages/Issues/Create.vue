<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Layouts/Partials/ContentStyle.vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

defineProps({
    originator: Object,
    item: Object,
});

const form = useForm({
    issue_title: null,
    issue_description: null,
    item_id: usePage().props.value.item.id,
    originator_id: usePage().props.value.originator.id,
})

function submit() {
    form.post(route('issues.store'));
}
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
                <form @submit.prevent="submit"
                      class="grid grid-cols-1 space-x-2 space-y-6 p-3 m-3 place-items-center">
                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_title">
                            Title
                        </label>
                        <input id="issue_title"
                               type="text"
                               v-model="form.issue_title">
                    </div>


                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_description">
                            Description
                        </label>
                        <textarea id="issue_description"
                                  v-model="form.issue_description"/>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="issue_images">
                            Images
                        </label>
                        <input id="issue_images"
                               name="image"
                               type="file"
                               accept="image/png, image/jpeg, image/jpg"
                               multiple>
                    </div>

                    <div class="py-6">
                        <button type="submit"
                                :disabled="form.processing">
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
