<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

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

        <form method="POST" :action="route('items.store')"
              class="flex-cols space-x-2 space-y-6 p-3 m-3 place-items-center border-solid border-8 border-black">

            <div class="flex justify-center space-x-2">
                <label>
                    Name
                </label>
                <input>
            </div>


            <div class="flex justify-center space-x-2">
                <label>
                    Description
                </label>
                <textarea></textarea>
            </div>

            <div class="flex justify-center space-x-2">
                <label>
                    Image
                </label>
                <input name="image" type="file" accept="image/png, image/jpeg, image/jpg">
            </div>

            <div class="flex justify-center space-x-2">
                <input name="user_id" type="hidden" value="{{user.id}}">
            </div>

            <div class="flex justify-center hover:bg-white">
                <input type="submit" value="Create Post">
            </div>
        </form>
    </AppLayout>
</template>
