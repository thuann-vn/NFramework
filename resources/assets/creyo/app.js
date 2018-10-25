require('./bootstrap');

//Import module
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store/store';

//Use
Vue.use(VueRouter)

//Vue configs
Vue.config.productionTip = false

//Views
import Welcome from './views/Welcome.vue'
import Products from './views/product/List.vue'

//Components
Vue.component('pagination', require('./components/general/Pagination.vue'));

//File pond
// Import Vue FilePond
import vueFilePond from 'vue-filepond';

// Import FilePond styles
import 'filepond/dist/filepond.min.css';

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';


// Create component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

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
            path: '/products',
            name: 'products',
            component: Products
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
    return 0;
})

//Init app
const app = new Vue({
    el: '#app',
    components: {
        FilePond,
    },
    store,
    router,
});