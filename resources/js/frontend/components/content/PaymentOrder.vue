<template>
    <div class="container">
        <div style=" display: flex; flex-direction: column; text-align:center;justify-content: center; align-items: center">
            <img width="400" src="/img/banking.gif">
            <span style="font-weight: bold; font-size: 20px; color: #239a1a;">Đơn hàng: {{$route.params.order_code}}</span>
            <span style="font-weight: bold; font-size: 20px; color: #239a1a;">Đã đặt hàng thành công, Cảm ơn quý khách đã ủng hộ</span>
            <span style="color: rgb(0,0,0,0.2)">Quí khách vui lòng chuyển khoản đến một trong các tài khoản theo hướng dẫn</span>
            <div style="border: 1px dotted rgb(0,0,0,0.1); text-align: left; padding: 10px; display: flex; flex-direction: column">
               <span style="text-decoration-line:underline; color: rgb(0,0,0,0.5)"> Thông tin tài khoản hưởng (nhận)</span>
               <span style="color: rgb(0,0,0,0.5)"> Tên chủ tài khoản: Đặng Đình Đông</span>
               <span style="color: rgb(0,0,0,0.5)"> Techcombank Thủ đức:  {{$appSetting.STK_TECH}}</span>
               <span style="text-decoration-line:underline; color: rgb(0,0,0,0.5)"> Nội dung chuyển khoản:</span>
                <span style="color: rgb(0,0,0,0.5)">"Thanh toan don hang -
                    <span style="color: #239a1a">{{$route.params.order_code}}"</span>
                </span>
            </div>
            <el-button @click="$router.push({name:'home'})" style="margin-top: 10px; width: 100%">
                <i class="el-icon-shopping-cart-2"></i>
                Tiếp tục mua sắm</el-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PaymentOrder"
    }
</script>

<style scoped>

</style>
