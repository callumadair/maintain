<script lang="ts" setup>
import {PropType} from "vue";
import WorkOrder = App.Models.WorkOrder;

const props = defineProps({
    workOrders: {
        type: Array as PropType<Array<WorkOrder>>,
        required: true,
    },
});
</script>

<template>

</template>
