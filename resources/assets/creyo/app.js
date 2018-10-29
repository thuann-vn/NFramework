require('./bootstrap');

//Import module
import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

import VueRouter from 'vue-router'
import store from './store/store';

import VueMce from 'vue-mce';
import VueSelectImage from 'vue-select-image';

// add stylesheet
require('vue-select-image/dist/vue-select-image.css')

//Use
Vue.use(Buefy);
Vue.use(VueRouter);
Vue.use(VueMce);
Vue.use(VueSelectImage);

//Vue configs
Vue.config.productionTip = false;
//Components
Vue.component('pagination', require('./components/general/Pagination.vue'));
Vue.component('page-title', require('./components/general/PageTitle.vue'));
Vue.component('image-chooser', require('./components/general/ImageChooser.vue'));

//Views
import Welcome from './views/Welcome.vue'
import Products from './views/product/List.vue'
import ProductDetail from './views/product/Detail.vue'

//Routers
const router = new VueRouter({
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
            path: '/product/detail',
            name: 'productDetail',
            component: ProductDetail
        },
    ],
});

//Filters
Vue.filter('image', function (image, size) {
    if(image && size){
        var ext = /^.+\.([^.]+)$/.exec(image);
        ext = ext == null ? "" : ext[1];
        image = image.replace('.'+ext, '').replace(' ','%20');
        return '/storage/' + image + '-' + size + '.' + ext;
    }
    return '/storage/' + image;
})


Vue.filter('price', function (value) {
    if(value){
        value = value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        return value + ' ₫';
    }
    return '0';
})


//Directives
Vue.directive('popover', {
    inserted: function (el) {
        // Focus the element
        $(el)["webuiPopover"]({
            trigger: "hover",
            placement: "top",
            width: 280,
            animation: "pop"
        })
    }
})

Vue.directive('simple-popover', {
    inserted: function (el) {
        // Focus the element
        $(el)["webuiPopover"]({
            trigger: "hover",
            animation: "pop"
        })
    }
})

Vue.directive('feather', {
    inserted: function (el) {
        // Focus the element
        feather["replace"]();
    }
})
//Init app
const app = new Vue({
    el: '#app',
    components: {
    },
    store,
    router,
});