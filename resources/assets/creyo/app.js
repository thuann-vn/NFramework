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
Vue.component("chosen-select",{
    props:{
        value: [String, Array],
        multiple: Boolean
    },
    template:`<select :multiple="multiple"><slot></slot></select>`,
    mounted(){
        $(this.$el)
            .val(this.value)
            .chosen()
            .on("change", e => this.$emit('input', $(this.$el).val()))
    },
    watch:{
        value(val){
            $(this.$el).val(val).trigger('chosen:updated');
        }
    },
    destroyed() {
        $(this.$el).Chosen('destroy');
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