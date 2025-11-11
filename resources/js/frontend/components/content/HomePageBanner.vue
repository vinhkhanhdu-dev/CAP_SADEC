<template>
    <section class="homepage-banner" v-loading="!SlideData.length">
<!--        <el-carousel indicator-position="outside" class="carousel&#45;&#45;banner">-->
<!--            <el-carousel-item v-for="(item,i) in SlideData" :key="i"-->

<!--                              class="images&#45;&#45;banner">-->
<!--                            <img :src="item.path"/>-->
<!--                <div class="banner-policy">-->
<!--                    <div class="banner-policy__wrapper mobile&#45;&#45;hidden">-->
<!--                        <a class="banner-policy__item">-->
<!--                            Miễn phí vận chuyển cho<br>-->
<!--                            đơn hàng trên 200K-->
<!--                        </a>-->
<!--                        <a class="banner-policy__item">-->
<!--                            60 ngày đổi trả vì<br>-->
<!--                            bất kì lý do gì-->
<!--                        </a>-->
<!--                        <a class="banner-policy__item">-->
<!--                            Đến tận nơi nhận hàng trả,<br>-->
<!--                            hoàn tiền trong 24h-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </el-carousel-item>-->
<!--        </el-carousel>-->
        <VueSlickCarousel v-bind="settings" v-if="SlideData.length">
            <div v-for="(item,i) in SlideData">
                <img :key="i" id="img-banner" :src="item.path"/>
            </div>

        </VueSlickCarousel>
    </section>
</template>
<script>
    import ApiService from "../../../backend/common/api.service";
    import VueSlickCarousel from 'vue-slick-carousel'
    import 'vue-slick-carousel/dist/vue-slick-carousel.css'
    import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
    export default {
        components: {
            VueSlickCarousel
        },
        data() {
            return {
                settings: {
                    "dots": true,
                    "dotsClass": "slick-dots custom-dot-class",
                    "edgeFriction": 0.35,
                    "infinite": false,
                    "speed": 500,
                    "slidesToShow": 1,
                    "slidesToScroll": 1,
                    "adaptiveHeight": true
                },
                SlideData: []
            }
        },
        mounted(){
          this.getBanner()
            if(window.innerWidth < 900){
                this.heightBanner=''
            }
        },
        methods:{
            getBanner(){
                ApiService.query('/api/admin/banners').then(({data})=>{
                    if(data['success']){
                        this.SlideData = data['data'].filter(e=>e.hidden == 1)
                    }
                })
            }
        }
    }
</script>

<style>
    .slick-prev:before, .slick-next:before {
        color: black;
        font-size: 20px;
        /*background-color: rgb(255,255,255,1);*/
        padding: 5px;
        border-radius: 50%;
    }
    .slick-prev{
        content: '◄';
        /*transform: rotate(180deg);*/
        display: flex;
        align-items: center;
        left: 30px;
        z-index: 9;
        display: flex;
        align-items: center;

    }

    .slick-next {
        right: 30px;
        z-index: 9;
        content: '►';
    }
    #img-banner{
        width: 100%;
    }
    .carousel--banner > .el-carousel__container{
    }
    .images--banner{

        /*background-repeat: no-repeat; background-position: center; background-size: contain;*/
    }
    /*@media screen and (max-width: 900px){*/
    /*    .images--banner{*/
    /*        background-repeat: no-repeat; background-position: center; background-size:contain ;*/
    /*    }*/
    /*}*/
</style>
