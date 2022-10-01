<script lang="ts" setup>
import {PropType} from "vue";
import WorkOrder = App.Models.WorkOrder;

const props = defineProps({
    workOrder: {
        type: Object as PropType<WorkOrder>,
        required: true,
    }
});
</script>

<template>
    {{ workOrder.description}}
</template>

