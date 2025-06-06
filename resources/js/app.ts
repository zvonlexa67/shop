/// <reference types="vite/client" />

import '../css/robotocondensed.css'
import '../css/app.css'
import "quasar/src/css/index.sass";

import quasarIconSet from 'quasar/icon-set/fontawesome-v6'
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h } from 'vue'
import { ZiggyVue } from 'ziggy-js'

import { Quasar, Cookies, Notify, Dialog } from "quasar"
import quasarLang from 'quasar/lang/ru'

import type { DefineComponent } from 'vue';

import VueApexCharts from 'vue3-apexcharts'
appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueApexCharts)
            .use(Quasar, {
                plugins: {
                    Cookies,
                    Notify,
                    Dialog,
                }, // import Quasar plugins and add here
                iconSet: quasarIconSet,
                lang: quasarLang,
                config: {}, // quasar config see: https://quasar.dev/start/vite-plugin/
            }).mount(el);

    },
    // progress: false,
    progress: {
        color: '#4B5563',
    },
});
