<script lang="ts" setup>
import JetNavLink from '@/Jetstream/NavLink.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import WorkOrderCard from "./Partials/WorkOrderCard.vue";

import {PropType} from "vue";
import WorkOrder = App.Models.WorkOrder;

import Page from 'iconoir/icons/page.svg';

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

                <nav class="mt-4 py-2 flex flex-row space-x-6">
                    <img :src="Page"
                         alt="Page icon"/>

                    <JetNavLink :active="route().current('work_orders.index', 'all')"
                                :href="route('work_orders.index', 'all')"
                                class="text-base">
                        <h3 class="mb-2">
                            All Work Orders
                        </h3>
                    </JetNavLink>

                    <JetNavLink :active="route().current('work_orders.index', 'requested')"
                                :href="route('work_orders.index', 'requested')"
                                class="text-base">
                        <h3 class="mb-2">
                            Requested
                        </h3>
                    </JetNavLink>

                    <JetNavLink :active="route().current('work_orders.index', 'approved')"
                                :href="route('work_orders.index', 'approved')"
                                class="text-base">
                        <h3 class="mb-2">
                            Approved
                        </h3>
                    </JetNavLink>

                    <JetNavLink :active="route().current('work_orders.index', 'completed')"
                                :href="route('work_orders.index', 'completed')"
                                class="text-base">
                        <h3 class="mb-2">
                            Completed
                        </h3>
                    </JetNavLink>
                </nav>
            </div>
        </template>

        <div v-for="workOrder in workOrders">
            <WorkOrderCard :workOrder="workOrder"/>
        </div>
    </AppLayout>
</template>
