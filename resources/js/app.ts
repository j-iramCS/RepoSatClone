import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, DefineComponent, h } from 'vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

// Notificaciones
import Toast, { PluginOptions } from "vue-toastification";
import "vue-toastification/dist/index.css";

// Componente
import Can from './Components/Can.vue' // Can Para Permissos

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.component('Can', Can) // Usar "Can" Global-Mente
        app
            .use(plugin)
            .use(ZiggyVue)
            .use(Toast)
            .mount(el)
    },
    progress: {
        color: '#4B5563',
    },
})
