<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

defineProps({
    invoice: {
        type: Object,
    },
});

const deleteProduct = (invoice, product) => {
    router.delete(
        route("invoice.product.delete", {
            invoice: invoice,
            product: product,
        }),
        {
            preserveScroll: true,
            preserveState: false,
        }
    );
};
</script>

<template>
    <div v-if="invoice.products.length > 0">
        <div class="overflow-x-auto py-4">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr class="bg-base-300">
                        <th class="font-semibold text-black">Product</th>
                        <th class="font-semibold text-black">Amount</th>
                        <th class="font-semibold text-black">Unit</th>
                        <th class="font-semibold text-black">Total charge</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in invoice.products" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.amount }}</td>
                        <td>{{ product.unit }}</td>
                        <td>{{ product.total_charge }}</td>
                        <td>
                            <button @click="
                                router.delete(
                                    route(
                                        'invoice.product.delete',
                                        {
                                            invoice: invoice.id,
                                            product: product.id,
                                        },
                                        {
                                            onSuccess: () => toast.success(page.props.flash.message),

                                            preserveScroll: true,
                                        }
                                    )
                                )
                                " class="btn btn-sm btn-error rounded shadow-xl text-white ml-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-5">
                                    <path fill-rule="evenodd"
                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-base-100">
                        <td class="font-semibold text-black">Sub total</td>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="font-semibold text-black">
                            {{ invoice.sub_total }}
                        </th>
                    </tr>
                    <tr class="bg-base-200">
                        <td class="font-semibold text-black">VAT %</td>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="font-semibold text-black">{{ invoice.vat_percentage }}%</th>
                    </tr>
                    <tr class="bg-base-300">
                        <td class="font-semibold text-black">Grand total</td>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="font-semibold text-black">
                            {{ invoice.total }}
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
