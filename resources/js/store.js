import { createStore } from 'vuex';

export default createStore({
  state: {
    user: null,
    token: localStorage.getItem('auth_token') || null,
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setToken(state, token) {
      state.token = token;
    },
    clearUser(state) {
      state.user = null;
      state.token = null;
    }
  },
  actions: {
    logout({ commit }) {
      localStorage.removeItem('auth_token');
      commit('clearUser');
    },
  },
  getters: {
    isAuthenticated(state) {
      return !!state.token;
    },
  }
});
