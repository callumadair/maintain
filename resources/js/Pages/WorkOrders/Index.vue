<script lang="ts" setup>
import {PropType} from "vue";
import WorkOrder = App.Models.WorkOrder;
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    workOrders: {
        type: Array as PropType<Array<WorkOrder>>,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Work Orders">
        <template #header>
            <div class="ml-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Work Orders
                </h2>
            </div>
        </template>
    </AppLayout>
</template>
