import axios from 'axios';

const state = {
  currentUser: {}
};

const getters = {
  getCurrentUser: state => state.currentUser
};

const actions = {
  async login({ commit }, user) {
    const response = await axios.post(`/api/auth/login`, user);
    console.log(response);
  }
};

const mutations = {
  setCurrentUser: (state, currentUser) => state.currentUser = currentUser
};

export default {
  state,
  getters,
  actions,
  mutations
};
