<script lang="ts" setup>
import {Link} from '@inertiajs/inertia-vue3';
import {PropType} from "vue";
import Item = App.Models.Item;

defineProps({
    item: {
        type: Object as PropType<Item>,
        required: true
    },
});
</script>

<template>
    <div>
        <Link :data="item"
              :href="route('items.show', item.id)">
            <div class="grid text-center place-items-center p-3 rounded-lg hover:bg-gray-50 hover:text-indigo-400">
                {{ item.name }}
                <div v-if="item.images.length > 0"
                     class="w-48 place-items-center">
                    <img :src="item.images[0]['image_path']"
                         alt="First image linked to this item, if it has any.">
                </div>
            </div>
        </Link>
    </div>
</template>
