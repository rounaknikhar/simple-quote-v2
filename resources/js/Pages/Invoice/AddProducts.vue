<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AddProductsModal from "./_partials/AddProductsModal.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ProductsTable from "@/Components/ProductsTable.vue";

defineProps({
    invoice: Object,
});
</script>

<template>
    <Head title="Add products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add products Invoice#{{ invoice.id }}
            </h2>
        </template>

        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex md:justify-between justify-end p-12">
                    <span v-if="invoice.products.length == 0"
                        >Please add your first product</span
                    >
                    <button
                        class="btn btn-sm btn-primary text-white rounded shadow-xl"
                        onclick="productModal.showModal()"
                    >
                        <span>Add product</span>
                    </button>

                    <AddProductsModal :invoice="invoice" />
                </div>

                <div>
                    <!-- Invoiced products -->
                    <div v-if="invoice.products.length > 0" class="px-12 pb-12">
                        <span
                            class="font-semibold text-lg border-l-2 border-primary p-1 pl-3 mt-4"
                        >
                            Invoiced products
                        </span>
                        <ProductsTable :invoice="invoice" />
                        <div class="flex justify-end">
                            <Link
                                class="btn btn-primary mt-4 w-full md:w-56 text-white"
                                :href="
                                    route('invoice.show', {
                                        invoice: invoice.id,
                                    })
                                "
                            >
                                Finish
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
