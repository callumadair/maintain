<script setup>
import RemoveMediaImage from 'iconoir/icons/remove-media-image.svg';

defineProps({
    images: Object,
})

const emit = defineEmits(['imagesChanged']);

const greyOut = (image_id) => {
    let image_element = document.getElementById("image" + image_id);

    if (image_element.classList.contains("grayscale")) {
        image_element.classList.remove("grayscale");
    } else {
        image_element.classList.add("grayscale");
    }
}
</script>

<template>
    <div>
        <div class="my-2 flex flex-row flex-wrap justify-center items-center bg-white shadow-xl rounded-lg mx-6 w-full">
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
    </div>
</template>
