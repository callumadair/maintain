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
        <div class="p-6 w-80 h-36 flex flex-row flex-nowrap place-items-center bg-white rounded-lg overflow-hidden
        hover:text-indigo-400 hover:border-2 hover:border-indigo-300 text-lg">
            <div class="flex-1">
                {{ item.name }}
            </div>
            <img v-if="item.images.length > 0"
                 :src="item.images[0]['image_path']"
                 alt="First image linked to this item, if it has any."
                 class="h-3/4">
        </div>
    </Link>
</template>
