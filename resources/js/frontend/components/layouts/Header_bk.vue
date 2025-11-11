<template>
    <header class="site-header">
        <div class="header">
            <div class="header__inner">
                    <div class="header__toggle">
                        <div class="menu-toggle" style="display: flex; align-items: center;">
                            <transition name="slide-fade">
                                <i v-if="showMenuMobile" style="font-size: 29px" class="el-icon-s-unfold" @click="showMenuMobile=!showMenuMobile"></i>
                                <i v-else style="font-size: 29px" class="el-icon-close" @click="showMenuMobile=!showMenuMobile"></i>

                            </transition>

<!--                            <a href="#" rel-script="menu-toggle" @click="showMenuMobile=!showMenuMobile" class="menu-toggle">-->
<!--                                <span></span>-->
<!--                                <span></span>-->
<!--                                <span></span>-->
<!--                            </a>-->
                        </div>
                    </div>
                <div class="header__logo" style="display: flex; align-items: center;">
                    <router-link :to="{name:'home'}">
                        <img :src="$appSetting.LOGO_APP" style="height: 50px;" alt="Logo HaDoVN">
                    </router-link>
                </div>
                <div class="header__menu-mobile" rel-script="header-menu" v-bind:style="{'display':showMenuMobile?'none':'block', 'visibility':showMenuMobile?'unset':'unset','opacity':showMenuMobile?1:1}">
                    <div class="mobile--visible tablet--visible" style="display: none">
                        <div class="header-search-mobile" rel-script="header-search-content">
                            <form action="/collections" method="GET">
                                <div class="header-search__wrapper">
                                    <label class="header-search__field">
                                        <input type="text" name="keyword" rel-script="spotlight-search-control"
                                            placeholder="Tìm kiếm sản phẩm..."
                                            class="header-search__control one-whole" autocomplete="off">
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
                            </form>
                            <div class="spotlight-search">
                                <div class="spotlight-search__wrapper" rel-script="spotlight-search">
                                    <img src="https://www.coolmate.me/images/icons/loading.svg" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="nav-tab">
                            <div class="nav-tab__head">
                                <a href="#san-pham" class="nav-tab__title is-current" rel-script="nav-tab">
                                    Danh mục
                                </a>

                            </div>
                            <div class="nav-tab__content" data-nav-tab="#san-pham">
                                <div class="nav-tab__label"
                                    style="flex-flow: column;align-items: flex-start;padding-bottom: 10px">
                                    <a href="/collections?itm_source=navbar">
                                        <b>Tất cả sản phẩm</b>
                                    </a>
                                </div>
                                <ul class="nav-tab__menu">
                                    <li class="nav__item nav__item--has-child" rel-script="mobile-menu-toggle" v-for="item in data">
                                        <a href="#">
                                            {{item.title}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="header__menu" rel-script="header-menu" style="display: block">
                    <div class="mobile--hidden tablet--hidden">
                        <ul class="nav">
                            <li class="nav__item has-child" rel-script="mega-menu">
                                <a href="/collections?itm_source=navbar" rel-script="mega-menu-open">
                                    Danh mục
                                </a>
                                <div class="mega-menu mega-menu--product">
                                    <a href="#" class="mega-menu__close" rel-script="mega-menu-close">Sản
                                        phẩm</a>
                                    <div class="mega-menu__wrapper">
                                        <div class="mega-menu__inner" style="max-width: 1000px">
                                            <div class="mega-menu__item" rel-script="mega-menu-item"
                                                style="flex: 0 0 33%">
                                                <a href="#" class="mega-menu__title"
                                                    rel-script="mega-menu-toggle">Danh mục</a>
                                                <div class="grid grid--two-columns">
                                                    <div class="grid__column" style="padding-top: 0">
<!--                                                        danh muc-->
                                                        <ul rel-script="mega-menu-active" v-for="item in data">
                                                            <li>
                                                                <a href="/collection/ao-nam1?itm_source=navbar">
                                                                    {{item.title}}
                                                                </a>
                                                            </li>
<!--                                                            <li class="mega-menu_child">-->
<!--                                                                <a-->
<!--                                                                    href="/collection/ao-nam-dai-tay?itm_source=navbar">-->
<!--                                                                    Áo dài tay-->
<!--                                                                </a>-->
<!--                                                            </li>-->
<!--                                                            <li class="mega-menu_child">-->
<!--                                                                <a-->
<!--                                                                    href="/collection/ao-thun-nam?itm_source=navbar">-->
<!--                                                                    Áo T-shirt-->
<!--                                                                </a>-->
<!--                                                            </li>-->
<!--                                                            <li class="mega-menu_child">-->
<!--                                                                <a-->
<!--                                                                    href="/collection/ao-polo-nam?itm_source=navbar">-->
<!--                                                                    Áo Polo-->
<!--                                                                </a>-->
<!--                                                            </li>-->
<!--                                                            <li class="mega-menu_child">-->
<!--                                                                <a-->
<!--                                                                    href="/collection/ao-so-mi-nam?itm_source=navbar">-->
<!--                                                                    Áo Sơ Mi-->
<!--                                                                </a>-->
<!--                                                            </li>-->
<!--                                                            <li class="mega-menu_child">-->
<!--                                                                <a-->
<!--                                                                    href="/collection/ao-the-thao-nam?itm_source=navbar">-->
<!--                                                                    Áo Thể Thao-->
<!--                                                                </a>-->
<!--                                                            </li>-->
<!--                                                            <li class="mega-menu_child">-->
<!--                                                                <a-->
<!--                                                                    href="/collection/ao-khoac?itm_source=navbar">-->
<!--                                                                    Áo khoác-->
<!--                                                                </a>-->
<!--                                                            </li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!--                            -->
                            <li class="nav__item has-child" rel-script="mega-menu">
                                <a href="/84rising?itm_source=navbar">
                                    Quần áo nam
                                </a>
                            </li>
                            <li class="nav__item has-child" rel-script="mega-menu">
                                <a href="/cm24?itm_source=navbar" style="position: relative">
                                    Sản phẩm bán chạy
                                    <span
                                        style="width: 5px;height: 5px;border-radius: 100vmax;background-color: #2F5ACF;position: absolute;top: 0;left: 100%;margin-left: 2px"></span>
                                </a>
                            </li>
                            <li class="nav__item">
                                <a href="/lp/coolxprint-mo-hinh-dat-san-xuat-theo-yeu-cau?itm_source=navbar">
                                    Giới thiệu
                                </a>
                            </li>
                            <li class="nav__item">
                                <a href="/blog?itm_source=navbar">
                                    Blog
                                </a>
                            </li>
                            <li class="nav__item has-child" rel-script="mega-menu">
                                <a href="/page/coolmate-story?itm_source=navbar" rel-script="mega-menu-open">
                                    Liên hệ
                                </a>
                                <div class="mega-menu">
                                    <a href="#" class="mega-menu__close" rel-script="mega-menu-close">Về
                                        Coolmate</a>
                                    <div class="mega-menu__wrapper">
                                        <div class="mega-menu__inner" style="max-width: 1200px;">
                                            <div class="mega-menu__item" rel-script="mega-menu-item">
                                                <a href="#" class="mega-menu__titles"
                                                    rel-script="mega-menu-toggle">Coolmate</a>
                                                <div rel-script="mega-menu-active">
                                                    <div class="grid">
                                                        <a class="grid__column three-twelfths mobile--one-half"
                                                            href="/lp/coolmate-101?itm_source=navbar">
                                                            <div class="mega-menu__thumbnail"
                                                                style="border-radius: 1.5em;overflow: hidden">
                                                                <img src="https://www.coolmate.me/images/placeholder-image.png"
                                                                    data-src="https://mcdn.coolmate.me/image/August2022/mceclip0_97.jpg"
                                                                    alt="Coolmate 101">
                                                            </div>
                                                            <div style="line-height: 1.25em;margin-top: 10px;">
                                                                <span style="font-size: 13px;">Coolmate 101
                                                                </span><br>
                                                                <span
                                                                    style="font-size: 11px;font-weight: 300">Tất
                                                                    cả những gì bạn muốn biết về
                                                                    Coolmate!<br class="mobile--hidden"> và gia
                                                                    nhập Coolmate</span>
                                                            </div>
                                                        </a>
                                                        <a class="grid__column three-twelfths mobile--one-half"
                                                            href="/page/11-dich-vu-tai-coolmate-co-the-ban-chua-biet?itm_source=navbar">
                                                            <div class="mega-menu__thumbnail"
                                                                style="border-radius: 1.5em;overflow: hidden">
                                                                <img src="https://www.coolmate.me/images/placeholder-image.png"
                                                                    data-src="https://mcdn.coolmate.me/image/August2022/mceclip1_92.jpg"
                                                                    alt="Dịch vụ 100% hài lòng">
                                                            </div>
                                                            <div style="line-height: 1.25em;margin-top: 10px;">
                                                                <span style="font-size: 13px;">Dịch vụ 100% hài
                                                                    lòng</span><br>
                                                                <span
                                                                    style="font-size: 11px;font-weight: 300">Bật
                                                                    mí 11 dịch vụ Coolmate cam
                                                                    kết với khách hàng</span>
                                                            </div>
                                                        </a>
                                                        <a class="grid__column three-twelfths mobile--one-half"
                                                            href="/page/coolclub-chuong-trinh-khach-hang-than-thiet-cua-coolmate?itm_source=navbar">
                                                            <div class="mega-menu__thumbnail"
                                                                style="border-radius: 1.5em;overflow: hidden">
                                                                <img src="https://www.coolmate.me/images/placeholder-image.png"
                                                                    data-src="https://mcdn.coolmate.me/image/August2022/mceclip2_100.jpg"
                                                                    alt="Coolclub - Khách hàng thân thiết">
                                                            </div>
                                                            <div style="line-height: 1.25em;margin-top: 10px;">
                                                                <span style="font-size: 13px;">Coolclub - Khách
                                                                    hàng thân thiết</span><br>
                                                                <span
                                                                    style="font-size: 11px;font-weight: 300">Những
                                                                    ưu đãi hấp dẫn dành cho
                                                                    khách hàng thân thiết</span>
                                                            </div>
                                                        </a>
                                                        <a class="grid__column three-twelfths mobile--one-half"
                                                            href="/page/coolmate-story?itm_source=navbar">
                                                            <div class="mega-menu__thumbnail"
                                                                style="border-radius: 1.5em;overflow: hidden">
                                                                <img src="https://www.coolmate.me/images/placeholder-image.png"
                                                                    data-src="https://mcdn.coolmate.me/image/August2022/mceclip3_34.jpg"
                                                                    alt="Câu chuyện">
                                                            </div>
                                                            <div style="line-height: 1.25em;margin-top: 10px;">
                                                                <span style="font-size: 13px;">Câu
                                                                    chuyện</span><br>
                                                                <span
                                                                    style="font-size: 11px;font-weight: 300">Về
                                                                    Startup với mô hình Online
                                                                    D2C</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        </div>
    </header>
</template>
<script>
    import ApiService from "../../../backend/common/api.service";
    import MiniCart from "./MiniCart";
    export default {
        name: 'AppHeader',
        components:{MiniCart},
        data() {
           return {
                showMenuMobile:true,
                data:[]
           }
        },
        mounted(){
          this.getList()
            console.log(this.$store.getters.shoppingCart.cart)
        },
        methods: {
            getList(){
                let _this = this
                ApiService.query('/api/admin/categorys', {params:{type:'treeData'}}).then(({data})=>{
                    _this.data = data['data']
                })
            },
        },

    }
</script>
<style>
.header-actions__menu {
    position: absolute;
    top: 100%;
    right: 0;
    padding-top: 5px;
    opacity: 0;
    pointer-events: none;
    visibility: hidden;
    transition: all .3s;
}
.header-actions__inner {
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 0 10px 0 rgb(0 0 0 / 7%);
    border: 1px solid #d9d9d9;
}
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
