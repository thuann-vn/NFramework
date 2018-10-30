import Vue from 'vue'
import Vuex from 'vuex'
import {APP_CONFIG} from './../config';

Vue.use(Vuex);

export default new Vuex.Store({
    state: APP_CONFIG
})