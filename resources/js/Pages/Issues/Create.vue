<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';

defineProps({
    user: Object,
});

const form = useForm({
    issue_title: null,
    issue_description: null,
    user_id: usePage().props.value.user.id,
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

        <form @submit.prevent="submit"
              class="grid grid-cols-1 space-x-2 space-y-6 p-3 m-3 place-items-center border-solid border-8 border-black">
            <div class="grid justify-center place-items-center space-x-2">
                <label for="issue_title">
                    Title
                </label>
                <input id="issue_title" type="text" v-model="form.issue_title">
            </div>


            <div class="grid justify-center place-items-center space-x-2">
                <label for="issue_description">
                    Description
                </label>
                <textarea id="issue_description" v-model="form.issue_description"/>
            </div>

            <div class="grid justify-center place-items-center space-x-2">
                <label for="issue_images">
                    Images
                </label>
                <input id="issue_images" name="image" type="file" accept="image/png, image/jpeg, image/jpg" multiple>
            </div>

            <div class="justify-center place-items-center space-x-2 hover:bg-white">
                <button type="submit" :disabled="form.processing">Create Issue</button>
            </div>
        </form>
    </AppLayout>
</template>
