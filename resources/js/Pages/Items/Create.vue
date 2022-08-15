<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentStyle from '@/Layouts/Partials/ContentStyle.vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

defineProps({
    user: Object,
});

const form = useForm({
    item_name: null,
    item_description: null,
    item_images: null,
    user_id: usePage().props.value.user.id,
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
                        <label for="item_name">
                            Name
                        </label>
                        <input v-model="form.item_name"
                               type="text">
                    </div>


                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="item_description">
                            Description
                        </label>
                        <textarea id="item_description"
                                  v-model="form.item_description"/>
                    </div>

                    <div class="grid justify-center place-items-center space-x-2">
                        <label for="item_images">
                            Images
                        </label>
                        <input id="item_images"
                               accept="image/png, image/jpeg, image/jpg"
                               multiple
                               name="image"
                               type="file"
                               @input="form.item_images = $event.target.files"/>
                    </div>


                    <div class="py-6">
                        <button :disabled="form.processing"
                                type="submit">
                        <span class="m-2 p-4 space-x-2 hover:bg-gray-50 hover:text-indigo-400 rounded-lg">
                            Create Item
                        </span>
                        </button>
                    </div>

                </form>
            </template>
        </ContentStyle>
    </AppLayout>
</template>
