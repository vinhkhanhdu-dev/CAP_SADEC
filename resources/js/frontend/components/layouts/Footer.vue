<template>
<!-- hidden footer class: mobile--hidden-->
    <footer class="site-footer">
        <div class="container">
            <div class="site-footer__inner">
                <div class="site-footer__menu">
                    <div class="footer-menu">
                        <div class="footer-menu__item">
                            <h4 class="footer-menu__title">Khám phá </h4>
                            <ul>
                                <li v-for="item in $store.state.category.categorys"><a>{{item['title']}}</a></li>
                            </ul>
                        </div>
                        <div class="footer-menu__item">
                            <h4 class="footer-menu__title">Dịch vụ khách hàng</h4>
                            <ul>
                                <li v-for="(item,i) in dataDVKH" :key="i"><a :href="item.path">{{item.title}}</a></li>
                            </ul>
                           <!-- <h4 class="footer-menu__title">Kiến thức mặc đẹp</h4>
                           <ul>
                               <li><a href="/size-chart">Hướng dẫn chọn size</a></li>
                               <li><a href="/blog">Blog</a></li>
                               <li><a href="https://www.facebook.com/groups/2103080403316797"
                                       target="_blank">Group mặc đẹp sống chất</a></li>
                           </ul> -->
                        </div>
                        <div class="footer-menu__item">
                            <h4 class="footer-menu__title">Về HaDoVn</h4>
                            <ul>
                                <li><a> Câu chuyện về HaDoVn</a></li>
                                <li><a>Nhà máy</a></li>
                            </ul>
                        </div>
                        <div class="footer-menu__item">
                            <h4 class="footer-menu__title">Địa chỉ liên hệ</h4>
                            <p class="footer-menu__desciption" v-html="diaChi"></p>
                            <h4 class="footer-menu__title">Email</h4>
                            <p class="footer-menu__desciption">{{$appSetting.EMAIL}}</p>
                        </div>
                    </div>
                </div>
                <div class="site-footer__sidebar">
                    <h4 class="site-footer__title">
                       {{$appSetting.NAME}} .... lắng nghe bạn!
                    </h4>
                    <p class="site-footer__description" style="margin-bottom: 10px">
                        Chúng tôi luôn trân trọng và mong đợi nhận được mọi ý kiến đóng góp từ
                        khách hàng để có thể nâng cấp trải nghiệm dịch vụ và sản phẩm tốt hơn nữa.
                    </p>
                        <a class="site-footer__btn">
                             Gửi Ý Kiến
                        </a>
                    <div class="footer-info">
                        <div class="footer-info__icon">
                            <img src="https://www.coolmate.me/images/footer/icon-hotline.svg"
                                alt="Footer Icon Phone">
                        </div>
                        <div class="footer-info__content">
                            <span class="footer-info__title">
                                Hotline
                            </span>
                            <p class="footer-info__desciption">
                                <a :href="'tel:'+$appSetting.PHONE_NUMBER">({{$appSetting.PHONE_NUMBER}})</a>
                            </p>
                        </div>
                    </div>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/DBStorethoitrangcaocap13" class="footer-social__item"
                            target="_blank">
                            <img src="/img/facebook.svg"
                                alt="Footer Icon facebook">
                        </a>
                        <a href="https://shopee.vn/havado.menswear" class="footer-social__item"
                            target="_blank">
                            <img src="/img/shopee.svg"
                                alt="Footer Icon shoppe">
                        </a>
                        <a href="https://www.tiktok.com/@havado.shop"
                            class="footer-social__item" target="_blank">
                            <img src="/img/tiktok.svg"
                                alt="Footer Icon tiktok">
                        </a>

                        <a :href="'http://zalo.me/0'+$appSetting.ZALO"
                            class="footer-social__item" target="_blank">
                            <img src="/img/zalo.svg"
                                alt="Footer Icon Zalo">
                        </a>
                    </div>
                </div>
            </div>
            <div class="site-footer__after">
                <div class="copyright">
                    <h5 class="copyright__title">
                        COPYRIGHT © BY HADOVN.COM
                    </h5>
                </div>
<!--                <div class="site-footer__logo" style="display: flex;">-->
<!--                    <a href="https://tinnhiemmang.vn/danh-ba-tin-nhiem/coolmateme-1646213826"-->
<!--                        title="Chung nhan Tin Nhiem Mang" target="_blank" style="margin-right: 10px">-->
<!--                        <img src="https://media.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/March2022/handle_cert.png"-->
<!--                            style="max-height: 40px" alt="Chung nhan Tin Nhiem Mang">-->
<!--                    </a>-->
<!--                    <a href="//www.dmca.com/Protection/Status.aspx?ID=c6fdbdee-127c-4cf1-923d-7efe75201df6"-->
<!--                        title="DMCA.com Protection Status" class="dmca-badge" style="margin-right: 10px"-->
<!--                        target="_blank">-->
<!--                        <img src="https://media.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/March2022/dmca_protected_15_120.png"-->
<!--                            alt="DMCA.com Protection Status" style="max-height: 40px" />-->
<!--                    </a>-->
<!--                    <a href="#" style="margin-right: 10px;">-->
<!--                        <img src="https://www.coolmate.me/images/footer/Coolmate-info.png" alt="Coolmate info"-->
<!--                            width="39" height="40">-->
<!--                    </a>-->
<!--                    <a href="http://online.gov.vn/(X(1)S(3e0hkhscv5zs101mhuopx43a))/Home/WebDetails/53184?AspxAutoDetectCookieSupport=1"-->
<!--                        target="_blank">-->
<!--                        <img src="https://www.coolmate.me/images/footer/logoSaleNoti.png" alt="Coolmate info"-->
<!--                            width="106" height="40">-->
<!--                    </a>-->
<!--                </div>-->
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        name: 'AppFooter',
        data() {
            return {
                dataDVKH:[
                    {path:'',title:'Hỏi đáp - FAQs'},
                    {path:'',title:'Chính sách đổi trả 60 ngày'},
                    {path:'',title:'Liên hệ'},
                    {path:'',title:'Khách hàng hài lòng 100%'},
                    {path:'',title:'Chính sách khuyến mãi'},
                    {path:'',title:'Chính sách giao hàng'},
                ],
                diaChi:`<u>Thủ Đức :</u> Số 36, Đường số 4, Linh Chiểu, Thủ ĐỨc`
            };
        },
        mounted(){

        },
        methods: {

        }
    }
</script>
<style scoped>

</style>
