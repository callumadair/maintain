<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Layouts/Partials/ContentStyle.vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

defineProps({
    user: Object,
    item: Object,
});

const form = useForm({
    item_name: usePage().props.value.item.name,
    item_description: usePage().props.value.item.description,
    item_images: usePage().props.value.item.images,
    user_id: usePage().props.value.user.id,
})

const submit = () => form.post(route('items.update', usePage().props.value.item));
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
                <form @submit.prevent="submit"
                      class="grid grid-cols-1 space-x-2 space-y-6 p-3 m-3 place-items-center">
                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="item_name">
                            Name
                        </label>
                        <input type="text"
                               v-model="form.item_name">
                    </div>


                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="item_description">
                            Description
                        </label>
                        <textarea id="item_description"
                                  v-model="form.item_description">
                </textarea>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="item_images">
                            Images
                        </label>
                        <input id="item_images"
                               type="file"
                               accept="image/png, image/jpeg, image/jpg"
                               multiple
                               @input="form.item_images = $event.target.files">
                    </div>

                    <div class="py-2">
                        <button type="submit"
                                :disabled="form.processing">
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
