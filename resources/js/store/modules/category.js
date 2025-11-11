import {
    CATEGORY_LIST
} from '../muation-types';
import {getCategory} from '../../api/admin/category'  
const state = {
  categorys: {},
  flattenData: {}
};

const mutations = {
  setCategorys(state, categorys) {   
    state.categorys = categorys;    
  },
  setCategorysFlatten(state, categorys) {   
    state.flattenData = categorys;    
  },

};

const actions = {
  setCategorys({ commit }) {   
    return new Promise((resolve, reject) => {
      getCategory({
        type:'treeData',
      })
        .then(({data}) => {
          if(data['success']){
              commit("setCategorys", data['data']);
              resolve(data['data']);
          }         
        })
        .catch(err => {
          reject(err);
        });
      getCategory({
        type:'data'
      })
        .then(({data}) => {
          if(data['success']){
              commit("setCategorysFlatten", data['data']);
              resolve(data['data']);
          }         
        })
        .catch(err => {
          reject(err);
        });
    }); 
    
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
