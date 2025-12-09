import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import 'primeicons/primeicons.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                    options: {
                        darkModeSelector: false,
                        cssLayer: false,
                    },
                    semantic: {
                        colorScheme: {
                            light: {
                                primary: {
                                    50: '#f0fdfa',
                                    100: '#ccfbf1',
                                    200: '#99f6e4',
                                    300: '#5eead4',
                                    400: '#2dd4bf',
                                    500: '#14b8a6',
                                    600: '#0d9488',
                                    700: '#0f766e',
                                    800: '#115e59',
                                    900: '#134e4a',
                                    950: '#042f2e',
                                },
                                accent: {
                                    50: '#fff7ed',
                                    100: '#ffedd5',
                                    200: '#fed7aa',
                                    300: '#fdba74',
                                    400: '#fb923c',
                                    500: '#f97316',
                                    600: '#ea580c',
                                    700: '#c2410c',
                                    800: '#9a3412',
                                    900: '#7c2d12',
                                    950: '#431407',
                                },
                                gray: {
                                    50: '#fafaf9',
                                    100: '#f5f5f4',
                                    200: '#e7e5e4',
                                    300: '#d6d3d1',
                                    400: '#a8a29e',
                                    500: '#78716c',
                                    600: '#57534e',
                                    700: '#44403c',
                                    800: '#292524',
                                    900: '#1c1917',
                                    950: '#0c0a09',
                                },
                            },
                        },
                    },
                },
            })
            .mount(el);
    },
    progress: {
        color: '#14b8a6',
    },
});
