<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import InvoicesTable from "@/Components/InvoicesTable.vue";
import Pagination from "@/Components/Pagination.vue";

const page = usePage();
defineProps({
    invoices: {
        type: Object,
    },
});

const form = useForm({
    search: "",
});

function search() {
    form.get(route("invoice.index"));
}
</script>

<template>

    <Head title="Invoices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoices
            </h2>
        </template>

        <div class="py-12" v-auto-animate>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between w-full p-4">
                        <form @submit.prevent="search">
                            <div class="w-full md:w-auto mr-2">
                                <label class="input input-bordered flex items-center px-0 pl-1">
                                    <input type="text" v-model="form.search"
                                        class="grow border-0 border-transparent focus:border-transparent focus:ring-0 pr-0"
                                        placeholder="Search invoice" />
                                    <button type="submit" class="btn btn-ghost">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                            class="h-4 w-4 opacity-70">
                                            <path fill-rule="evenodd"
                                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </label>
                            </div>
                        </form>
                        <Link class="btn btn-success" :href="route('invoice.create')">
                        <span class="text-2xl pb-1 text-white">+</span>
                        <span class="hidden md:block text-white">Create invoice</span>
                        </Link>
                    </div>
                    <div v-if="page.props.query.search" class="px-4 py-2 shadow w-full inline-block">
                        Showing results for
                        <span class="underline"><b>{{ page.props.query.search }}</b></span>
                        <Link :href="route('invoice.index')" class="btn btn-sm btn-light ml-2">Reset</Link>
                    </div>
                    <InvoicesTable :invoices="invoices.data" />
                    <Pagination :links="invoices.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
