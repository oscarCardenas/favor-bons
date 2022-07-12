import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionSection from '@/Jetstream/ActionSection.vue';
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetConfirmsPassword from '@/Jetstream/ConfirmsPassword.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('Link', Link)
            .component('Head', Head)
            .component('JetApplicationMark', JetApplicationMark)
            .component('JetBanner', JetBanner)
            .component('JetDropdown', JetDropdown)
            .component('JetDropdownLink', JetDropdownLink)
            .component('JetNavLink', JetNavLink)
            .component('JetResponsiveNavLink', JetResponsiveNavLink)
            .component('JetActionMessage', JetActionMessage)
            .component('JetButton', JetButton)
            .component('JetFormSection', JetFormSection)
            .component('JetInput', JetInput)
            .component('JetInputError', JetInputError)
            .component('JetLabel', JetLabel)
            .component('JetActionSection', JetActionSection)
            .component('JetDialogModal', JetDialogModal)
            .component('JetDangerButton', JetDangerButton)
            .component('JetSecondaryButton', JetSecondaryButton)
            .component('JetConfirmsPassword', JetConfirmsPassword)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
