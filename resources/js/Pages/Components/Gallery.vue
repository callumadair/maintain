<script lang="ts" setup>
import {PropType} from "vue";
import Image = App.Models.Image;

const props = defineProps({
    images: {
        type: Array as PropType<Array<Image>>,
        required: true,
    },
});
</script>

<template>
    <div>
        <div id="images_gallery"
             class="my-2 mx-6 flex flex-row flex-wrap justify-center items-center bg-white rounded-lg border-2">
            <div v-for="image in images"
                 class="w-48 m-6">
                <img :id="'image-' + image.id"
                     :src="image['image_path']"
                     alt="An image of an item">
            </div>
        </div>
    </div>
</template>
