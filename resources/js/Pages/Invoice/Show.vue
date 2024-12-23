<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddProductsModal from "./_partials/AddProductsModal.vue";
import { Head } from "@inertiajs/vue3";
import EditInvoiceModal from "./_partials/EditInvoiceModal.vue";
import DeleteInvoiceModal from "./_partials/DeleteInvoiceModal.vue";
import moment from "moment";
import StatusBadge from "@/Components/StatusBadge.vue";
import ProductsTable from "@/Components/ProductsTable.vue";

defineProps({
    invoice: {
        type: Object,
    },
    statuses: {
        type: Object,
    },
});

const truncateString = (str, limit) => {
    if (str.length > limit) {
        return str.slice(0, limit) + "...";
    } else {
        return str;
    }
};

const formattedDate = (date) => {
    return moment(String(date)).format("MM/DD/YYYY");
};
</script>

<template>

    <Head title="Invoice" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <span class="text-xl font-bold text-black dark:text-white">Invoice #{{ invoice.id
                    }}</span>
                <StatusBadge :statusObject="invoice.status" />
            </div>
        </template>

        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-0">
                <div class="flex flex-1 justify-between py-4 px-4 md:px-0">
                    <h1 class="text-2xl font-semibold mb-0 text-primary dark:text-primary-400">
                        <span class="hidden md:block">
                            {{ invoice.company_name }}
                        </span>
                    </h1>
                    <div>
                        <a class="btn btn-sm btn-accent rounded shadow-xl text-black dark:text-white"
                            :class="invoice.products.length == 0 ? 'btn-disabled' : ''" :href="route('invoice.generate.pdf', {
                                invoice: invoice.id,
                            })
                                " target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5">
                                <path
                                    d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625Z" />
                                <path
                                    d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                            </svg>
                            <span class="hidden md:block">Generate</span> PDF
                        </a>
                        <button class="btn btn-sm btn-neutral rounded shadow-xl ml-1"
                            onclick="editInvoiceModal.showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                            </svg>
                            <span class="hidden md:block">Edit</span>
                        </button>
                        <button class="btn btn-sm btn-error rounded shadow-xl text-black dark:text-white ml-1"
                            onclick="deleteInvoiceModal.showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="hidden md:block">Delete</span>
                        </button>
                        <DeleteInvoiceModal :invoice="invoice" />
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-950 overflow-hidden shadow-sm sm:rounded-lg">
                    <EditInvoiceModal :invoice="invoice" :statuses="statuses" />
                    <div class="p-4">
                        <!-- Company details -->
                        <div class="flex flex-col mb-1">
                            <span class="font-semibold text-lg border-l-2 border-primary p-1 pl-3 text-primary">Company
                                details</span>
                            <div class="py-3 flex flex-col">
                                <span class="text-black dark:text-white py-1">
                                    {{ invoice.company_name }}
                                </span>
                                <span class="text-black dark:text-white py-1">
                                    <span class="font-semibold">VAT number : </span>
                                    {{ invoice.company_vat_number }}
                                </span>
                                <span class="text-black dark:text-white py-1">
                                    <span class="font-semibold">Address : </span>
                                    {{ invoice.company_address_line_1 }},
                                    {{
                                        invoice.company_address_line_2
                                            ? invoice.company_address_line_2 + ", "
                                            : ""
                                    }}
                                    {{ invoice.company_city }},
                                    {{ invoice.company_county ? invoice.company_county + ", " : "" }}
                                    {{ invoice.company_postcode }}.
                                </span>
                            </div>
                        </div>

                        <!-- Client details -->
                        <div class="flex flex-col mb-1">
                            <span class="font-semibold text-lg border-l-2 border-primary p-1 pl-3 text-primary">Client
                                details</span>
                            <div class="py-3 flex flex-col">
                                <span class="text-black dark:text-white py-1">
                                    {{ invoice.client_name }}
                                </span>
                                <span class="text-black dark:text-white py-1">
                                    <span class="font-semibold">Address : </span>
                                    {{ invoice.client_address_line_1 }},
                                    {{
                                        invoice.client_address_line_2
                                            ? invoice.client_address_line_2 + ", "
                                            : ""
                                    }}
                                    {{ invoice.client_city }},
                                    {{ invoice.client_county ? invoice.client_county + ", " : "" }}
                                    {{ invoice.client_postcode }}.
                                </span>
                            </div>
                        </div>

                        <!-- Client details -->
                        <div class="flex flex-col mb-1">
                            <span class="font-semibold text-lg border-l-2 border-primary p-1 pl-3 text-primary">Invoice
                                details</span>
                            <div class="py-3 flex flex-col">
                                <span class="text-black dark:text-white py-1">
                                    <span class="font-semibold">Invoice date : </span>
                                    {{ formattedDate(invoice.invoice_date) }}
                                </span>

                                <span class="text-black dark:text-white py-1">
                                    <span class="font-semibold">Due date : </span>
                                    {{ formattedDate(invoice.due_date) }}
                                </span>

                                <span class="text-black dark:text-white py-1">
                                    <span class="font-semibold">Note : </span>
                                    <span v-if="invoice.note">{{ invoice.note }}</span>
                                    <span v-else><i class="text-gray-400">Not added yet</i></span>
                                </span>

                                <span class="text-black dark:text-white py-1">
                                    <span class="font-semibold">Created by : </span>
                                    {{ invoice.created_by.name }}
                                </span>
                            </div>
                        </div>
                        <!-- Invoiced products -->
                        <span class="font-semibold text-lg border-l-2 border-primary p-1 pl-3 mt-4 text-primary">
                            Invoiced products
                        </span>
                        <div class="flex md:justify-between justify-end py-4">
                            <span class="text-black dark:text-white" v-if="invoice.products.length == 0">
                                Please add your first product
                            </span>
                            <Button class="shadow-xl" variant="primary" raised onclick="productModal.showModal()">
                                <span>Add product</span>
                            </Button>

                            <AddProductsModal :invoice="invoice" />
                        </div>
                        <ProductsTable :invoice="invoice" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
