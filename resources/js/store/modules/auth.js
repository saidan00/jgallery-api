import axios from 'axios';
import { setCookie } from '../../helpers';
import { setAuthorization } from '../../helpers/auth';
import { getUser } from '../../helpers/auth';
import { COOKIE_PATH } from '../../assets/config';
import router from '../../router';

const user = getUser();

const state = {
  currentUser: user,
  authError: null
};

const getters = {
  getCurrentUser: state => state.currentUser,
  getAuthError: state => state.authError,
};

const actions = {
  async login({ commit }, credentials) {
    axios.post('/api/auth/login', credentials).then(response => {
      commit('loginSuccess', response);
    })
      .catch(error => {
        commit('loginFailed', error.response.data);
      });
  }
};

const mutations = {
  loginSuccess: (state, payload) => {
    state.authError = null;
    state.currentUser = {...payload};

    setAuthorization(state.currentUser.access_token);
    setCookie('user', JSON.stringify(state.currentUser), state.currentUser.expires_in, COOKIE_PATH);

    router.push({ path: '/albums' });
  },
  loginFailed(state, payload) {
    state.authError = payload.message;
  },
};

export default {
  state,
  getters,
  actions,
  mutations
};
