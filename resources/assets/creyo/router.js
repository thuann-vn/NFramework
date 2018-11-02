import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

//Views
import Welcome from './views/Welcome.vue'
import Products from './views/product/List.vue'
import ProductDetail from './views/product/Detail.vue'

export default new VueRouter({
    mode: 'history',
    base: '/home',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Welcome
        },
        {
            path: '/product',
            name: 'products',
            component: Products
        },
        {
            path: '/product/detail/:id',
            name: 'productDetail',
            component: ProductDetail
        },
    ],
});