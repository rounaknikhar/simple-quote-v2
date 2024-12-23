<script setup>
import { Link } from "@inertiajs/vue3";
import StatusBadge from "@/Components/StatusBadge.vue";
import moment from "moment";

defineProps({
    invoices: {
        type: Object,
    },
});

const formattedDate = (date) => {
    return moment(String(date)).format("MM/DD/YYYY");
};
</script>

<template>
    <div class="overflow-x-auto" v-auto-animate>
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th>Invoice id</th>
                    <th>Client name</th>
                    <th>Due date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                <tr v-for="invoice in invoices" v-if="invoices.length">
                    <td>
                        {{ invoice.id }}
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="font-bold">
                                    {{ invoice.client_name }}
                                </div>
                                <div class="text-sm opacity-50">
                                    {{ invoice.client_country }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ formattedDate(invoice.due_date) }}
                    </td>
                    <td>£ {{ invoice.total }}</td>
                    <td>
                        <StatusBadge :statusObject="invoice.status" />
                    </td>
                    <th>
                        <Link class="btn btn-primary btn-sm text-white" :href="route('invoice.show', { invoice: invoice.id })
                            ">
                        Details
                        </Link>
                    </th>
                </tr>
                <tr v-else>
                    <td colspan="6">
                        <p class="text-center text-sm">
                            You don't have any invoice!
                            <Link :href="route('invoice.create')">Create one</Link>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
