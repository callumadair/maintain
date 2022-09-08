<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import EditGallery from '@/Pages/Components/EditGallery.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';

import {InertiaForm, useForm, usePage} from '@inertiajs/inertia-vue3';
import {PropType} from "vue";
import Item = App.Models.Item;

const props = defineProps({
    item: {
        type: Object as PropType<Item>,
        required: true,
    },
});

const form: InertiaForm<{
    item_name: string,
    item_description: string | null,
    item_images: File[] | null,
    user_id: number,
    images_deleted: string | null,
}> = useForm({
    item_name: props.item.name,
    item_description: props.item.description,
    item_images: null,
    user_id: props.item.user_id,
    images_deleted: null,
});
const submit = () => form.post(route('items.update', usePage().props.value.item));

const imagesChangedSet = new Set();

const handleImagesChanged = (image_id: number) => {
    if (imagesChangedSet.has(image_id)) {
        imagesChangedSet.delete(image_id);
    } else {
        imagesChangedSet.add(image_id);
    }
    form.images_deleted = JSON.stringify(Array.from(imagesChangedSet));
};
</script>

<template>
    <AppLayout title="Edit this item">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Item Editing
            </h2>
        </template>

        <ContentStyle>
            <template #content>
                <form class="grid grid-cols-1 space-y-6 p-3 m-3 place-items-center"
                      @submit.prevent="submit">

                    <div class="grid justify-center place-items-center space-y-3">
                        <label class="text-lg"
                               for="item_name">
                            Edit the name
                        </label>
                        <input id="item_name"
                               v-model="form.item_name"
                               class="rounded-lg text-center border-transparent bg-gray-50"
                               type="text">
                    </div>


                    <div class="grid justify-center place-items-center space-y-3">
                        <label class="text-lg"
                               for="item_description">
                            Edit the description
                        </label>
                        <textarea id="item_description"
                                  v-model="form.item_description"
                                  class="resize-none rounded-lg text-center border-transparent w-72 h-36 bg-gray-50
                                  scrollbar-thin scrollbar-thumb-slate-200"/>
                    </div>

                    <div v-if="item.images.length > 0"
                         class="grid space-y-3 justify-center place-items-center text-lg">
                        <label for="edit_gallery">
                            Remove Images
                        </label>
                        <EditGallery id="edit_gallery"
                                     :images="item.images"
                                     @images-changed="handleImagesChanged"/>
                    </div>

                    <div class="grid justify-center place-items-center space-y-3">
                        <label for="item_images">
                            Add Images
                        </label>
                        <input id="item_images"
                               accept="image/png, image/jpeg, image/jpg"
                               class="m-3 p-2 rounded-lg border-2 border-gray-300 border-solid file:rounded-lg file:p-4 file:mr-4 file:bg-white file:border-transparent
                                        hover:file:text-indigo-400 hover:file:bg-gray-50 hover:file:cursor-pointer"
                               multiple
                               type="file"
                               @input="form.item_images = $event.target.files">
                    </div>

                    <div class="border-[1px] w-full border-gray-200 rounded-lg"/>

                    <div class="py-2">
                        <button id="update_button"
                                :disabled="form.processing"
                                type="submit">
                            <span class="p-4 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                                Update Item
                            </span>
                        </button>
                    </div>

                </form>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
