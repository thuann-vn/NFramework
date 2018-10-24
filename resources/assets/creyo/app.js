require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import { APP_CONFIG } from './config.js';

Vue.use(VueRouter)

import Welcome from './views/Welcome.vue'
import App from './views/App.vue'

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Welcome
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});