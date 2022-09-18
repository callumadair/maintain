<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import EditGallery from '@/Pages/Components/EditGallery.vue';
import UserCard from '@/Pages/Users/Partials/UserCard.vue';

import {InertiaForm, Link, useForm} from '@inertiajs/inertia-vue3';
import {PropType} from "vue";
import User = App.Models.User;
import Issue = App.Models.Issue;

const props = defineProps({
    issue: {
        type: Object as PropType<Issue>,
        required: true,
    },
    users: {
        type: Array as PropType<Array<User>>,
        required: true,
    },
});

const form: InertiaForm<{
    issue_title: string,
    issue_description: string | null,
    issue_status: string,
    issue_images: File[],
    item_id: number,
    originator_id: number,
    assignee_id: number,
    images_deleted: string | null,
}> = useForm({
    issue_title: props.issue.title,
    issue_description: props.issue.description,
    issue_status: props.issue.status,
    issue_images: [],
    item_id: props.issue.item_id,
    originator_id: props.issue.originator_id,
    assignee_id: props.issue.assignee_id,
    images_deleted: null,
});

const acknowledgeAssignment = () => {
    if (props.issue.status === "Assigned") {
        let acknowledgeButton: HTMLButtonElement =
            document.getElementById("acknowledge_button") as HTMLButtonElement;
        acknowledgeButton.classList.toggle("bg-gray-50");
        acknowledgeButton.classList.toggle("text-indigo-400");

        if (form.issue_status === "Assigned") {
            form.issue_status = "In-Progress";
        } else if (form.issue_status === "In-Progress") {
            form.issue_status = "Assigned";
        }
    }
};

const imagesChangedSet = new Set();

const handleImagesChanged = (imageID: number) => {
    if (imagesChangedSet.has(imageID)) {
        imagesChangedSet.delete(imageID);
    } else {
        imagesChangedSet.add(imageID);
    }
    form.images_deleted = JSON.stringify(Array.from(imagesChangedSet));
};

const handleUserSelected = (userID: number) => {
    let userElements = (document.getElementById("users_list") as HTMLDivElement).children;

    for (let i = 0; i < userElements.length; i++) {
        let userElement = userElements[i];
        userElement.classList.remove("bg-gray-50");
        userElement.classList.remove("text-indigo-400");
    }

    form.assignee_id = userID;
    let selectedElement = document.getElementById("user" + userID) as HTMLElement;
    selectedElement.classList.add("bg-gray-50");
    selectedElement.classList.add("text-indigo-400");
};

const submit = () => form.put(route('issues.update', props.issue));
</script>

<template>
    <AppLayout title="Edit this issue">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Issue Editing - {{ issue.title }}
            </h2>
        </template>

        <div class="flex w-full justify-center">
            <div class="flex flex-row place-self-center self-center max-w-7xl">
                <aside class="flex flex-col mt-6 ml-4 p-2 space-y-2 w-64 h-fit rounded-md shadow-md
                           bg-white text-left text-sm">
                    <button id="acknowledge_button"
                            class="p-4 rounded text-left hover:bg-gray-50 hover:text-indigo-400"
                            type="button"
                            @click="acknowledgeAssignment()">
                        Acknowledge
                    </button>

                    <div class="border-[1px] border-gray-100 rounded-lg"/>

                    <Link :href="route('work_orders.create', issue)"
                          class="p-4 rounded text-left hover:bg-gray-50 hover:text-indigo-400"
                          type="button">
                        Action work
                    </Link>

                    <div class="border-[1px] border-gray-100 rounded-lg"/>

                    <button class="p-4 rounded text-left hover:bg-gray-50 hover:text-indigo-400"
                            type="button">
                        Resolve
                    </button>
                </aside>

                <ContentStyle>
                    <template #content>
                        <form id="issue_edit_form"
                              class="grid grid-cols-1 space-y-12 p-3 m-3 justify-center place-items-center"
                              @submit.prevent="submit">

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

                            <div class="w-full border-[1px] border-gray-200 rounded-lg"/>

                            <div class="grid space-y-3 justify-center place-items-center">
                                <label class="text-lg"
                                       for="issue_title">
                                    Edit the issue title
                                </label>
                                <input id="issue_title"
                                       v-model="form.issue_title"
                                       class="rounded-lg text-center border-transparent bg-gray-50"
                                       type="text">
                            </div>


                            <div class="grid space-y-3 justify-center place-items-center">
                                <label class="text-lg"
                                       for="issue_description">
                                    Edit the issue description
                                </label>
                                <textarea id="issue_description"
                                          v-model="form.issue_description"
                                          class="w-96 h-48 resize-none rounded-lg text-center border-transparent bg-gray-50
                                        scrollbar-thin scrollbar-thumb-slate-200"/>
                            </div>

                            <div v-if="issue.images.length > 0"
                                 class="grid space-y-3 justify-center place-items-center text-lg">
                                <label for="edit_gallery">
                                    Remove Images
                                </label>
                                <EditGallery id="edit_gallery"
                                             :images="issue.images"
                                             @images-changed="handleImagesChanged"/>
                            </div>

                            <div class="grid space-y-3 justify-center place-items-center">
                                <label class="text-lg"
                                       for="issue_images">
                                    Add Images
                                </label>
                                <input id="issue_images"
                                       accept="image/png, image/jpeg, image/jpg"
                                       class="m-3 p-2 rounded-lg border-2 border-gray-300 border-solid file:rounded-lg file:p-4 file:mr-4 file:bg-white file:border-transparent
                                        hover:file:text-indigo-400 hover:file:bg-gray-50 hover:file:cursor-pointer"
                                       multiple
                                       name="image"
                                       type="file"
                                       @input="form.issue_images = $event.target.files">
                            </div>

                            <div class="grid justify-center space-y-3 place-items-center">
                                <label class="text-lg"
                                       for="user_select">
                                    Select a user to change the assignee of this issue to:
                                </label>

                                <div id="users_list"
                                     class="max-h-48 w-[30rem] overflow-y-scroll
                                    scrollbar-thin scrollbar-thumb-slate-200">
                                    <UserCard v-for="user in users"
                                              :id="'user' + user.id"
                                              :user="user"
                                              @user-selected="handleUserSelected"/>
                                </div>
                            </div>

                            <div class="border-[1px] w-full border-gray-200 rounded-lg"/>

                            <div class="py-6">
                                <button :disabled="form.processing"
                                        type="submit">
                            <span class="p-4 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                                Update Issue
                            </span>
                                </button>
                            </div>
                        </form>
                    </template>
                </ContentStyle>
            </div>
        </div>
    </AppLayout>
</template>
