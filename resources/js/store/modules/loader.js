const state = {
  isLoading: false
};

const getters = {
  getIsLoadding: state => state.isLoading
};

const actions = {
  startLoading({ commit }) {
    commit('setLoading', true);
    console.log("startLoading");
  },
  doneLoading({ commit }) {
    commit('setLoading', false);
    console.log("doneLoading");
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