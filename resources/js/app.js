import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Layout from './vue/Shared/Layout.vue'
import DataTable from 'datatables.net-dt'

window.axios = require('axios');
window.axios.defaults.headers.common['X-WP-Nonce'] = '8e0eb63b8f';
window.$ = require('jquery');

InertiaProgress.init()


createInertiaApp({
  resolve: (name) => {
    const page = require(`./vue/Pages/${name}`).default

    // Use global layout for all pages, unless overridden by individual page.
    page.layout ??= Layout

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})