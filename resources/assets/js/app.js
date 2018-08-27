import Vue from 'vue'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('main-nav', require('./components/Nav.vue'));
Vue.component('slider', require('./components/Slider.vue'));
Vue.component('home-products', require('./components/HomeProducts.vue'));
Vue.component('product', require('./components/shop/Product.vue'));
Vue.component('home-categories', require('./components/HomeCategories.vue'));
Vue.component('home-brands', require('./components/HomeBrands.vue'));

//Filters
Vue.filter('image', function (image, size) {
    return '/storage/' + image;
})

Vue.filter('price', function (value) {
    value = value.toString();
    value = value.replace(/[\D\s\._\-]+/g, "");
    value = value ? parseInt(value, 10) : 0;

    return value;
})

const app = new Vue({
    el: '#app'
});