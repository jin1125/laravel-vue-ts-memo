import './bootstrap'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import '../css/app.css';
import AppLayout from '@/Layouts/AppLayout.vue';

createInertiaApp({
    resolve: async (name: string) => {
        const page = (await import(`./Pages/${name}.vue`)).default;
        page.layout ??= AppLayout;
        return page;
    },
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init();