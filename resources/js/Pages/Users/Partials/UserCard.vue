<script lang="ts" setup>
import {PropType} from "vue";
import User = App.Models.User;

const props = defineProps({
    user: {
        type: Object as PropType<User>,
        required: true,
    }
});
</script>

<template>
    <div :id="'user' + user.id"
         class="px-4 py-2 rounded-lg text-center hover:bg-gray-50 hover:text-indigo-400">
        <button type="button"
                @click="$emit('userSelected', user.id)">
            {{ user.name }}
        </button>
    </div>
</template>
