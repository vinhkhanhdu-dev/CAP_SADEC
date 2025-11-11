<template>
    <div class="container">
        <div style=" display: flex; flex-direction: column; text-align:center;justify-content: center; align-items: center">
            <img width="400" src="/img/success.gif">
            <div style="display: flex; flex-direction: column; text-align:center; margin-bottom: 20px ">
                <span style="font-weight: bold; font-size: 20px; color: #239a1a;">Đơn hàng: {{$route.params.order_code}}</span>
                <span style="font-weight: bold; font-size: 20px; color: #239a1a;">Đã đặt hàng thành công, Cảm ơn quý khách đã ủng hộ</span>
                <span style="color: rgb(0,0,0,0.2)">Quí khách vui lòng thường xuyên kiểm tra điện thoại, để bên giao hàng dễ dàng liên hệ</span>
                <el-button @click="$router.push({name:'home'})" style="margin-top: 10px">
                    <i class="el-icon-shopping-cart-2"></i>
                    Tiếp tục mua sắm</el-button>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "OrderSuccess"
    }
</script>

<style scoped>

</style>
