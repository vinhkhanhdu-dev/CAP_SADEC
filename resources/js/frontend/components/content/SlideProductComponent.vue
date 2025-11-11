<template>
    <div class="content__product-component">
        <VueSlickCarousel v-bind="setting" v-if="dataProduct.length > 0">
            <div v-for="(item, i) in dataProduct" class="home__page-product">
                <div class="product-grid product option-changed" @click="navRouter({ name: 'product-detail', params: { id: item.id } })">
                    <div class="product-grid__thumbnail">
                        <div class="product-grid__image">
                            <img loading="lazy"
                                 :src="item.images_product[0].path"
                                 class="home-banner">
                        </div>
                        <span class="product-grid__tags product-grid__tags--sale">Sale</span>
                        <div class="product-grid__select">
                            <div class="option-select">
                                <!--                                    <label class="option-select__item" v-for="itemSize in item['options_product'].filter((a, i) => item['options_product'].findIndex((s) => a.id_size === s.id_size) === i)" style="">-->
                                <!--                                    <label class="option-select__item" v-for="itemSize in JSON.parse(itemOption['list_size'])"  style="">-->
                                <label class="option-select__item" v-for="itemSize in getListSizeInString(item['options_product'])"  style="">
                                    <input type="radio">
                                    <span class="checkmark">
                                            {{ itemSize}}
                                        </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="product-grid__content">
                        <div class="product-grid__options">
                            <div class="options-color">
                                <div v-for="itemColor in item['options_product'].filter((a, i) => item['options_product'].findIndex((s) => a.id_color === s.id_color) === i)"
                                     class="option-color__item is-current">
                                     <span v-if="itemColor['color']['image']" class="item-color" v-bind:style="{'background-image':('url('+itemColor['color']['image']+')')}"></span>

                                    <span v-else class="checkmark" v-bind:style="{'background-color':itemColor['color']['value']}"></span>
                                </div>
                            </div>
                        </div>
                        <h3 class="product-grid__title"  @click="navRouter({ name: 'product-detail', params: { id: item.id } })">
                            <a class="name__product">
                                {{ item.name }}
                            </a>
                        </h3>
                        <div class="product-grid__prices">
                            <div class="product-prices">
                                <span style="color: red;margin-left: 10px;">{{ item.disksCount }}</span>
                                <del>{{ item['options_product'][0].price | toThousandFilter }} đ</del>
                                <ins>{{ item['options_product'][0].price | toThousandFilter }}</ins>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </VueSlickCarousel>
    </div>
</template>

<script>
    import VueSlickCarousel from 'vue-slick-carousel'
    //   optional style for arrows & dots
    import 'vue-slick-carousel/dist/vue-slick-carousel.css'
    //   optional style for arrows & dots
    import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
    import ApiService from "../../../backend/common/api.service";

    export default {
        components: {
            VueSlickCarousel
        },
        data() {
            return {
                hoverIndex: '',
                dataProduct: [],
                setting: {
                    "autoplay":true,
                    "dots": false,
                    "infinite": false,
                    "speed": 500,
                    "slidesToShow": 3,
                    "slidesToScroll": 1,
                    "initialSlide":0,
                    "swipeToSlide": false,
                    "responsive": [
                        {
                            "breakpoint": 1600,
                            "settings": {
                                "slidesToShow": 3,
                                "slidesToScroll": 1,
                                "initialSlide":0,
                                "infinite": false,
                                "dots": false
                            }
                        },
                        {
                            "breakpoint": 1024,
                            "settings": {
                                "slidesToShow": 2,
                                "slidesToScroll": 1,
                                "initialSlide":0,
                                "infinite": false,
                                "dots": false
                            }
                        },

                        {
                            "breakpoint": 600,
                            "settings": {
                                "slidesToShow": 2,
                                "slidesToScroll": 1,
                                "initialSlide": 0,
                                "infinite": false,
                                "dots": false
                            }
                        },
                        {
                            "breakpoint": 480,
                            "settings": {
                                "slidesToShow": 2,
                                "slidesToScroll": 1,
                                "initialSlide": 0,
                                "infinite": false,
                                "dots": false
                            }
                        }
                    ]
                }
            }
        },
        mounted() {
            this.getDataProduct()
        },
        methods: {
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
            getListSizeInString(e){
                let arr =[]
                e & e.map(el=>{
                    arr = arr.concat(JSON.parse(el.list_size))
                })
                return ([...new Set(arr)])
            },
            getDataProduct() {
                ApiService.query('/api/admin/products', {page: 1, limit: 10}).then(({data}) => {
                    if (data['success']) {
                        this.dataProduct = data['data']
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .item-color{
        height: 20px; 
        width: 35px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    .product-color__item {
        height: 25px;
        width: 50px;
        border-radius: 20px;
        border: 1px solid rgb(255, 255, 255, 0.5);

    }

    .home__page-product img {
        height: 100%;
        width: 100%;
        /*object-fit: cover;*/
    }

    .slick-prev:before, .slick-next:before {
        color: black;
        font-size: 30px;
        content: '➔';
    }
    .slick-prev{
        content: '➔';
        transform: rotate(180deg);
    }

    .home__page-product:hover .product-list__size {
        visibility: visible;
        pointer-events: visible;
        transform: translateZ(0);
        opacity: 1;
        /*height: 60px;*/
        padding-top: 10px;
        background-color: rgb(0, 0, 0, 0.3);
    }

    .product-list__size {
        width: 100%;
        padding: 5px;
        position: absolute;
        z-index: 9;
        bottom: 0;
        display: flex;
        visibility: hidden;
        transform: translate3d(0, 20px, 0);
        transition: all .3s;
        opacity: 0;
    }

    .product-size__item {
        width: 40px;
        height: 30px;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        border-radius: 5px;
        margin-right: 5px;
    }

    .home__page-product {
        padding-right: 5px;
        height: 700px;
        position: relative;
        z-index: 1;
    }

    @media screen and (max-width: 700px) {
        .home__page-product {
            height: 350px;
        }

        .content__product {
            padding: 0 !important;
        }

        .slick-prev {
            left: 13px !important;
            z-index: 99999999999999999 !important;
        }

        .slick-next {
            right: 13px !important;
            z-index: 99999999999999999 !important;
        }
    }

    .product__item {
        width: 100%;
        height: calc(100% - 60px);
        background-color: beige;
        /*background-image: url('https://media.coolmate.me/cdn-cgi/image/width=672,height=990,quality=85,format=auto/uploads/January2023/jogger-casual-xam-nhat2_60.jpg');*/
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        transition: all linear;
        position: relative;
    }

    /*.product__item:hover{*/
    /*    background-image: url('https://media.coolmate.me/cdn-cgi/image/width=672,height=990,quality=85,format=auto/uploads/September2022/jogger-casual-xam-nhat1_79.jpg') ;*/
    /*}*/


    .product__list-color {
        margin-top: 10px;
        height: 20px;
        width: 100%;
        display: flex;
    }

    .color__item {
        height: 20px;
        width: 35px;
        background-color: black;
        border: 1px solid rgb(0, 0, 0, 0.2);
        border-radius: 8px;
        margin-right: 5px;
    }

    .product-size__item:hover {
        background-color: #000;
        color: #fff;
    }

    .content__product {
        padding: 50px;
    }

    #colorItem {
        background-color: #2F5ACF;
    }
    .product--image{
        width: 100%;
        height: 100%;
    }
    .name__product{
        margin-bottom: 5px;
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
