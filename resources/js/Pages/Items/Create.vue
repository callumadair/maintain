<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {reactive} from 'vue';
import {Inertia} from '@inertiajs/inertia';

const form = reactive({
    item_name: null,
    item_description: null,
})

function submit() {
    Inertia.post('/items/store', form)
}

defineProps({
    user: Object,
});
</script>

<template>
    <AppLayout title="Add a new item">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add an item
            </h2>
        </template>

        <form @submit.prevent="submit" method="POST" :action="route('items.store')"
              class="grid grid-cols-1 space-x-2 space-y-6 p-3 m-3 place-items-center border-solid border-8 border-black">
            <div class="grid justify-center place-items-center space-x-2">
                <label for="item_name">
                    Name
                </label>
                <input id="item_name" v-model="form.item_name">
            </div>


            <div class="grid justify-center place-items-center space-x-2">
                <label for="item_description">
                    Description
                </label>
                <textarea id="item_description" v-model="form.item_description"/>
            </div>

            <div class="grid justify-center place-items-center space-x-2">
                <label for="item_images">
                    Images
                </label>
                <input id="item_images" name="image" type="file" accept="image/png, image/jpeg, image/jpg" multiple>
            </div>

            <!--            <div class="grid justify-center place-items-center space-x-2">-->
            <!--                <input name="user_id" type="hidden" value="{{user.id}}" v-model="form.user_id"/>-->
            <!--            </div>-->

            <div class="justify-center place-items-center space-x-2 hover:bg-white">
                <button type="submit">Create Item</button>
            </div>
        </form>
    </AppLayout>
</template>
