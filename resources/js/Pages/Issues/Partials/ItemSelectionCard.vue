<script lang="ts" setup>
import {Link} from "@inertiajs/inertia-vue3";
import {PropType} from "vue";
import Item = App.Models.Item;

const props = defineProps({
    item: {
        type: Object as PropType<Item>,
        required: true,
    },
});
</script>

<template>
    <Link :href="route('issues.create', item.id)">
        <div class="flex flex-row flex-nowrap bg-white p-6 w-96 hover:bg-gray-50 rounded-lg overflow-hidden">
            <div class="flex-1">
                {{ item.name }}
            </div>
            <img v-if="item.images.length > 0"
                 :src="item.images[0]['image_path']"
                 alt="First image linked to this item, if it has any."
                 class="w-36 justify-self-end">
        </div>
    </Link>
</template>
