import {
    SETTING_APP
} from '../muation-types';

const state = {
  setting: {},
};

const mutations = {
  setSetingApp(state, setting) {
    state.setting = setting;
  },

};

const actions = {
  setSetingApp({ commit }, payload) {
      commit("setSetingApp", payload);
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
