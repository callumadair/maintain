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

            <form method="POST" :action="route('items.store')" class="">

                <div>
                    <label>
                        Name
                    </label>
                    <input>
                </div>


                <div>
                    <label>
                        Description
                    </label>
                    <textarea></textarea>
                </div>

                <div>
                    <label>
                        Image
                    </label>
                    <input name="image" type="file" accept="image/png, image/jpeg, image/jpg">
                </div>

                <input name="user_id" type="hidden" value="{{user.id}}">

                <input type="submit" value="Create Post">
            </form>
    </AppLayout>
</template>
