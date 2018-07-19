
require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import storeData from './store';
import mainApp from './components/Main.vue'
import {routes} from './routes';
import {initialize} from './helpers/help';




Vue.use(VueRouter);
Vue.use(Vuex);
const router = new VueRouter({
    routes,
    mode:'history'
})
const store  = new Vuex.Store(storeData);


initialize(store, router);

const app = new Vue({
    el: '#app',
    components: {
        mainApp
    },
    store,
    router

});
