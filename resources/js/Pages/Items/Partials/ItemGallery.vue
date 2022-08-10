<script setup>
defineProps({
    images: Object,
});
</script>

<template>
    <div>
        <div class="my-2 flex flex-row flex-wrap justify-center items-center bg-white shadow-xl rounded-lg">
            <div class="w-48 m-6"
                 v-for="image in images">
                <img :src="image['image_path']"
                     alt="An image of an item">
            </div>
        </div>
    </div>
</template>
