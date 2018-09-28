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
Vue.component('product', require('./components/shop/Product.vue'));

//Home components
Vue.component('home-products', require('./components/home/HomeProducts.vue'));
Vue.component('home-categories', require('./components/home/HomeCategories.vue'));
Vue.component('home-brands', require('./components/home/HomeBrands.vue'));

//Product detail
Vue.component('related-products', require('./components/product/RelatedProducts.vue'));
Vue.component('similar-products', require('./components/product/SimilarProducts.vue'));

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
    return 0;
})

const app = new Vue({
    el: '#app'
});