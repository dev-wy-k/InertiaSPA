import './bootstrap'
import Vue from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'

window.Vue = Vue

Vue.mixin({ methods: { route: window.route } })

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin, }) {
        Vue.use(plugin)



        new Vue({
            render: h => h(App, props, Link),
        }).$mount(el)
    },
})