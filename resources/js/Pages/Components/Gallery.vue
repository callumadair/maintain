<script setup>
const props = defineProps({
    images: Object,
});
</script>

<template>
    <div>
        <div class="my-2 flex flex-row flex-wrap justify-center items-center bg-white shadow-xl rounded-lg mx-6">
            <div v-for="image in images"
                 class="w-48 m-6">
                <img :src="image['image_path']"
                     alt="An image of an item">
            </div>
        </div>
    </div>
</template>
