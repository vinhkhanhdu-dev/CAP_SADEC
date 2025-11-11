require('bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import '../../css/app.css'
import router from './router/routes';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

import 'admin-lte/dist/js/adminlte.min.js'
import "admin-lte/plugins/select2/js/select2.full.min.js"
import "admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"
import "admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"
//import "admin-lte/plugins/summernote/summernote-bs4.min.js"
//import "admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"
import "admin-lte/plugins/daterangepicker/daterangepicker.js"
//mport "admin-lte/plugins/moment/moment.min.js"
import "admin-lte/plugins/jquery-knob/jquery.knob.min.js"
//import "admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js"
//import "admin-lte/plugins/jqvmap/jquery.vmap.min.js"
import "admin-lte/plugins/sparklines/sparkline.js"
//import "admin-lte/plugins/chart.js/Chart.min.js"
import "admin-lte/plugins/jquery/jquery.min.js"
import "admin-lte/plugins/jquery-ui/jquery-ui.min.js"
import "admin-lte/plugins/inputmask/jquery.inputmask.min.js"
//import "admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"
import "admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
import "admin-lte/plugins/bs-stepper/js/bs-stepper.min.js"
import "admin-lte/plugins/dropzone/min/dropzone.min.js"


//import admin-lte styles
import 'admin-lte/dist/css/adminlte.min.css'
import "admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
import "admin-lte/plugins/summernote/summernote-bs4.min.css"
import "admin-lte/plugins/daterangepicker/daterangepicker.css"
import "admin-lte/plugins/jqvmap/jqvmap.min.css"
import "admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css"
import "admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
import "admin-lte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css"
import "admin-lte/plugins/bs-stepper/css/bs-stepper.min.css"
import "admin-lte/plugins/dropzone/min/dropzone.min.css"
import 'admin-lte/plugins/fontawesome-free/css/all.min.css'

import axios from 'axios'
import VueAxios from 'vue-axios'

import lang from 'element-ui/lib/locale/lang/vi'
import locale from 'element-ui/lib/locale'
import store from '../store';
import './middleware';
import '../utils/logging';
import appConfig from '/config/appConfig'
Vue.prototype.$appSetting = appConfig
// configure language
locale.use(lang)
Vue.use(VueAxios, axios);
window.axios = require('axios');

Vue.use(VueRouter);
Vue.use(ElementUI,{ size: 'small', zIndex: 3000 });
// window.axios = require('axios');
import moment from 'moment'
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm')
  }
})

// register global utility filters.
import * as filters from '../filters';
Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});



new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App),
});
