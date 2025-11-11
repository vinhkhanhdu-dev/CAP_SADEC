<template>
    <div class="header-top">
    <header class="site-header " v-bind:class="{'is-scroll-top':hiddenHeader}">
        <div class="header__inner" style="border-bottom: 1px solid rgb(217, 217, 217);">
            <div class="header__toggle">
                <div class="menu-toggle" style="display: flex; align-items: center;">
                    <a href="#" rel-script="menu-toggle" class="menu-toggle" v-bind:class="{'is-active':!showMenuMobile}" @click="showMenuMobile=!showMenuMobile">
                        <span></span> <span></span> <span></span>
                    </a>
                </div>
            </div>
            <div class="header__logo">
                <a href="/">
                    <img :src="$appSetting.LOGO_APP" alt="Logo HADOVN">
                </a>
            </div>

            <div class="header__menu-mobile" v-bind:class="{'is-active':!showMenuMobile}">
                    <div class="header-search-mobile" rel-script="header-search-content">

                            <div class="header-search__wrapper">
                                <label class="header-search__field">
                                    <el-input v-model="keyword"  @keyup.enter.native="navRouter({name:'list-product',query:{keyword:keyword}}), showMenuMobile=true" class="input-search-mobile" type="text" name="keyword" rel-script="spotlight-search-control"
                                           placeholder="Tìm kiếm sản phẩm..."
                                            autocomplete="off"/>
                                </label>
                                <div class="header-search__filter">
                                    <button class="header-search__submit">
                                        <i class="el-icon-search" style="font-size: 15px"></i>
                                    </button>
                                </div>
                                <a href="#" class="header-search__close"
                                   rel-script="spotlight-search-close">
                                </a>
                            </div>

                        <div class="spotlight-search">
                            <div class="spotlight-search__wrapper" rel-script="spotlight-search">
                                <img src="https://www.coolmate.me/images/icons/loading.svg" class="loading">
                            </div>
                        </div>
                    </div>
                    <div class="nav-tab">
                        <div class="nav-tab__label"
                                 style="flex-flow: column;align-items: flex-start;padding-bottom: 10px">
                                <a @click="navRouter({name:'list-product'})">
                                    <b>Tất cả sản phẩm</b>
                                </a>
                            </div>
                        <div class="nav-tab__head">
                            <a href="#san-pham" class="nav-tab__title" rel-script="nav-tab">
                                Danh mục
                            </a>

                        </div>
                        <div class="nav-tab__content" data-nav-tab="#san-pham">

                            <el-tree
                                ref="tree"
                                empty-text="Không tìm thấy !"
                                v-if="$store.state.category.categorys.length"
                                :data="$store.state.category.categorys"
                                :show-checkbox="false"
                                node-key=id
                                :expand-on-click-node="false">
                                <span @click="navRouter({name:'list-product',query:{category:data.id}}), showMenuMobile=true" class="custom-tree-node" slot-scope="{ node, data }">
                                <span style="font-size: 14px; padding-top: 5px">{{ data.title }}</span>
                                </span>
                            </el-tree>

                            <div class="nav-tab__label"
                                 style="flex-flow: column;align-items: flex-start;padding-bottom: 10px; padding-top: 10px;">
                                <a @click="navRouter({name:'contact'})">
                                    <b>Về chúng tôi</b>
                                </a>
                            </div>
                            <div class="nav-tab__label"
                                 style="flex-flow: column;align-items: flex-start;padding-bottom: 10px">
                                <a @click="navRouter({name:'list-blog'})">
                                    <b>Blog</b>
                                </a>
                            </div>
                            <div class="nav-tab__label"
                                 style="flex-flow: column;align-items: flex-start;padding-bottom: 10px">
                                <a @click="navRouter({name:'contact'})">
                                    <b>Liên hệ</b>
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="header__menu mobile--hidden tablet--hidden">
                <div>
                    <ul class="nav">
                        <li class="nav__item has-child" @click="item.route&& navRouter(item.route)" v-for="item in menuItem" @mouseleave="menuSubActive=''"   @mouseover="menuActive=item.value; menuSubActive=''">
                            <a  rel-script="sub-menu">
                                {{item.title}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header__actions">
                <div class="header-actions__button">
                    <el-popover
                        placement="bottom-end"
                        trigger="hover"
                        width="430"
                    >
                        <mini-cart/>
                        <el-badge slot="reference" :value="$store.getters.shoppingCart.cart.length" class="item">
                            <i class="el-icon-sell" style="font-size: 25px"></i>
                        </el-badge>
                    </el-popover>

                </div>

            </div>
        </div>
        <div class="sub-header__menu mobile--hidden tablet--hidden" style="border-bottom: 1px solid rgb(217, 217, 217);">
            <div>
                <ul class="nav" v-show="menuActive==1">
                    <li @mouseover="menuSubActive=itemCatelogry.id" v-for="itemCatelogry in $store.state.category.categorys" class="nav__item has-child">
                        <a @click="navRouter({name:'list-product',query:{category:itemCatelogry.id}})">{{itemCatelogry.title}} </a>
                    </li>
                </ul>
                <ul class="nav"  v-show="menuActive==2">
                    <li rel-script="sub-menu" data-menu-id="84rising" class="nav__item"><a href="/84rising?itm_source=navbar">
                        84RISING
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="cm24" class="nav__item"><a href="/cm24?itm_source=navbar" class="-item" style="position: relative;">
                        CM24
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="cxp" class="nav__item"><a href="/lp/coolxprint-mo-hinh-dat-san-xuat-theo-yeu-cau?itm_source=navbar">
                        COOLXPRINT
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="about" class="nav__item"><a href="/page/coolmate-story?itm_source=navbar">
                        VỀ COOLMATE
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="blog" class="nav__item"><a href="/blog?itm_source=navbar">
                        BLOG
                    </a></li>
                </ul>
            </div>
        </div>
        <!--     VỀ CHÚNG TÔI   -->
        <div class="mega-menu mega-menu--product" v-bind:class="{'active':menuActive==3}">
            <div class="mega-menu__wrapper">
                <div class="mega-menu__inner" style="max-width: 1200px;">
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="flex: 0 0 18%;"></div>
                    <div rel-script="mega-menu-item" class="mega-menu__item">
                        <ul rel-script="mega-menu-active">
                            <li>
                                <a href="/collection/coolmate-activewear?itm_source=navbar">
                                    Về chúng tôi
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="display: flex; flex: 0 0 55%; gap: 30px;">
                        <div style="max-width: 240px;"><a href="/collection/care-and-share?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip3_96.jpg" alt="">
                                <div class="content">
                                    Care &amp; Share <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                        <div style="max-width: 240px;"><a href="/collection/san-pham-moi-ben-vung?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip0_2.jpg" alt="">
                                <div class="content">
                                    Sản phẩm bền vững <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                    </div>
                </div>
            </div>
            <div class="close-menu" @mouseover="menuSubActive=''; menuActive=1"></div>
        </div>
        <!--     THÔNG TIN LIÊN HỆ   -->
        <div class="mega-menu mega-menu--product" v-bind:class="{'active':menuActive==4}">
            <div class="mega-menu__wrapper">
                <div class="mega-menu__inner" style="max-width: 1200px;">
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="flex: 0 0 18%;"></div>
                    <div rel-script="mega-menu-item" class="mega-menu__item">
                        <ul rel-script="mega-menu-active">
                            <li>
                                <a href="/collection/coolmate-activewear?itm_source=navbar">
                                    Thông tin liên hệ
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="display: flex; flex: 0 0 55%; gap: 30px;">
                        <div style="max-width: 240px;"><a href="/collection/care-and-share?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip3_96.jpg" alt="">
                                <div class="content">
                                    Care &amp; Share <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                        <div style="max-width: 240px;"><a href="/collection/san-pham-moi-ben-vung?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip0_2.jpg" alt="">
                                <div class="content">
                                    Sản phẩm bền vững <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                    </div>
                </div>
            </div>
            <div class="close-menu" @mouseover="menuSubActive=''; menuActive=1"></div>
        </div>
        <div class="mega-menu mega-menu--product" v-for="itemCatelogry in $store.state.category.categorys" v-bind:class="{'active':menuSubActive==(itemCatelogry.id) }">
            <div class="mega-menu__wrapper" v-if="itemCatelogry['children'].length">
                <div class="mega-menu__inner" style="max-width: 1200px;">
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="flex: 0 0 18%;"></div>
                    <div rel-script="mega-menu-item" class="mega-menu__item">
                        <ul rel-script="mega-menu-active">
<!--                            <li v-for="itemSubCate in itemCatelogry['children']"><a href="/collection/coolmate-activewear?itm_source=navbar">-->
<!--                                {{itemSubCate.title}}-->
<!--                            </a></li>-->
                            <el-tree
                                style="height: 40px"
                                ref="treeChilde"
                                empty-text="Không tìm thấy !"
                                v-show="itemCatelogry['children']"
                                :data="itemCatelogry['children']"
                                :show-checkbox="false"
                                node-key=id
                                :expand-on-click-node="false">
                             <span @click="navRouter({name:'list-product',query:{category:data.id}})" class="custom-tree-node"
                                   style="line-height: 40px" slot-scope="{ node, data }">
                              <span style="font-size: 16px; padding-top: 5px; padding-bottom: 10px">{{ data.title }}</span>
                            </span>
                            </el-tree>

                        </ul>


                    </div>
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="display: flex; flex: 0 0 55%; gap: 30px;">
                        <div v-for="(img, i) in itemCatelogry['children']" style="max-width: 240px;">
                            <a>
                                <div class="mega-menu__item-image" v-if="i<2">
                                    <img loading="lazy" :src="img.img" alt="">
    <!--                                <div class="content">-->
    <!--                                    Care &amp; Share <span><img :src="img.img"></span>-->
    <!--                                </div>-->
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="close-menu" @mouseover="menuSubActive=''; menuActive=1"></div>
        </div>
    </header>
    </div>

</template>
<script>
    import {mapState, mapGetters} from 'vuex'
    import ApiService from "../../../backend/common/api.service";
    import MiniCart from "./MiniCart";
    export default {
        components:{MiniCart},
        data(){
            return{
                keyword:'',
                menuItem:[
                    {title:'TRANG CHỦ', value:1, route:{name:'home'}},
                    {title:'DANH MỤC', value:1},
                    {title:'SẢN PHẨM MỚI', value:1, route:{name:'list-product'}},
                    {title:'VỀ CHÚNG TÔI', value:1, route:{name:'contact'}},
                    {title:'LIÊN HỆ', value:1,route:{name:'contact'}},
                    {title:'BLOG', value:1, route:{name:'list-blog'}},
                ],
                menuActive:1,
                menuSubActive:'',
                hiddenHeader:false,
                showMenuMobile:true,
                // data:[]
            }

        },
        mounted() {
            // this.getList()
            window.addEventListener("scroll", this.handleScroll, { passive: true });

        },
        methods:{
            handleScroll(){
                this.hiddenHeader = window.scrollY > 100
                window.scrollY > 100 && (this.showMenuMobile=true)
            },
            navRouter(route){
                this.$router.push(route).catch(err => {
                    // Ignore the vuex err regarding  navigating to the page they are already on.
                    if (
                        err.name !== 'NavigationDuplicated' &&
                        !err.message.includes('Avoided redundant navigation to current location')
                    ) {
                        // But print any other errors to the console
                        logError(err);
                    }
                });
                this.showMenuMobile=true
            },

            getList(){
                let _this = this
                // ApiService.query('/api/admin/categorys', {params:{type:'treeData'}}).then(({data})=>{
                //     _this.data = data['data']
                // })
                // !this.categorys && this.$store.dispatch("category/setCategorys").then((data)=>{
                //     _this.data = data
                // })
            },

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
<style>
    .active{
        visibility: visible !important;
        opacity: 1 !important;
        top: unset !important;
        height: 100% !important;
    }
    .close-menu{
        pointer-events: visible;
        width: 100%;
        height: 100%;
    }
    .custom-tree-node:hover{
         color:#2F5ACF;
    }
    .el-tree-node__content:hover, .el-upload-list__item:hover {
        background-color: transparent;
    }
    .el-tree-node__content:active, .el-upload-list__item:active {
        background-color: transparent;
    }
    .input-search-mobile .el-input__inner{
        border-radius: 50px !important;
        height: 30px;
        padding-left: 30px;
    }
</style>
