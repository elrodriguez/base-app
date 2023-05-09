import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import VueGates from 'vue-gates'
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import VueTheMask from 'vue-the-mask'
import Permissions from './Plugins/Permissions';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        let parts = name.split('::');
        if(parts.length > 1){
            return resolvePageComponent(`../../Modules/${parts[0]}/Resources/assets/js/Pages/${parts[1]}.vue`,import.meta.glob('../../Modules/*/Resources/assets/js/Pages/**/*.vue'));
        }else{
            return resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
        }
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueTheMask)
            .use(VueGates)
            .use(Permissions)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
