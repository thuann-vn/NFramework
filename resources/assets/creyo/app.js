window.Vue = require('vue');
require('./bootstrap');
require('./utils')

//Import module
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

import router from './router'
import store from './store/store';

import VueMce from 'vue-mce';
import VueSelectImage from 'vue-select-image';
import VueFeatherIcon from 'vue-feather-icon';
import axios from 'axios';

// add stylesheet
require('vue-select-image/dist/vue-select-image.css');

//Use
Vue.use(Buefy);
Vue.use(VueMce);
Vue.use(VueSelectImage);
Vue.use(VueFeatherIcon);

//Vue configs
Vue.config.productionTip = false;

//Set base url
axios.defaults.baseURL = store.state.API_URL;

//Components
Vue.component('pagination', require('./components/general/Pagination.vue'));
Vue.component('page-title', require('./components/general/PageTitle.vue'));
Vue.component('image-chooser', require('./components/general/ImageChooser.vue'));


//Init app
const app = new Vue({
    el: '#app',
    components: {
    },
    store,
    router,
});