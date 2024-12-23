<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const props = defineProps({
    invoice: {
        type: Object,
    },
    statuses: {
        type: Object,
    },
});

const form = useForm({
    status: props.invoice.status.id,
    invoice_date: props.invoice.invoice_date,
    due_date: props.invoice.due_date,
    company_name: props.invoice.company_name,
    company_address_line_1: props.invoice.company_address_line_1,
    company_address_line_2: props.invoice.company_address_line_2,
    company_city: props.invoice.company_city,
    company_county: props.invoice.company_county,
    company_postcode: props.invoice.company_postcode,
    company_vat_number: props.invoice.company_vat_number,
    client_name: props.invoice.client_name,
    client_address_line_1: props.invoice.client_address_line_1,
    client_address_line_2: props.invoice.client_address_line_2,
    client_city: props.invoice.client_city,
    client_county: props.invoice.client_county,
    client_postcode: props.invoice.client_postcode,
    sub_total: props.invoice.sub_total,
    vat_percentage: props.invoice.vat_percentage,
    total: props.invoice.total,
    note: props.invoice.note,
});

function submit() {
    form.patch(route("invoice.update", { invoice: props.invoice.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success(page.props.flash.message);
            editInvoiceModal.close();
        },
    });
}
</script>
<template>
    <dialog id="editInvoiceModal" class="modal">
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-950 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white dark:bg-gray-950 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="modal-box w-11/12 max-w-2xl">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-alert absolute right-2 top-2 text-dark dark:text-white">
                                            ✕
                                        </button>
                                    </form>
                                    <form>
                                        <h3 class="text-lg font-bold text-black dark:text-white">
                                            Edit invoice #{{ props.invoice.id }}
                                        </h3>
                                        <div class="py-4">
                                            <div class="grid grid-cols-1">
                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white"> Status
                                                        </span>
                                                    </div>

                                                    <select v-model="form.status"
                                                        class="input input-bordered w-full text-black dark:text-white">
                                                        <option v-for="status in props.statuses" :value="status.id">
                                                            {{ status.name }}
                                                        </option>
                                                    </select>

                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.status"
                                                        class="label-text text-red-600 my-2">
                                                        {{ form.errors?.status }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Invoice date
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="date" v-model="form.invoice_date"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.invoice_date ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.invoice_date"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.invoice_date }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Due date
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="date" v-model="form.due_date"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.due_date ? 'border-red-600' : ''" />
                                                    Error message
                                                    <span v-if="form.errors?.due_date"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.due_date }}
                                                    </span>
                                                </label>

                                                <h4 class="text-md font-bold pt-6">Company</h4>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Company VAT number
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.company_vat_number"
                                                        class="input input-bordered w-full" :class="form.errors?.company_vat_number ? 'border-red-600' : ''
                                                            " />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.company_vat_number"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.company_vat_number }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Name
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.company_name"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.company_name ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.company_name"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.company_name }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Address line 1
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.company_address_line_1"
                                                        class="input input-bordered w-full" :class="form.errors?.company_address_line_1 ? 'border-red-600' : ''
                                                            " />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.company_address_line_1"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.company_address_line_1 }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white"> Address
                                                            line 2 </span>
                                                    </div>
                                                    <input type="text" v-model="form.company_address_line_2"
                                                        class="input input-bordered w-full" :class="form.errors?.company_address_line_2 ? 'border-red-600' : ''
                                                            " />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.company_address_line_2"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.company_address_line_2 }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            City
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.company_city"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.company_city ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.company_city"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.company_city }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white"> County
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.company_county"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.company_county ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.company_county"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.company_county }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Postcode
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.company_postcode"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.company_postcode ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.company_postcode"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.company_postcode }}
                                                    </span>
                                                </label>

                                                <h4 class="text-md font-bold pt-6">Client</h4>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Name
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.client_name"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.client_name ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.client_name"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.client_name }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Address line 1
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.client_address_line_1"
                                                        class="input input-bordered w-full" :class="form.errors?.client_address_line_1 ? 'border-red-600' : ''
                                                            " />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.client_address_line_1"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.client_address_line_1 }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white"> Address
                                                            line 2 </span>
                                                    </div>
                                                    <input type="text" v-model="form.client_address_line_2"
                                                        class="input input-bordered w-full" :class="form.errors?.client_address_line_2 ? 'border-red-600' : ''
                                                            " />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.client_address_line_2"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.client_address_line_2 }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            City
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.client_city"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.client_city ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.client_city"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.client_city }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white"> County
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.client_county"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.client_county ? 'border-red-600' : ''"
                                                        placeholder="County" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.client_county"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.client_county }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Postcode
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="text" v-model="form.client_postcode"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.client_postcode ? 'border-red-600' : ''"
                                                        placeholder="Postcode" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.client_postcode"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.client_postcode }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full hidden">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Sub total
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="number" min="0" step=".01" v-model="form.sub_total"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.sub_total ? 'border-red-600' : ''"
                                                        placeholder="Sub total" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.sub_total"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.sub_total }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Vat percentage
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="number" min="0" v-model="form.vat_percentage"
                                                        class="input input-bordered w-full"
                                                        :class="form.errors?.vat_percentage ? 'border-red-600' : ''"
                                                        placeholder="Vat percentage" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.vat_percentage"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.vat_percentage }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full hidden">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white">
                                                            Total
                                                            <span class="text-red-600">*</span>
                                                        </span>
                                                    </div>
                                                    <input type="number" min="0" step=".01" v-model="form.total"
                                                        class="input input-bordered w-full" placeholder="Total"
                                                        :class="form.errors?.total ? 'border-red-600' : ''" />
                                                    <!-- Error message -->
                                                    <span v-if="form.errors?.total"
                                                        class="label-text text-black dark:text-white-alt text-red-600 my-2">
                                                        {{ form.errors?.total }}
                                                    </span>
                                                </label>

                                                <label class="py-2 form-control w-full">
                                                    <div class="label">
                                                        <span class="label-text text-black dark:text-white"> Note
                                                        </span>
                                                    </div>
                                                    <textarea class="textarea textarea-bordered w-full"
                                                        placeholder="Note" v-model="form.note"></textarea>
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <Button type="button" @click.prevent="submit" :disabled="form.processing"
                                :class="!form.isDirty ? 'btn-disabled' : ''" class="">
                                Update
                            </Button>
                            <button type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </dialog>
</template>
