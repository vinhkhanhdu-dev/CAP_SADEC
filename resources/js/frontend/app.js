require('../frontend/bootstrap');
import Vue from 'vue';
import App from '../frontend/App.vue';
import '../../css/app.css'
import router from './router/routes';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import appConfig from '/config/appConfig'
import axios from 'axios'
import VueAxios from 'vue-axios'
import store from '../store';

Vue.use(ElementUI);
Vue.use(VueAxios, axios);
window.axios = require('axios');
import moment from 'moment'
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm')
  }
})

Vue.prototype.$appSetting = appConfig
// register global utility filters.
import * as filters from '../filters';
Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});

new Vue({
    el: '#app',
    render: h => h(App),
    store,
    router,
});
