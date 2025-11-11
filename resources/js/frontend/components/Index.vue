<template>
    <div class="content-app">
        <div v-if="$store.getters.settingApp.setting.DEBUG_APP">
            <div class="container"
                 style="display: flex; align-items: center; flex-direction: column; height: 100vh; justify-content: center">
                <div style=" display: flex; flex-direction: column; text-align:center;justify-content: center; align-items: center">
                    <img width="400" src="/img/maintain.gif">
                    <span style="font-weight: bold; font-size: 20px; color: #239a1a;">  Hệ thống đang được bảo trì
                        <br/> Vui lòng quay lại sau</span>
                </div>
            </div>
        </div>
        <div v-else>
            <app-header></app-header>
            <main class="site-homepage">
                <transition name="slide-fade">
                    <router-view></router-view>
                </transition>
            </main>
            <ScrollTop>
                <a class="btn btn-light" style="left: 10px;
                    bottom: 25px;
                    width: 45px;
                    height: 45px;
                    border-radius: 50%;
                    background: #2f5acf;
                    color: #fff;
                    border: none;
                    outline: none;
                    z-index: 8;
                    padding: 10px;">
                    <i class="el-icon-arrow-up" style="font-size: 15px; font-weight: bold"/>
                </a>
            </ScrollTop>
            <app-footer></app-footer>
        </div>

    </div>
</template>

<script>
import AppHeader from './layouts/Header';
import AppFooter from './layouts/Footer';
import ApiService from "../../backend/common/api.service";
import Vue from 'vue';
import appConfig from "../../../../public/config/appConfig.json";
import {mapState, mapGetters} from 'vuex'
import ScrollTop from "./layouts/ScrollTop";
export default {
    name: 'Index',
    components: {
        AppHeader,
        AppFooter,
        ScrollTop
    },
    data(){
        return {
            listCategory:[]
        }
    },
    beforeCreate(){
        ApiService.query('/api/admin/setting/fetchSetting').then(({data})=>{
            this.$store.dispatch("settingApp/setSetingApp", data['data']);
        })
        !this.categorys && this.$store.dispatch("category/setCategorys").then((data)=>{
            this.listCategory = data
        });
    },
    mounted() {

    },
    computed:{
        ...mapState([
            "settingApp","categorys"
        ]),
        ...mapGetters([
            "settingApp","categorys"
        ]),
    }
}
</script>
<style scoped>
 @import '../../../css/home.css';
@media screen and (max-width: 1200px) {
    .site-homepage{
        padding-top: 50px
    }
}
@media screen and (min-width: 1200px) {
    .site-homepage{
        padding-top: 100px
    }
}

</style>
