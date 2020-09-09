/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import './icons'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { loadProgressBar } from "axios-progress-bar";
import "axios-progress-bar/dist/nprogress.css";

import { initialize } from "./helpers";

/* sweetalert2 */
const optionsSweetalert2 = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674',
};

Vue.use(VueSweetalert2, optionsSweetalert2);
/* sweetalert2 */

/* axios-progress-bar */
loadProgressBar();
/* axios-progress-bar */

initialize(router);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
