<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';
import UserCard from "@/Pages/Users/Partials/UserCard.vue";

import {InertiaForm, useForm} from '@inertiajs/inertia-vue3';
import {PropType} from "vue";
import User = App.Models.User;
import Item = App.Models.Item;

const props = defineProps({
    originator: {
        type: Object as PropType<User>,
        required: true,
    },
    item: {
        type: Object as PropType<Item>,
        required: true,
    },
    users: {
        type: Array as PropType<Array<User>>,
        required: true
    },
});

const form: InertiaForm<{
    issue_title: string | null,
    issue_description: string | null,
    issue_images: File[] | null,
    item_id: number,
    originator_id: number,
    assignee_id: number,
}> = useForm({
    issue_title: null,
    issue_description: null,
    issue_images: null,
    item_id: props.item.id,
    originator_id: props.originator.id,
    //temporarily set the assignee id to the originator id value.
    assignee_id: props.originator.id,
});

const handleUserSelected = (user_id: number) => {
    let userElements = (document.getElementById("users_list") as HTMLDivElement).children;

    for (let i = 0; i < userElements.length; i++) {
        let userElement = userElements[i];
        userElement.classList.remove("bg-gray-50");
        userElement.classList.remove("text-indigo-400");
    }

    let selectedElement = document.getElementById("user" + user_id) as HTMLElement;
    selectedElement.classList.toggle("bg-gray-50");
    selectedElement.classList.toggle("text-indigo-400");
};

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

                    <div class="grid justify-center place-items-center space-x-2">
                        <label class="text-lg"
                               for="issue_images">
                            Images
                        </label>
                        <input id="issue_images"
                               accept="image/png, image/jpeg, image/jpg"
                               class="file:rounded-lg file:p-2 file:bg-white file:border-transparent hover:file:text-indigo-400 hover:file:bg-gray-50 m-3 p-2 border-solid border-2 rounded-lg border-gray-300"
                               multiple
                               name="image"
                               type="file"
                               @input="form.issue_images = $event.target.files">
                    </div>

                    <div class="grid justify-center space-y-3 place-items-center">
                        <label class="text-lg"
                               for="user_select">
                            Select a user to assign this issue to:
                        </label>

                        <div id="users_list">
                            <UserCard v-for="user in users"
                                      :id="'user' + user.id"
                                      :user="user"
                                      @user-selected="handleUserSelected"/>
                        </div>
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
