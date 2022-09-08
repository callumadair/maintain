<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';

import {InertiaForm, useForm} from '@inertiajs/inertia-vue3';
import {PropType} from "vue";
import User = App.Models.User;

const props = defineProps({
    auth_user: {
        type: Object as PropType<User>,
        required: true,
    },
});

const form: InertiaForm<{
    item_name: string | null,
    item_description: string | null,
    item_images: File[] | null,
    user_id: number,
}> = useForm({
    item_name: null,
    item_description: null,
    item_images: null,
    user_id: props.auth_user.id,
})

const submit = () => form.post(route('items.store'));
</script>

<template>
    <AppLayout title="Add a new item">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add an item
            </h2>
        </template>

        <ContentStyle>
            <template #content>
                <form class="grid grid-cols-1 space-x-2 space-y-6 p-3 m-3 place-items-center"
                      @submit.prevent="submit">
                    <div class="grid justify-center place-items-center space-x-2">
                        <label class="text-lg"
                               for="item_name">
                            Name
                        </label>
                        <input id="item_name"
                               v-model="form.item_name"
                               class="m-3 rounded-lg text-center border-transparent bg-gray-50"
                               type="text">
                    </div>


                    <div class="grid justify-center place-items-center space-x-2">
                        <label class="text-lg"
                               for="item_description">
                            Description
                        </label>
                        <textarea id="item_description"
                                  v-model="form.item_description"
                                  class="resize-none m-3 rounded-lg text-center border-transparent w-72 h-36 bg-gray-50"/>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label class="text-lg"
                               for="item_images">
                            Images
                        </label>
                        <input id="item_images"
                               accept="image/png, image/jpeg, image/jpg"
                               class="m-3 p-2 rounded-lg border-2 border-gray-300 border-solid file:rounded-lg file:p-4 file:m-1 file:bg-white file:border-transparent
                                        hover:file:text-indigo-400 hover:file:bg-gray-50 hover:file:cursor-pointer"
                               multiple
                               name="image"
                               type="file"
                               @input="form.item_images = $event.target.files"
                        />
                    </div>

                    <div class="border-[1px] w-full border-gray-200 rounded-lg"/>

                    <div class="py-6">
                        <button :disabled="form.processing"
                                type="submit">
                        <span class="m-2 p-4 rounded-lg bg-green-600 text-white hover:bg-green-400 ">
                            Create Item
                        </span>
                        </button>
                    </div>

                </form>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
