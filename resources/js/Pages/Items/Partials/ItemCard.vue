<script lang="ts" setup>
import {Link} from '@inertiajs/inertia-vue3';
import {PropType} from "vue";
import Item = App.Models.Item;

const props = defineProps({
    item: {
        type: Object as PropType<Item>,
        required: true
    },
});
</script>

<template>
    <Link :data="item"
          :href="route('items.show', item.id)">
        <div class="grid h-48 p-3 text-center place-items-center rounded-lg bg-white text-lg border-2 border-transparent
            hover:text-indigo-400 hover:border-2 hover:border-indigo-200">
            {{ item.name }}
            <div v-if="item.images.length > 0"
                 class="w-48 place-items-center">
                <img :src="item.images[0]['image_path']"
                     alt="First image linked to this item, if it has any.">
            </div>
        </div>
    </Link>

</template>
