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
        <div class="modal-box w-11/12 max-w-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <form @submit.prevent="submit">
                <h3 class="text-lg font-bold">Edit invoice #{{ props.invoice.id }}</h3>
                <div class="py-4">
                    <div class="grid grid-cols-1">
                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text"> Status </span>
                            </div>

                            <select v-model="form.status" class="input input-bordered w-full">
                                <option v-for="status in props.statuses" :value="status.id">
                                    {{ status.name }}
                                </option>
                            </select>

                            <!-- Error message -->
                            <span v-if="form.errors?.status" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.status }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Invoice date
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="date" v-model="form.invoice_date" class="input input-bordered w-full"
                                :class="form.errors?.invoice_date ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.invoice_date" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.invoice_date }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Due date
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="date" v-model="form.due_date" class="input input-bordered w-full"
                                :class="form.errors?.due_date ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.due_date" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.due_date }}
                            </span>
                        </label>

                        <h4 class="text-md font-bold pt-6">Company</h4>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Company VAT number
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.company_vat_number" class="input input-bordered w-full"
                                :class="form.errors?.company_vat_number ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.company_vat_number" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.company_vat_number }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Name
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.company_name" class="input input-bordered w-full"
                                :class="form.errors?.company_name ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.company_name" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.company_name }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Address line 1
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.company_address_line_1" class="input input-bordered w-full"
                                :class="form.errors?.company_address_line_1 ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.company_address_line_1" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.company_address_line_1 }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text"> Address line 2 </span>
                            </div>
                            <input type="text" v-model="form.company_address_line_2" class="input input-bordered w-full"
                                :class="form.errors?.company_address_line_2 ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.company_address_line_2" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.company_address_line_2 }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    City
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.company_city" class="input input-bordered w-full"
                                :class="form.errors?.company_city ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.company_city" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.company_city }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text"> County </span>
                            </div>
                            <input type="text" v-model="form.company_county" class="input input-bordered w-full"
                                :class="form.errors?.company_county ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.company_county" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.company_county }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Postcode
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.company_postcode" class="input input-bordered w-full"
                                :class="form.errors?.company_postcode ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.company_postcode" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.company_postcode }}
                            </span>
                        </label>

                        <h4 class="text-md font-bold pt-6">Client</h4>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Name
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.client_name" class="input input-bordered w-full"
                                :class="form.errors?.client_name ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.client_name" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.client_name }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Address line 1
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.client_address_line_1" class="input input-bordered w-full"
                                :class="form.errors?.client_address_line_1 ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.client_address_line_1" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.client_address_line_1 }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text"> Address line 2 </span>
                            </div>
                            <input type="text" v-model="form.client_address_line_2" class="input input-bordered w-full"
                                :class="form.errors?.client_address_line_2 ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.client_address_line_2" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.client_address_line_2 }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    City
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.client_city" class="input input-bordered w-full"
                                :class="form.errors?.client_city ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.client_city" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.client_city }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text"> County </span>
                            </div>
                            <input type="text" v-model="form.client_county" class="input input-bordered w-full"
                                :class="form.errors?.client_county ? 'border-red-600' : ''" placeholder="County" />
                            <!-- Error message -->
                            <span v-if="form.errors?.client_county" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.client_county }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Postcode
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="text" v-model="form.client_postcode" class="input input-bordered w-full"
                                :class="form.errors?.client_postcode ? 'border-red-600' : ''" placeholder="Postcode" />
                            <!-- Error message -->
                            <span v-if="form.errors?.client_postcode" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.client_postcode }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full hidden">
                            <div class="label">
                                <span class="label-text">
                                    Sub total
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="number" min="0" step=".01" v-model="form.sub_total"
                                class="input input-bordered w-full"
                                :class="form.errors?.sub_total ? 'border-red-600' : ''" placeholder="Sub total" />
                            <!-- Error message -->
                            <span v-if="form.errors?.sub_total" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.sub_total }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text">
                                    Vat percentage
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="number" min="0" v-model="form.vat_percentage"
                                class="input input-bordered w-full"
                                :class="form.errors?.vat_percentage ? 'border-red-600' : ''"
                                placeholder="Vat percentage" />
                            <!-- Error message -->
                            <span v-if="form.errors?.vat_percentage" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.vat_percentage }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full hidden">
                            <div class="label">
                                <span class="label-text">
                                    Total
                                    <span class="text-red-600">*</span>
                                </span>
                            </div>
                            <input type="number" min="0" step=".01" v-model="form.total"
                                class="input input-bordered w-full" placeholder="Total"
                                :class="form.errors?.total ? 'border-red-600' : ''" />
                            <!-- Error message -->
                            <span v-if="form.errors?.total" class="label-text-alt text-red-600 my-2">
                                {{ form.errors?.total }}
                            </span>
                        </label>

                        <label class="py-2 form-control w-full">
                            <div class="label">
                                <span class="label-text"> Note </span>
                            </div>
                            <textarea class="textarea textarea-bordered w-full" placeholder="Note"
                                v-model="form.note"></textarea>
                        </label>

                        <button type="submit" class="btn btn-primary mt-4" :disabled="form.processing"
                            :class="!form.isDirty ? 'btn-disabled' : ''">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </dialog>
</template>
