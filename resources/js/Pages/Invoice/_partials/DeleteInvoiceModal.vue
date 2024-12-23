<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const props = defineProps({
    invoice: {
        type: Object,
    },
});

function submit() {
    router.delete(route("invoice.destroy", { invoice: props.invoice.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success(page.props.flash.message);
            deleteInvoiceModal.close();
        },
    });
}
</script>
<template>
    <dialog id="deleteInvoiceModal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <form @submit.prevent="submit">
                <div class="flex flex-col">
                    <div role="alert" class="alert alert-warning">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 shrink-0 stroke-current"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                            />
                        </svg>
                        <span>Warning: Invalid email address!</span>
                    </div>
                    <div class="md:flex md:justify-end">
                        <button
                            type="submit"
                            class="btn btn-error mt-4 w-full md:w-auto"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </dialog>
</template>
