<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    item: Object
});
</script>

<template>
    <AppLayout title="{{$page.props.item.name}}">

    </AppLayout>
</template>
