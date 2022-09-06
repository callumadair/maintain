<script setup>
import {onMounted, onUnmounted, ref} from 'vue';

let open = ref(false);

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));
</script>

<template>
    <div class="relative">
        <div @mouseenter="open = true"
             @mouseleave="open = false">
            <slot name="trigger"/>

            <transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
            >
                <div
                    v-show="open"
                    class="absolute z-50 mt-2 rounded-md shadow-lg"
                    style="display: none;"
                >
                    <div class="rounded-md ring-1 ring-black ring-opacity-5">
                        <slot name="content"/>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>
