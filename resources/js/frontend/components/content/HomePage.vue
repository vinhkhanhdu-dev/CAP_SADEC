<template>
    <div>
        <HomePageBannerVue/>
        <HomePageSearch/>
        <HomePageProduct/>
<!--        <div class="container container&#45;&#45;full mgt&#45;&#45;20">-->
<!--            <div class="home-collection__banner"><a href="/cm24?itm_source=homepage-section">-->
<!--                <picture style="width: 100%;">-->
<!--                    <source media="(max-width:768px)"-->
<!--                            srcset="https://mcdn.coolmate.me/image/February2023/mceclip1_28.jpg">-->
<!--                    <img-->
<!--                        src="https://mcdn.coolmate.me/image/February2023/mceclip0_88.jpg" alt="Image"-->
<!--                        width="100%" style="">-->
<!--                </picture>-->
<!--            </a></div>-->
<!--        </div>-->
<!--        <section class="homepage-excool">-->
<!--            <div class="container">-->
<!--                <div class="about-card">-->
<!--                    <div class="about-card__content">-->
<!--                        <h2 class="about-card__heading">-->
<!--                            Dòng sản phẩm công nghệ EXCOOL-->
<!--                        </h2>-->
<!--                        <div class="about-card__description">-->
<!--                            <p>-->
<!--                                Công nghệ Việt cho người Việt.<br>-->
<!--                                Với hơn <b>100.000</b> sản phẩm đã được gửi đến tay khách hàng sử dụng và hài-->
<!--                                lòng-->
<!--                            </p>-->
<!--                        </div>-->
<!--                        <div class="about-card__button"><a href="/lp/dong-san-pham-excool?itm_source=home"-->
<!--                                                           class="btn btn&#45;&#45;white">-->
<!--                            Tìm hiểu thêm-->
<!--                        </a></div>-->
<!--                    </div>-->
<!--                    <div class="about-card__image">-->
<!--                        <picture>-->
<!--                            <source media="(min-width:768px)"-->
<!--                                    srcset="https://mcdn.coolmate.me/uploads/January2022/ao_(1)_1_(1)_(1).jpg">-->
<!--                            <img-->
<!--                                src="https://mcdn.coolmate.me/uploads/February2022/ao_1_(1).jpg" alt="Image"-->
<!--                                style="">-->
<!--                        </picture>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
<!--        <section class="homepage-coolclub animations-active">-->
<!--            <div class="container container&#45;&#45;medium">-->
<!--                <div class="coolclub-abouts">-->
<!--                    <h2 class="coolclub-abouts__heading">-->
<!--                        Coolmate Basics-->
<!--                    </h2>-->
<!--                    <div class="coolclub-abouts__wrapper">-->
<!--                        <div class="coolclub-abouts__content">-->
<!--                            <div class="coolclub-abouts__box"><a-->
<!--                                href="/product/ao-thun-nam-cotton-coolmate-basics-200gsm?color=mau-den&amp;itm_source=home_basics"><img-->
<!--                                src="https://mcdn.coolmate.me/image/January2023/mceclip9_22.png"-->
<!--                                alt="Coolmate Basics 1" style=""></a></div>-->
<!--                            <div class="coolclub-abouts__box"><a-->
<!--                                href="/product/ao-ba-lo-cotton-100-coolmate-basics-v2?color=trang&amp;itm_source=home_basics"><img-->
<!--                                src="https://mcdn.coolmate.me/image/September2022/mceclip1_11.png"-->
<!--                                alt="Coolmate Basics 2" style=""></a></div>-->
<!--                            <div class="coolclub-abouts__box"><a-->
<!--                                href="/product/ao-the-thao-nam-promax-recycle-basics1?itm_source=home_basics"><img-->
<!--                                src="https://mcdn.coolmate.me/uploads/January2022/CoolmateBasic3.png"-->
<!--                                alt="Coolmate Basics 3" style=""></a></div>-->
<!--                            <div class="coolclub-abouts__box"><a-->
<!--                                href="/product/quan-short-mac-nha-coolmate-basics?itm_source=home_basics"><img-->
<!--                                src="https://mcdn.coolmate.me/uploads/February2022/Mask_Group_(2).png"-->
<!--                                alt="Coolmate Basics 4" style=""></a></div>-->
<!--                            <div class="coolclub-abouts__box coolclub-abouts__box&#45;&#45;last"><a-->
<!--                                href="/product/quan-lot-nam-brief-coolmate-basics?itm_source=home_basics&amp;color=xanh-navy"><img-->
<!--                                src="https://mcdn.coolmate.me/uploads/January2022/CoolmateBasic4.png"-->
<!--                                alt="Coolmate Basics 5" style=""></a></div>-->
<!--                        </div>-->
<!--                        <a href="#" rel-script="coolclub-abouts-scroll"-->
<!--                           class="coolclub-abouts__scroll"><img-->
<!--                            src="https://www.coolmate.me/images/arrow-right.svg" alt="Arrow rigth"></a>-->
<!--                    </div>-->
<!--                    <p class="text&#45;&#45;center" style="letter-spacing: 0.03em;">Dòng sản phẩm mặc cơ bản <span-->
<!--                        style="color: rgb(47, 90, 207);">chất lượng tốt</span> và <span-->
<!--                        style="color: rgb(47, 90, 207);">giá tốt</span>-->
<!--                        của Coolmate</p>-->
<!--                    <div class="coolclub-abouts__button"><a href="/collection/coolmate-basics?itm_source=home"-->
<!--                                                            class="btn btn&#45;&#45;primary">-->
<!--                        Trải nghiệm-->
<!--                    </a></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
        <section class="homepage-collections">
            <div class="container container--full">
                <el-divider content-position="left">DANH MỤC SẢN PHẨM</el-divider>
                <div class="grid">
                    <div v-for="(item,i) in $store.state.category.categorys" v-show="i<4" class="grid__column three-twelfths mobile--one-half"><a
                        @click="navRouter({name:'list-product',query:{category:i<3?item.id:''}})"
                        class="collection-grid">
                        <div class="collection-grid__thumbnail"><img
                            :src="item.img"
                            alt="Đồ mặc trong" style=""></div>
                        <span class="collection-grid__title">
                                    <span v-if="i<3">{{ item.title }}</span>
                                    <span v-if="i==3">Tất cả</span>
                            </span>
                    </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="homepage-about">
            <div class="container">
                <div class="about-card">
                    <div class="about-card__image" style="position: relative; z-index: 1;">
                        <picture>
                            <source media="(max-width:768px)"
                                    srcset="/img/Banner/partner.jpg">
                            <img
                                src="/img/Banner/partner.jpg"
                                alt="Dịch vụ xuất sắc" style="">
                        </picture>
                    </div>
                    <div class="about-card__content">
                        <h2 class="about-card__heading">
                            Trải nghiệm mua sắm hài lòng với
                            #Hadovn
                        </h2>
                        <div class="about-card__description">
                            <p>
                                Giá cả hợp lý<br>
                                Dịch vụ 100% hài lòng<br>
                                60 ngày đổi trả<br>
                                Tự hào sản xuất tại Việt Nam
                            </p>
                        </div>
                        <div class="about-card__button">
                            <a class="btn btn--white">
                                 Tìm hiểu thêm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="homepage-more">
            <div class="container">
                <div class="homepage-more__captions">
                    <marquee>
                        <p><b>HaDoVN</b> - Ưu đãi <b>nhiều hơn</b>, mua sắm vui hơn. Nhận ngay <b>ưu đãi
                            7%</b> cho
                            lần mua sắm tiếp theo</p>
                    </marquee>
                    <a
                        class="homepage-more__button">
                        Gia nhập ngay
                    </a>
                </div>
                <div class="grid">
                    <div class="grid__column one-half mobile--one-whole" style="position: relative;">
                        <div class="infomation-card">
                            <div class="infomation-card__thumbnail">
                                <a><img
                                src="/img/Banner/cauchuyen.jpg"
                                alt="Dịch vụ xuất sắc" style=""></a></div>
                        </div>
                    </div>
                    <div class="grid__column one-half mobile--one-whole">
                        <div class="infomation-card">
                            <div class="infomation-card__thumbnail"><a><img
                                src="/img/Banner/hailong100.jpg"
                                alt="Dịch vụ xuất sắc" style=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import HomePageBannerVue from './HomePageBanner.vue';
import HomePageProduct from './HomePageProduct.vue';
import HomePageSearch from "./HomePageSearch";
import ApiService from "../../../backend/common/api.service";
import {mapState, mapGetters} from 'vuex'

export default {
    name: 'HomePage',
    components: {
        HomePageBannerVue, HomePageProduct, HomePageSearch
    },
    data() {
        return {
            data: ''
        }
    },
    props:{

    },
    watch:{
    },
    mounted() {
        // this.getList()
    },
    methods: {
        getList() {
            // let _this = this
            // ApiService.query('/api/admin/categorys', {params: {type: 'treeData'}}).then(({data}) => {
            //     _this.data = data['data']
            // })
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
