<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div
        class="h-full bg-gradient-to-r from-indigo-200 to-light text-black/50 dark:bg-black dark:text-white/50"
    >
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-primary selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
                >
                    <div class="flex lg:justify-center lg:col-start-2">
                        <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-800"
                        />
                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('invoice.index')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-primary dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Invoice
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-primary dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-primary dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <div
                        class="hero min-h-screen"
                        style="background-image: url('/assets/hero-image.jpg')"
                    >
                        <div class="hero-overlay bg-opacity-60"></div>
                        <div
                            class="hero-content text-neutral-content text-center"
                        >
                            <div class="max-w-md">
                                <h1 class="mb-5 text-5xl font-bold">
                                    Hello there
                                </h1>
                                <p class="mb-5">
                                    Creating an invoice in the "Simple Invoice"
                                    web app is effortless, with a user-friendly
                                    interface ensuring seamless navigation and
                                    efficiency.
                                </p>
                                <a
                                    :href="route('register')"
                                    class="btn btn-primary"
                                    v-if="!$page.props.auth.user"
                                >
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </main>

                <footer
                    class="py-16 text-center text-sm text-black dark:text-white/70"
                >
                    Developed by
                    <a
                        class="link"
                        href="https://www.linkedin.com/in/rounaknikhar/"
                        target="_blank"
                        >rounaknikhar</a
                    >
                </footer>
            </div>
        </div>
    </div>
</template>
