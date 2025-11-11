<template>
    <!-- thêm sidebar-collapse để set mặc định đóng slidebar -->
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <Transition name="slide-fade" >
        <Preloader v-show="showLoad"></Preloader>
            </Transition>
        <Navbar></Navbar>
         <Sidebar></Sidebar>
        <div class="content-wrapper">
            <!--         <Breadcrumb></Breadcrumb>-->
            <section class="content pt-3">
                <div class="container-fluid" style="height:calc(100vh - 140px); overflow-x: auto;">
                    <Transition name="nested" mode="out-in">
                        <router-view></router-view>
                    </Transition>
                </div>
            </section>
        </div>
         <Footer></Footer>
         <ControlSidebar></ControlSidebar>
    </div>
    </body>
</template>

<script>
    import Preloader from "../dashboard/Preloader.vue"
    import ContentHeader from "../dashboard/ContentHeader.vue"
    import Navbar from "../dashboard/Navbar.vue";
    import Sidebar from "../dashboard/Sidebar.vue";
    import Footer from "../dashboard/Footer.vue";
    import ControlSidebar from "../dashboard/ControlSidebar.vue"
    // import Breadcrumb from "../dashboard/Breadcrumb";
    export default {
        name: 'Index',
        components: {
            Preloader,
            ContentHeader,
            Navbar,
            Sidebar,
            Footer,
            ControlSidebar,
            // Breadcrumb
        },
        data(){
            return{
                showLoad:false
            }
        },
        methods: {
            initializeSelect2() {
                //Initialize Select2 Elements
                $(".select2").select2();

                //Initialize Select2 Elements
                $(".select2bs4").select2({
                    theme: "bootstrap4",
                });
            },
            mounted() {
                this.initializeSelect2()
            },
        },
        watch:{
            $route(route) {
               this.showLoad=true
               setTimeout(()=>{
                   this.showLoad = false
               },200)
            }
        }
    }
</script>
<style scoped>
    .slide-fade-enter-active {
        /*transition: all .3s ease;*/
    }
    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* Trước 2.1.8 thì dùng .slide-fade-leave-active */ {
        transform: translateY(-100px);
        opacity: 0;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 2px grey;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: grey;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: grey;
    }

</style>
