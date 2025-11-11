import Vue from 'vue';
import VueRouter from 'vue-router';
import appConfig from '/config/appConfig'
Vue.use(VueRouter);

export const constantRouterMap = [
    {
        path: '/',
        component: () => import('../components/CheckFile/index'),
        name:'Home',
        meta:{title:'Home'}
    },   
    {
        path: '/login',
        component: () => import('../components/Auth/login'),
        name:'Login',
        meta:{title:'Login'}
    },
    {
        path: '/dashboard',
        component: ()=> import('../components/index'),
        name: 'admin',
        redirect: '/index',
        children: [
        

            //Test
            {
                path: '/Test',
                component: () => import('../components/Test/index'),
                name: 'TestList',
                meta: { title: 'TestList' }
            },
            {
                path: '/Test/create',
                component: () => import('../components/Test/form'),
                name: 'TestCreate',
                meta: { title: 'TestCreate', type: 'Form' }
            },
            {
                path: '/Test/:id?',
                component: () => import('../components/Test/form'),
                name: 'TestUpdate',
                meta: { title: 'TestUpdate', type: 'Form' }
            },,
        

            //QuanLyChiThu
            {
                path: '/QuanLyChiThu',
                component: () => import('../components/QuanLyChiThu/index'),
                name: 'QuanLyChiThuList',
                meta: { title: 'QuanLyChiThuList' }
            },
            {
                path: '/QuanLyChiThu/create',
                component: () => import('../components/QuanLyChiThu/form'),
                name: 'QuanLyChiThuCreate',
                meta: { title: 'QuanLyChiThuCreate', type: 'Form' }
            },
            {
                path: '/QuanLyChiThu/:id?',
                component: () => import('../components/QuanLyChiThu/form'),
                name: 'QuanLyChiThuUpdate',
                meta: { title: 'QuanLyChiThuUpdate', type: 'Form' }
            },,
        

            //QuanLyChiThu
            {
                path: '/QuanLyChiThu',
                component: () => import('../components/QuanLyChiThu/index'),
                name: 'QuanLyChiThuList',
                meta: { title: 'QuanLyChiThuList' }
            },
            {
                path: '/QuanLyChiThu/create',
                component: () => import('../components/QuanLyChiThu/form'),
                name: 'QuanLyChiThuCreate',
                meta: { title: 'QuanLyChiThuCreate', type: 'Form' }
            },
            {
                path: '/QuanLyChiThu/:id?',
                component: () => import('../components/QuanLyChiThu/form'),
                name: 'QuanLyChiThuUpdate',
                meta: { title: 'QuanLyChiThuUpdate', type: 'Form' }
            },,
        

            //QuanLyChiThu
            {
                path: '/QuanLyChiThu',
                component: () => import('../components/QuanLyChiThu/index'),
                name: 'QuanLyChiThuList',
                meta: { title: 'QuanLyChiThuList' }
            },
            {
                path: '/QuanLyChiThu/create',
                component: () => import('../components/QuanLyChiThu/form'),
                name: 'QuanLyChiThuCreate',
                meta: { title: 'QuanLyChiThuCreate', type: 'Form' }
            },
            {
                path: '/QuanLyChiThu/:id?',
                component: () => import('../components/QuanLyChiThu/form'),
                name: 'QuanLyChiThuUpdate',
                meta: { title: 'QuanLyChiThuUpdate', type: 'Form' }
            },,
        

            //QuanLyKhuVuc
            {
                path: '/QuanLyKhuVuc',
                component: () => import('../components/QuanLyKhuVuc/index'),
                name: 'QuanLyKhuVucList',
                meta: { title: 'QuanLyKhuVucList' }
            },
            {
                path: '/QuanLyKhuVuc/create',
                component: () => import('../components/QuanLyKhuVuc/form'),
                name: 'QuanLyKhuVucCreate',
                meta: { title: 'QuanLyKhuVucCreate', type: 'Form' }
            },
            {
                path: '/QuanLyKhuVuc/:id?',
                component: () => import('../components/QuanLyKhuVuc/form'),
                name: 'QuanLyKhuVucUpdate',
                meta: { title: 'QuanLyKhuVucUpdate', type: 'Form' }
            },,          
             //GenCode
             {
                path: '/gen-code',
                component: () => import('../gencode/index.vue'),
                name:'GenCode',
                meta:{title:'GenCode'}
            },      
            //Dashboard
            {
                path: '/index',
                component: () => import('../components/Dashboard/index'),
                name:'Dashboard',
                meta:{title:'Home-Admin'}
            },
            //User
            {
                path: '/list-user',
                component: () => import('../components/User/list'),
                name:'UserList',
                meta:{title:'UserList'}
            },
            {
                path: '/list-user/create',
                component: () => import('../components/User/form'),
                name:'UserCreate',
                meta:{title:'UserCreate',type:'Form'}
            },
            {
                path: '/list-user/:id?',
                component: () => import('../components/User/form'),
                name:'UserUpdate',
                meta:{title:'UserUpdate', type:'Form'}
            },   
           
            //Module
            {
                path: '/list-module',
                component: () => import('../components/Module/list'),
                name:'ModuleList',
                meta:{title:'ModuleList'},
               
            },
            {
                path: '/list-module/create',
                component: () => import('../components/Module/form'),
                name:'ModuleCreate',
                meta:{title:'ModuleCreate',type:'Form'}
            },
            {
                path: '/list-module/:id?',
                component: () => import('../components/Module/form'),
                name:'ModuleUpdate',
                meta:{title:'ModuleUpdate',type:'Form'}
            },
            //Role
            {
                path: '/list-role',
                component: () => import('../components/Role/list'),
                name:'RoleList',
                meta:{title:'RoleList'},
               
            },
            {
                path: '/list-role/create',
                component: () => import('../components/Role/form'),
                name:'RoleCreate',
                meta:{title:'RoleCreate',type:'Form'}
            },
            {
                path: '/list-role/:id?',
                component: () => import('../components/Role/form'),
                name:'RoleUpdate',
                meta:{title:'RoleUpdate',type:'Form'}
            },
            //Action
            {
                path: '/action-module/:id_module?',
                component: () => import('../components/Action/list'),
                name:'ActionList',
                meta:{title:'ActionList'},
               
            },
            //Setting
            {
                path: '/settings',
                component: () => import('../components/Setting/index'),
                name:'Setting',
                meta:{title:'Settings'}
            },
  
            //Thong tin don vi
            {
                path: '/thongtindonvi',
                component: () => import('../components/ThongTinDonVi/list'),  
                name:'ThongTinDonVi',
                meta:{title:'ThongTinDonVi', type:'Form'}
            }, 

             //Danh sách kỳ thi
             {
                path: '/danhsachkythi',
                component: () => import('../components/DanhSachKyThi/list'),  
                name:'DanhSachKyThi',
                meta:{title:'DanhSachKyThi', type:'Form'}
            }, 
             //Danh sách khối thi
             {
                path: '/danhsachkhoithi',
                component: () => import('../components/DanhSachKhoiThi/list'),  
                name:'DanhSachKhoiThi',
                meta:{title:'DanhSachKhoiThi', type:'Form'}
            }, 
             //Danh sách môn thi
             {
                path: '/danhsachmonthi',
                component: () => import('../components/DanhSachMonThi/list'),  
                name:'DanhSachMonThi',
                meta:{title:'DanhSachMonThi', type:'Form'}
            }, 
              //Danh sách phòng thi
              {
                path: '/danhsachphongthi',
                component: () => import('../components/DanhSachPhongThi/list'),  
                name:'DanhSachPhongThi',
                meta:{title:'DanhSachPhongThi', type:'Form'}
            }, 
              //Danh sách thí sinh
            {
                path: '/danhsachthisinh',
                component: () => import('../components/DanhSachThiSinh/list'),  
                name:'DanhSachThiSinh',
                meta:{title:'DanhSachThiSinh', type:'Form'}
            }, 
            {
                path: '/danhsachthisinh/create',
                component: () => import('../components/DanhSachThiSinh/form'),
                name:'DanhSachThiSinhCreate',
                meta:{title:'DanhSachThiSinhCreate',type:'Form'}
            },
            {
                path: '/danhsachthisinh/:maNamHoc/:maKhoiThi',
                component: () => import('../components/DanhSachThiSinh/formUpdate'),
                name:'DanhSachThiSinhUpdate',
                meta:{title:'DanhSachThiSinhUpdate',type:'Form'}
            },
            {
                path: '/danhsachthisinh/:id?',
                component: () => import('../components/DanhSachThiSinh/form'),
                name:'DanhSachThiSinhUpdate',
                meta:{title:'DanhSachThiSinhUpdate', type:'Form'}
            },   
             //Danh sách năm học
             {
                path: '/danhsachnamhoc',
                component: () => import('../components/DanhSachNamHoc/list'),  
                name:'DanhSachNamHoc',
                meta:{title:'DanhSachNamHoc', type:'Form'}
            }, 
            //Danh sách năm học
            {
                path: '/ketquasapphongthi',
                component: () => import('../components/KetQuaSapPhongThi/list'),  
                name:'KetQuaSapPhongThi',
                meta:{title:'KetQuaSapPhongThi', type:'Form'}
            },   
        ]
    },
    {
        path: '/404',
        component: () => import('../../common/404'),
        meta:{
            title:'404-PageNotFound'
        }
    },
   
    {
        path: '/*',
        component: () => import('../view/redirect'),
    }

];

export const asyncRouterMap = [];
const createRouter = () =>
    new VueRouter({
        linkActiveClass: 'active', // active class
        mode: 'history',
        base: '/admin',
        routes: constantRouterMap,
        scrollBehavior: to => {
            if (to.hash) {
                return { selector: to.hash };
            } else {
                return { x: 0, y: 0 };
            }
        },
    });
const router = createRouter();
// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
    const newRouter = createRouter();
    router.matcher = newRouter.matcher; // reset router
}

const DEFAULT_TITLE ='HTSXPT';
router.afterEach((to,from) => {  
    document.title =(DEFAULT_TITLE + ' - ' + to.meta.title )|| DEFAULT_TITLE + ' - '+(to.name);
});
(function() { 
    var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = appConfig.LOGO_META;
    document.getElementsByTagName('head')[0].appendChild(link);
})();


export default router;
