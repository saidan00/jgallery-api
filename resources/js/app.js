/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import App from './App.vue'
import router from './router'
// import store from './store'

Vue.config.productionTip = false

new Vue({
  router,
  //   store,
  render: h => h(App)
}).$mount('#app')