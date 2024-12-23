import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

// Prime vue plugin.
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import Ripple from "primevue/ripple";
import AnimateOnScroll from "primevue/animateonscroll";

// Component registration.
import Button from "primevue/button";

// Autoanimate.
import { autoAnimatePlugin } from "@formkit/auto-animate/vue";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return (
            createApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue)
                // PrimeVue configuration.
                .use(PrimeVue, {
                    theme: {
                        preset: Aura,
                    },
                    options: {
                        prefix: "p",
                        darkModeSelector: ".dark",
                        cssLayer: false,
                    },
                    ripple: true,
                })
                .use(autoAnimatePlugin)
                // Register components.
                .component("Button", Button)

                // Register directives.
                .directive("ripple", Ripple)
                .directive("animateonscroll", AnimateOnScroll)
                .mount(el)
        );
    },
    progress: {
        color: "#10b981",
    },
});
