import Vue from "vue";
import axios from 'axios'
import VueAxios from 'vue-axios'
// import { API_URL } from "./config";
// import AuthService from '@/common/auth.service';
// import store from "@/store";
import $ from 'jquery';


// $(document).ajaxError(function( event, jqxhr, settings, thrownError ) {
//     switch (jqxhr.status) {
//         case 401:
//             ApiService.sessionExpire();
//             break;
//     }
// });

const ApiService = {
    init() {
        Vue.use(VueAxios, axios);
        Vue.axios.defaults.baseURL = 'http://127.0.0.1:9999/';
    },

    setHeader() {
        const token = AuthService.getToken();
        if (token) {
            Vue.axios.defaults.headers.common[
                "Authorization"
                ] = `Bearer ${token}`;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': `Bearer ${token}`
            }
        });
    },

    // sessionExpire() {
    //     if (!['/auth/login','/auth/logout','/'].includes(window.location.pathname) && store.getters.isAuthenticated) {
    //         Swal.fire('Thông báo', 'Trạng thái đăng nhập đã hết hạn vui lòng đăng nhập lại!', 'warning').then(res => {
    //             return void (window.location.href = '/auth/login');
    //         });
    //     }
    // },

    query(resource, params) {
        return Vue.axios.get(resource, params).catch(error => {
            if (error && error.response && error.response.status === 401) {
                ApiService.sessionExpire();
            }
            throw new Error(`[RWV] ApiService ${error}`);
        });
    },

    get(resource, slug = "") {
        return Vue.axios.get(`${resource}/${slug}`).catch(error => {
            if (error && error.response && error.response.status === 401) {
                ApiService.sessionExpire();
            }
            throw new Error(`[RWV] ApiService ${error}`);
        });
    },

    post(resource, params) {
        return Vue.axios.post(`${resource}`, params).catch(error => {
            if (error && error.response && error.response.status === 401) {
                ApiService.sessionExpire();
            }
            throw new Error(`[RWV] ApiService ${error}`);
        });
    },

    update(resource, slug, params) {
        return Vue.axios.put(`${resource}/${slug}`, params).catch(error => {
            if (error && error.response && error.response.status === 401) {
                ApiService.sessionExpire();
            }
            throw new Error(`[RWV] ApiService ${error}`);
        });
    },

    put(resource, params) {
        return Vue.axios.put(`${resource}`, params).catch(error => {
            if (error && error.response && error.response.status === 401) {
                ApiService.sessionExpire();
            }
            throw new Error(`[RWV] ApiService ${error}`);
        });
    },

    delete(resource) {
        return Vue.axios.delete(resource).catch(error => {
            if (error && error.response && error.response.status === 401) {
                ApiService.sessionExpire();
            }
            throw new Error(`[RWV] ApiService ${error}`);
        });
    }
};

export default ApiService;

// export const checkAuth = {
//     getUser() {
//         $.ajax({
//             url: '/api/admin/auth/session',
//             dataType: 'json',
//             type: 'GET',
//             complete: function(xhr, textStatus) {
//                 switch (xhr.status) {
//                     case 401:
//                         window.location.href = "/auth/login"
//                         break;
//                 }
//             }
//         })
//         return true

//     }
// }

// export const RemoteSensingDataService = {
//     fetch(params) {
//         return ApiService.query("/api/remote-sensing-data", { params: params });
//     },
//     fetchDetail(params) {
//         return ApiService.post("dashboard/remote_sensing_data/getDataAnalysis", params);
//     },
//     create(params) {
//         return ApiService.post("dashboard/remote_sensing_data/create", params);
//     },
//     update(slug, params) {
//         return ApiService.post(`dashboard/remote_sensing_data/info/${slug}`, params);
//     },
//     delete(params) {
//         return ApiService.post("dashboard/remote_sensing_data/delete", params);
//     },
//     get(params) {
//         return ApiService.query("dashboard/index", params);
//     },
//     createInfo(params) {
//         return ApiService.post("dashboard/remote_sensing_data/info/", params);
//     },
//     createAnalysisData(params) {
//         return ApiService.post("analysis_data/create", params);
//     },
//     updateAnalysisData(params) {
//         return ApiService.post("analysis_data/info", params);
//     },
//     deleteAnalysisData(_id) {
//         return ApiService.post("analysis_data/delete/", { _id: _id });
//     }
// };
