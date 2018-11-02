window.Vue = require('vue');
require('./bootstrap');
require('./utils')

//Import module
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

import router from './router'
import store from './store/store';

import VueMce from 'vue-mce';
import VueFeatherIcon from 'vue-feather-icon';
import axios from 'axios';
import VJstree from 'vue-jstree';
import Treeselect from '@riophae/vue-treeselect';

// import the styles
import '@riophae/vue-treeselect/dist/vue-treeselect.css';

//Use
Vue.use(Buefy);
Vue.use(VueMce);
Vue.use(VueFeatherIcon);

//Vue configs
Vue.config.productionTip = false;

//Set base url
axios.defaults.baseURL = store.state.API_URL;

//Components
Vue.component('pagination', require('./components/general/Pagination.vue'));
Vue.component('page-title', require('./components/general/PageTitle.vue'));
Vue.component('image-chooser', require('./components/general/ImageChooser.vue'));
Vue.component('money-input', require('./components/general/MoneyInput.vue'));
Vue.component("chosen-select",require('./components/general/ChosenSelect.vue'));
Vue.component("categories-chooser",require('./components/general/ProductCategoriesChooser.vue'));
Vue.component("brand-chooser",require('./components/general/ProductBrandChooser.vue'));
Vue.component("multilanguage-input",require('./components/general/MultilanguageInput.vue'));
Vue.component("multilanguage-mce",require('./components/general/MultilanguageMce.vue'));
Vue.component("v-jstree", VJstree);
Vue.component('treeselect', Treeselect);

//Init app
const app = new Vue({
    el: '#app',
    components: {
    },
    store,
    router,
});