import Vue from 'vue';
import Vuex from 'vuex';
import albums from './modules/albums';
import loader from './modules/loader';
import login from './modules/auth';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    albums,
    loader,
    login
  }
})
