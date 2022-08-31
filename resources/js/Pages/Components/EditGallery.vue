<script lang="ts" setup>
import RemoveMediaImage from 'iconoir/icons/remove-media-image.svg';
import {PropType} from "vue";
import Image = App.Models.Image;

const props = defineProps({
    images: {
        type: Array as PropType<Array<Image>>,
        required: true,
    },
})

const emit = defineEmits(['imagesChanged']);

const greyOut = (image_id: number) => {
    let image_element: HTMLImageElement = document.getElementById("image" + image_id) as HTMLImageElement;

    if (image_element.classList.contains("grayscale")) {
        image_element.classList.remove("grayscale");
    } else {
        image_element.classList.add("grayscale");
    }
}
</script>

<template>
        <div
            class="mx-6 my-2 flex flex-row flex-wrap justify-center items-center bg-white shadow-xl rounded-lg border-solid border-2 border-gray-200">
            <div v-for="image in images"
                 class="w-48 m-6">
                <button type="button"
                        @click="greyOut(image.id);
                        $emit('imagesChanged', image.id)">
                    <img :src="RemoveMediaImage" alt="Delete square.">
                </button>
                <img :id="'image' + image.id"
                     :src="image['image_path']"
                     alt="An image of an item"/>

            </div>
        </div>
</template>
