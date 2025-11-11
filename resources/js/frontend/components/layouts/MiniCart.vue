<template>
    <div class="mini-cart">
        <div class="mini-cart__wrapper" v-if="$store.getters.shoppingCart.cart.length">
            <div class="mini-cart__header">
                <span>{{$store.getters.shoppingCart.cart.length}} sản phẩm </span>
                <router-link :to="{name:'shopping-cart'}">Xem tất cả</router-link>
            </div>
            <div v-for="item in $store.getters.shoppingCart.cart" style="margin-bottom: 5px" class="mini-cart__item">
                <div class="mini-cart__item-thumbnail">
                    <img style="width: 100px; height: 120px; object-fit: cover; border-radius: 10px"
                         :src="item['images_product'][0]['path']"
                         alt="Áo Polo thể thao nam Recycle Active V2">
                </div>
                <div class="mini-cart__item-content">
                                            <span @click="deleteItemCart(item.id)" class="mini-cart__remove">✕
                                            </span>
                    <div class="mini-cart__item-title"><a
                        @click="navRouter({name:'product-detail',params:{id:item.id}})" target="_blank">
                        <span class="name__product">{{item.name}}</span>
                    </a>
                    </div>
                    <div class="mini-cart__item-variant-info">
                        {{item.payment.color.title}} / {{item.payment.size.title}}
                    </div>
                    <div><span class="mini-cart__item-quantity">
                                                    {{item.payment.price| toThousandFilter}} đ x{{item.payment.total}}
                                                </span>
                    </div>
                    <div><span class="mini-cart__item-price">
                                                    {{item.payment.price * item.payment.total | toThousandFilter}} đ
                                                </span> <!----></div>
                </div>

            </div>

        </div>
        <div v-else>
            Chưa có sản phẩm nào trong giỏ hàng ...
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapState} from "vuex";

    export default {
        name: "MiniCart",
        methods: {
            deleteItemCart(item) {
                this.$store.dispatch("shoppingCart/deleteFromCart", item);
                this.$notify({
                    title: 'Success',
                    message: 'Xóa sản phẩm khỏi giỏ hàng thành công',
                    type: 'success'
                });
            },
            navRouter(route) {
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
        computed: {
            ...mapState([
                "cart"
            ]),
            ...mapGetters([
                "cartSize",
                "cartTotalAmount"
            ])
        },
    }
</script>

<style scoped>

    .mini-cart {
        padding: 1rem;
        width: 400px;
    }

    .mini-cart__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .mini-cart__item {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        cursor: pointer;
        font-size: .8rem;
    }

    .mini-cart__item-thumbnail {
        margin-right: 1rem;
    }

    .mini-cart__item-content {
        flex: 1;
        height: 100%;
        position: relative;
        padding-right: 20px;
    }

    .mini-cart__remove {
        position: absolute;
        top: 0;
        right: 0;
    }

    .mini-cart__item-title {
        font-weight: bold;
        transition: .2s all;
    }
</style>
