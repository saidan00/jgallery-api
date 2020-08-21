const state = {
  isLoading: false
};

const getters = {
  getIsLoadding: state => state.isLoading
};

const actions = {
  startLoading({ commit }) {
    commit('setLoading', true);
  },
  doneLoading({ commit }) {
    commit('setLoading', false);
  },
};

const mutations = {
  setLoading: (state, isLoading) => state.isLoading = isLoading
};

export default {
  state,
  getters,
  actions,
  mutations
};