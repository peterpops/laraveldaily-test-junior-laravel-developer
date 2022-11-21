import './bootstrap';
import '../sass/app.scss';

import AppLayout from '@/Layouts/default.vue'
import HeaderTitle from '@/Layouts/default-headerTitle.vue'

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: name => {
        let page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))

        page.then((module) => {
            // apply default persistant layout
            module.default.layout = module.default.layout || AppLayout;
        });

        return page
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("Link", Link, Head)
            .component("HeaderTitle", HeaderTitle)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
