import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { InertiaProgress } from '@inertiajs/progress';
import '../css/app.css';

createInertiaApp({
    resolve: name => import(`./Pages/${name}.vue`), // Dynamische import
    setup({ el, App, props }) {
        return createApp({ render: () => h(App, props) }).mount(el);
    },
});

InertiaProgress.init();
