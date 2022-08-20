<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import EditGallery from '@/Pages/Components/EditGallery.vue';
import ContentStyle from '@/Pages/Components/ContentStyle.vue';

import {useForm, usePage} from '@inertiajs/inertia-vue3';

defineProps({
    user: Object,
    item: Object,
});

const form = useForm({
    item_name: usePage().props.value.item.name,
    item_description: usePage().props.value.item.description,
    item_images: null,
    user_id: usePage().props.value.user.id,
    images_changed: new Set(),
});
const submit = () => form.post(route('items.update', usePage().props.value.item));

const handleImagesChanged = (image_id) => {
    if (form.images_changed.has(image_id)) {
        form.images_changed.delete(image_id);
    } else {
        form.images_changed.add(image_id);
    }
};
</script>

<template>
    <AppLayout title="Edit this item">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit this item
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

                    <div v-if="item.images.length > 0">
                        <EditGallery v-model="form.images_changed"
                                     :images="item.images"
                                     @images-changed="handleImagesChanged"/>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="item_images">
                            Add Images
                        </label>
                        <input id="item_images"
                               accept="image/png, image/jpeg, image/jpg"
                               class="file:rounded-lg file:p-2 file:bg-white file:border-transparent hover:file:text-indigo-400 hover:file:bg-gray-50 p-2 border-solid border-2 rounded-lg border-gray-300"
                               multiple
                               type="file"
                               @input="form.item_images = $event.target.files">
                    </div>

                    <div class="py-2">
                        <button id="update_button"
                                :disabled="form.processing"
                                type="submit">
                            <span class="p-4 rounded-lg hover:bg-gray-50 hover:text-indigo-400">
                                Update Item
                            </span>
                        </button>
                    </div>

                </form>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
