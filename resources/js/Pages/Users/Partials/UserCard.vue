<script lang="ts" setup>
import {PropType} from "vue";
import User = App.Models.User;

const props = defineProps({
    user: {
        type: Object as PropType<User>,
        required: true,
    }
});

const greyOut = (user_id: number) => {
    let user_element = document.getElementById("user" + user_id) as HTMLDivElement;
    user_element.classList.toggle("bg-gray-50");
    user_element.classList.toggle("text-indigo-400");
};
</script>

<template>
    <div :id="'user' + user.id"
         class="px-4 py-2 rounded-lg text-center hover:bg-gray-50 hover:text-indigo-400">
        <button type="button"
                @click="greyOut(user.id);
                $emit('userSelected', user.id)">
            {{ user.name }}
        </button>
    </div>
</template>
