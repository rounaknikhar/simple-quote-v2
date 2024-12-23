<script setup>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const form = useForm({
    status: "",
    invoice_date: "",
    due_date: "",
    company_name: "",
    company_address_line_1: "",
    company_address_line_2: "",
    company_city: "",
    company_county: "",
    company_postcode: "",
    company_vat_number: "",
    client_name: "",
    client_address_line_1: "",
    client_address_line_2: "",
    client_city: "",
    client_county: "",
    client_postcode: "",
    note: "",
    vat_percentage: 0,
});

function submit() {
    form.post(route("invoice.store"), {
        preserveScroll: true,
        onSuccess: () => toast.success(page.props.flash.message),
    });
}
</script>

<template>
    <Head title="Create Invoice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Invoice
            </h2>
        </template>

        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="px-6">
                    <div class="p-6">
                        <div class="grid grid-cols-1 m-3">
                            <div class="card bg-base-100 w-full shadow-xl">
                                <div class="card-body">
                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Invoice date
                                                <span class="text-red-600"
                                                    >*</span
                                                >
                                            </span>
                                        </div>
                                        <input
                                            type="date"
                                            v-model="form.invoice_date"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.invoice_date
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="form.errors?.invoice_date"
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{ form.errors?.invoice_date }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Due date
                                                <span class="text-red-600"
                                                    >*</span
                                                >
                                            </span>
                                        </div>
                                        <input
                                            type="date"
                                            v-model="form.due_date"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.due_date
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="form.errors?.due_date"
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{ form.errors?.due_date }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Note
                                            </span>
                                        </div>
                                        <textarea
                                            class="textarea textarea-bordered w-full"
                                            placeholder="Note"
                                            v-model="form.note"
                                        ></textarea>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 my-6 mx-3">
                            <div
                                class="card bg-base-100 w-full md:w-[95%] shadow-xl"
                            >
                                <div class="card-body">
                                    <h4 class="text-md font-bold pt-6">
                                        Company
                                    </h4>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Company VAT number
                                                <span class="text-red-600"
                                                    >*</span
                                                >
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            v-model="form.company_vat_number"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.company_vat_number
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="
                                                form.errors?.company_vat_number
                                            "
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{
                                                form.errors?.company_vat_number
                                            }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                VAT percentage
                                            </span>
                                        </div>
                                        <input
                                            type="number"
                                            min="0"
                                            v-model="form.vat_percentage"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.vat_percentage
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="form.errors?.vat_percentage"
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{ form.errors?.vat_percentage }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Name
                                                <span class="text-red-600"
                                                    >*</span
                                                >
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            v-model="form.company_name"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.company_name
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="form.errors?.company_name"
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{ form.errors?.company_name }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Address line 1
                                                <span class="text-red-600"
                                                    >*</span
                                                >
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            v-model="
                                                form.company_address_line_1
                                            "
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors
                                                    ?.company_address_line_1
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="
                                                form.errors
                                                    ?.company_address_line_1
                                            "
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{
                                                form.errors
                                                    ?.company_address_line_1
                                            }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Address line 2
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            v-model="
                                                form.company_address_line_2
                                            "
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors
                                                    ?.company_address_line_2
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="
                                                form.errors
                                                    ?.company_address_line_2
                                            "
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{
                                                form.errors
                                                    ?.company_address_line_2
                                            }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                City
                                                <span class="text-red-600"
                                                    >*</span
                                                >
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            v-model="form.company_city"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.company_city
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="form.errors?.company_city"
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{ form.errors?.company_city }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                County
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            v-model="form.company_county"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.company_county
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="form.errors?.company_county"
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{ form.errors?.company_county }}
                                        </span>
                                    </label>

                                    <label class="py-2 form-control w-full">
                                        <div class="label">
                                            <span class="label-text">
                                                Postcode
                                                <span class="text-red-600"
                                                    >*</span
                                                >
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            v-model="form.company_postcode"
                                            class="input input-bordered w-full"
                                            :class="
                                                form.errors?.company_postcode
                                                    ? 'border-red-600'
                                                    : ''
                                            "
                                        />
                                        <!-- Error message -->
                                        <span
                                            v-if="form.errors?.company_postcode"
                                            class="label-text-alt text-red-600 my-2"
                                        >
                                            {{ form.errors?.company_postcode }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="md:flex md:justify-end md:mt-0 mt-3">
                                <div
                                    class="card bg-base-100 w-full md:w-[95%] shadow-xl"
                                >
                                    <div class="card-body">
                                        <h4 class="text-md font-bold pt-6">
                                            Client
                                        </h4>

                                        <label class="py-2 form-control w-full">
                                            <div class="label">
                                                <span class="label-text">
                                                    Name
                                                    <span class="text-red-600"
                                                        >*</span
                                                    >
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                v-model="form.client_name"
                                                class="input input-bordered w-full"
                                                :class="
                                                    form.errors?.client_name
                                                        ? 'border-red-600'
                                                        : ''
                                                "
                                            />
                                            <!-- Error message -->
                                            <span
                                                v-if="form.errors?.client_name"
                                                class="label-text-alt text-red-600 my-2"
                                            >
                                                {{ form.errors?.client_name }}
                                            </span>
                                        </label>

                                        <label class="py-2 form-control w-full">
                                            <div class="label">
                                                <span class="label-text">
                                                    Address line 1
                                                    <span class="text-red-600"
                                                        >*</span
                                                    >
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                v-model="
                                                    form.client_address_line_1
                                                "
                                                class="input input-bordered w-full"
                                                :class="
                                                    form.errors
                                                        ?.client_address_line_1
                                                        ? 'border-red-600'
                                                        : ''
                                                "
                                            />
                                            <!-- Error message -->
                                            <span
                                                v-if="
                                                    form.errors
                                                        ?.client_address_line_1
                                                "
                                                class="label-text-alt text-red-600 my-2"
                                            >
                                                {{
                                                    form.errors
                                                        ?.client_address_line_1
                                                }}
                                            </span>
                                        </label>

                                        <label class="py-2 form-control w-full">
                                            <div class="label">
                                                <span class="label-text">
                                                    Address line 2
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                v-model="
                                                    form.client_address_line_2
                                                "
                                                class="input input-bordered w-full"
                                                :class="
                                                    form.errors
                                                        ?.client_address_line_2
                                                        ? 'border-red-600'
                                                        : ''
                                                "
                                            />
                                            <!-- Error message -->
                                            <span
                                                v-if="
                                                    form.errors
                                                        ?.client_address_line_2
                                                "
                                                class="label-text-alt text-red-600 my-2"
                                            >
                                                {{
                                                    form.errors
                                                        ?.client_address_line_2
                                                }}
                                            </span>
                                        </label>

                                        <label class="py-2 form-control w-full">
                                            <div class="label">
                                                <span class="label-text">
                                                    City
                                                    <span class="text-red-600"
                                                        >*</span
                                                    >
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                v-model="form.client_city"
                                                class="input input-bordered w-full"
                                                :class="
                                                    form.errors?.client_city
                                                        ? 'border-red-600'
                                                        : ''
                                                "
                                            />
                                            <!-- Error message -->
                                            <span
                                                v-if="form.errors?.client_city"
                                                class="label-text-alt text-red-600 my-2"
                                            >
                                                {{ form.errors?.client_city }}
                                            </span>
                                        </label>

                                        <label class="py-2 form-control w-full">
                                            <div class="label">
                                                <span class="label-text">
                                                    County
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                v-model="form.client_county"
                                                class="input input-bordered w-full"
                                                :class="
                                                    form.errors?.client_county
                                                        ? 'border-red-600'
                                                        : ''
                                                "
                                                placeholder="County"
                                            />
                                            <!-- Error message -->
                                            <span
                                                v-if="
                                                    form.errors?.client_county
                                                "
                                                class="label-text-alt text-red-600 my-2"
                                            >
                                                {{ form.errors?.client_county }}
                                            </span>
                                        </label>

                                        <label class="py-2 form-control w-full">
                                            <div class="label">
                                                <span class="label-text">
                                                    Postcode
                                                    <span class="text-red-600"
                                                        >*</span
                                                    >
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                v-model="form.client_postcode"
                                                class="input input-bordered w-full"
                                                :class="
                                                    form.errors?.client_postcode
                                                        ? 'border-red-600'
                                                        : ''
                                                "
                                                placeholder="Postcode"
                                            />
                                            <!-- Error message -->
                                            <span
                                                v-if="
                                                    form.errors?.client_postcode
                                                "
                                                class="label-text-alt text-red-600 my-2"
                                            >
                                                {{
                                                    form.errors?.client_postcode
                                                }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 m-3">
                            <div class="w-full md:flex md:justify-end">
                                <button
                                    type="submit"
                                    class="btn btn-primary mt-4 w-full md:w-56 text-white"
                                    :disabled="form.processing"
                                    :class="!form.isDirty ? 'btn-disabled' : ''"
                                >
                                    Next: Add products
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
