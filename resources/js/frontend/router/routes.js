import Vue from 'vue';
import VueRouter from 'vue-router';
import appSetting from '/config/appSetting'
import appConfig from '/config/appConfig'

Vue.use(VueRouter);
const routes = [
    {
        path: '',
        component: ()=> import('../components/Index'),
        name: 'index',
        // children: [
        //     {
        //         path: '/',
        //         component: ()=> import('../components/content/HomePage'),
        //         name:'home',
        //         meta:{
        //             title:'Trang chủ'
        //         }
        //     },
        //     {
        //         path: 'product-detail/:id?',
        //         component: ()=> import('../components/content/ProductDetail'),
        //         name:'product-detail',
        //         meta:{
        //             title:'Chi tiết sản phẩm'
        //         }
        //     },
        //     {
        //         path: 'shopping-cart',
        //         component: ()=> import('../components/content/ShoppingCart'),
        //         name:'shopping-cart',
        //         meta:{
        //             title:'Giỏ hàng'
        //         }
        //     },
        //     {
        //         path: 'order-success/:order_code?',
        //         component: ()=> import('../components/content/OrderSuccess'),
        //         name:'order-success',
        //         meta:{
        //             title:'Mua hàng thành công'
        //         }
        //     },
        //     {
        //         path: 'payment-order/:order_code?',
        //         component: ()=> import('../components/content/PaymentOrder'),
        //         name:'payment-order',
        //         meta:{
        //             title:'Thông tin thanh toán'
        //         }
        //     },
        //     {
        //         path: 'list-product',
        //         component: ()=> import('../components/content/ListProduct'),
        //         name:'list-product',
        //         meta:{
        //             title:'Danh sách sản phẩm'
        //         }
        //     },
        //     {
        //         path: 'list-blog',
        //         component: ()=> import('../components/content/ListBlog'),
        //         name:'list-blog',
        //         meta:{
        //             title:'Danh sách bài viết'
        //         }
        //     },
        //     {
        //         path: 'blog-detail/:id?',
        //         component: ()=> import('../components/content/BlogDetail'),
        //         name:'blog-detail',
        //         meta:{
        //             title:'Chi tiết bài viết'
        //         }
        //     },
        //     {
        //         path: 'contact',
        //         component: ()=> import('../components/content/Contact'),
        //         name:'contact',
        //         meta:{
        //             title:'Liên hệ'
        //         }
        //     },
        // ]
    },
    {
        path: '/404',
        component: () => import('../../common/404'),
        name: '404-PageNotFound',
        meta:{
            title:'404-PageNotFound'
        }
    },
    {path: '/*', redirect: '/404'}
];

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes,
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
});



// const DEFAULT_TITLE ='HaDoVN';
// router.afterEach((to) => {
//     document.title =(DEFAULT_TITLE + ' - ' + to.meta.title )|| DEFAULT_TITLE + ' - '+(to.name);
// });
// (function() {
//     var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
//     link.type = 'image/x-icon';
//     link.rel = 'shortcut icon';
//     link.href = appConfig.LOGO_META;
//     document.getElementsByTagName('head')[0].appendChild(link);
// })();


export default router;
