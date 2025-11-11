<template>
    <div class="site-content">
        <div class="container" v-if="$store.getters.shoppingCart.cart.length">
            <div class="grid">
                <div class="grid__column seven-twelfths mobile--one-whole cart-left-section">
                    <div class="cart-section">
                        <div class="title-with-actions">
                            <div class="title">
                                Thông tin vận chuyển
                            </div>
                        </div>
                        <div id="customer-info-block">
                            <el-form :model="form" ref="ruleForm" inline-message class="demo-ruleForm">
                                <el-row :gutter="5">
                                    <el-form-item required>
                                        <el-col :span="12">
                                            <el-form-item :rules="required" prop="Name">
                                                    <el-input v-model="form.Name" placeholder="Họ và tên"></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="12">
                                            <el-form-item :rules="required" prop="PhoneNumber">
                                                    <el-input v-model="form.PhoneNumber" placeholder="Số điện thoại"></el-input>
                                            </el-form-item>
                                        </el-col>
                                    </el-form-item>
                                </el-row>
                                <el-row :gutter="5">
                                    <el-col :span="24">
                                        <el-form-item prop="Email">
                                            <el-input v-model="form.Email" placeholder="Email"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row :gutter="5">
                                    <el-col :span="24">
                                        <el-form-item :rules="required" prop="LocationText">
                                            <el-input v-model="form.LocationText" placeholder="Địa chỉ (ví dụ: 103 Vạn Phúc, phường Vạn Phúc)"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row :gutter="5">
                                    <el-form-item required>
                                        <el-col :span="8">
                                            <el-form-item :rules="required" prop="Province">
                                                <el-select no-data-text="Chưa có dữ liệu" :disabled="!dataProvince" style="width: 100%" filterable  v-model="form.Province" @change="getDistrict($event)" placeholder="Chọn Tỉnh/ Thành Phố">
                                                    <el-option
                                                        v-for="item in dataProvince"
                                                        :key="item.ProvinceCode"
                                                        :label="item.ProvinceName"
                                                        :value="item">
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="8">
                                            <el-form-item :rules="required" prop="District">
                                                <el-select no-data-text="Chưa có dữ liệu" :disabled="!dataDistrict" style="width: 100%" filterable  v-model="form.District" @change="getCommune($event)" placeholder="Chọn Quận / Huyện">
                                                    <el-option
                                                        v-for="item in dataDistrict"
                                                        :key="item.ProvinceCode"
                                                        :label="item.ProvinceName"
                                                        :value="item">
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="8">
                                            <el-form-item :rules="required" prop="Commune">
                                                <el-select no-data-text="Chưa có dữ liệu" :disabled="!dataCommune" style="width: 100%;" filterable  v-model="form.Commune"  placeholder="Chọn Phường/ Xã">
                                                    <el-option
                                                        v-for="item in dataCommune"
                                                        :key="item.ProvinceCode"
                                                        :label="item.ProvinceName"
                                                        :value="item.ProvinceName">
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </el-col>
                                    </el-form-item>
                                </el-row>
                                <el-row :gutter="5">
                                    <el-col :span="24">
                                        <el-form-item prop="Note">
                                            <el-input v-model="form.Note" placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính)"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <div class="cart-section">
                                    <div class="title"> Hình thức thanh toán</div>
                                    <div>
                                        <el-form-item :rules="required" prop="PaymentMethods">
                                            <label class="payment-method__item"
                                                   v-bind:class="{'active':form.PaymentMethods==1}">
                                                 <el-radio style="display: flex; align-items: center" v-model="form.PaymentMethods" label="1">
                                                     <div style="display: flex; align-items: center;">
                                                         <span class="payment-method__item-icon-wrapper">
                                                            <img src="/img/COD.svg" alt="COD <br>Thanh toán khi nhận hàng">
                                                        </span>
                                                         <span
                                                             class="payment-method__item-name">COD <br>Thanh toán khi nhận hàng</span>
                                                     </div>
                                                 </el-radio>

                                            </label>
                                            <label class="payment-method__item"
                                                   v-bind:class="{'active':form.PaymentMethods==2}">
                                                 <el-radio style="display: flex; align-items: center" v-model="form.PaymentMethods" label="2">
                                                     <div style="display: flex; align-items: center;">
                                                        <span class="payment-method__item-icon-wrapper">
                                                           <i style="font-size: 40px; color: #239a1a" class="el-icon-bank-card"/>
                                                        </span>
                                                        <span class="payment-method__item-name">Chuyển khoản trước</span>
                                                     </div>
                                                 </el-radio>
                                            </label>
<!--                                            <div class="payment-bank">-->
<!--                                                <el-row>-->
<!--                                                    <el-col>-->
<!--                                                        <span class="payment-method__item-name">Quý khách vui lòng chuyển khoản vào một trong các số tài khoản: </span>-->
<!--                                                    </el-col>-->
<!--                                                    <el-col>-->
<!--                                                        <span>1. BIDV: 900000909090909</span>-->
<!--                                                    </el-col>-->
<!--                                                    <el-col>-->
<!--                                                        <span>2. ViettinBank: 900000909090909</span>-->
<!--                                                    </el-col>-->
<!--                                                    <el-col>-->
<!--                                                        <span>Với nội dung: Thanh </span>-->
<!--                                                    </el-col>-->
<!--                                                </el-row>-->
<!--                                            </div>-->
                                        </el-form-item>

                                    </div>

                                    <p class="cart-return-text">
                                        Nếu bạn không hài lòng với sản phẩm của chúng tôi? Bạn hoàn toàn có thể trả lại
                                        sản phẩm.
                                        Tìm hiểu thêm <a href="#" target="_blank"><b>tại đây</b></a>.
                                    </p>
                                </div>
                            </el-form>
                        </div>
                    </div>

                    <input type="hidden" id="gclid_field" name="gclid_field" value="">
                    <div class="cart-section">
                        <button class="checkout-btn" @click="submitForm('ruleForm')">
                            Thanh toán <span>{{TotalPrice |toThousandFilter }} đ</span>
                                <span v-show="form.PaymentMethods==1">(COD)</span>
                                <span v-show="form.PaymentMethods==2">(Banking)</span>
                        </button>
                    </div>
                </div>
                <div class="grid__column five-twelfths mobile--one-whole">
                    <div class="cart-section">
                        <div class="title">
                            Giỏ hàng
                        </div>
                        <div>
                            <div class="cart-items">
                                <div class="cart-item" v-for="item in $store.getters.shoppingCart.cart" style="margin-bottom: 10px">
                                    <span class="cart-item__remove" @click="deleteItemCart(item.id)">✕</span>
                                    <div class="cart__column cart__column-left">
                                        <div class="cart-item__thumbnail-block shopping--cart">
                                            <img style="width: 120px; height: 140px; object-fit: cover"
                                            :src="item.images_product[0]['path']"
                                            :alt="item.name"
                                            class="cart-item__thumbnail">
                                        </div>
                                    </div>
                                    <div class="cart__column cart__column-right shopping--cart">
                                        <div class="cart-item__block">
                                            <div class="cart-item__info"><a @click="navRouter({name:'product-detail',params:{id:item.id}})" class="cart-item__title">
                                                <span class="name__product">{{item.name}}</span>
                                            </a>
                                                <div class="cart-item__variant">
                                                   {{item.payment.color.title}} / {{item.payment.size.title}}
                                                </div>
                                            </div>
                                            <div class="cart-item__actions">
                                                <div style="display: flex">
                                                    <div style="padding-right: 5px; padding-bottom: 5px"
                                                         class="v-select vue-select cart-item__select vs--single vs--unsearchable">
                                                           {{item.payment.price| toThousandFilter}}đ x{{item.payment.total}}
                                                    </div>
                                                </div>
                                                <div class="cart-item__actions-bottom">
                                                    <div class="quantity-box" style="display: flex">
                                                        <el-input :value="item.payment.total" style="width: 200px; text-align: center">
                                                            <template v-slot:append>
                                                                <el-button :disabled="item.payment.total>=10" @click="addItem(item)">+</el-button>
                                                            </template>
                                                            <template v-slot:prepend>
                                                                <el-button :disabled="item.payment.total<=1" @click="removeItem(item)">-</el-button>
                                                            </template>
                                                        </el-input>
                                                    </div>
                                                    <div class="flex flex--column mobile--hidden"><span>
                                                            {{item.payment.price * item.payment.total | toThousandFilter}}đ
                                                     </span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <el-divider></el-divider>
                    <div class="pricing-info">
                        <div class="pricing-info__item">
                            <p>Tạm tính</p>
                            <p class="pricing-info__sub"><span>{{tempTotalPrice | toThousandFilter}}đ</span></p>
                        </div>
                        <div class="pricing-info__item">
                            <p>Giảm giá</p>
                            <p><span>0đ</span></p>
                        </div>

                        <div class="pricing-info__item">
                            <p>Phí giao hàng</p>
                            <p><span>Miễn phí</span></p>
                        </div>
                        <el-divider></el-divider>
                        <div class="pricing-info__item pricing-info__total">
                            <p>Tổng</p>
                            <p><span>{{TotalPrice | toThousandFilter}}đ</span> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex justify--center align--center" v-else>
            <div style="text-align: center;margin-bottom: 20px; margin-top: 20px">
                <span>Không có sản phẩm nào được tìm thấy trong giỏ hàng của bạn!</span>
                <br>
                <span>
                Vui lòng <a @click="$router.push({ name: 'home' })" style="font-weight: bold; text-decoration: underline;">quay
                    lại</a> để tiếp tục mua sắm bạn nhé!
            </span>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex'
import ApiService from "../../../backend/common/api.service";
export default {
    name: "ShoppingCart",
    data(){
        return{
            num:1,
            dataProvince:[],
            dataDistrict:[],
            dataCommune:[],
            form:{
                Province:'',
                District:'',
                Commune:'',
                Name:'',
                Email:'',
                PhoneNumber:'',
                LocationText:'',
                Note:'',
                PaymentMethods:''
            },
            required:{ required: true, message: 'Vui lòng không bỏ trống', trigger: ['blur','change'] },
            formData:new FormData(),
            loading:false

        }
    },
    mounted() {
        this.getProvince()
    },
    watch:{
    },
    methods:{
        appendToFormData(){
            let _this = this
            Object.keys(this.form).forEach(key => {
                _this.formData.set(key, this.form[key])
                // if(key=='Province'||key=='District'||key=='Commune'){
                //     _this.formData.set(key, this.form[key]['ProvinceName'])
                // }
            });
            _this.formData.set('dataCart', JSON.stringify(this.$store.getters.shoppingCart.cart))
        },
        submitForm(ruleForm){
            let _this = this
            this.$refs[ruleForm].validate((valid) => {
                if (valid) {
                    _this.appendToFormData()
                    _this.loading=true
                    ApiService.post('/api/admin/orders/create',_this.formData).then(({data})=>{
                        if(data['success']){
                            _this.$notify({
                                title: 'Success',
                                message: data['mess'],
                                type: 'success',
                                position: 'bottom-right'
                            });
                            _this.$store.dispatch("shoppingCart/removeAllCart");
                            if(_this.form.PaymentMethods==1){
                                _this.$router.push({name:'order-success', params:{order_code:data['order_code']}})
                            }else {
                                _this.$router.push({name:'payment-order', params:{order_code:data['order_code']}})
                            }

                        }else{
                            _this.$notify({
                                title: 'Error',
                                message: data['mess'],
                                type: 'error',
                                position: 'bottom-right'
                            });
                        }
                        this.loading=false
                    })
                } else {
                    this.loading=false
                    return false;
                }
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
        addItem(item){
            this.$store.dispatch("shoppingCart/pushItem", item);
        },
        removeItem(item){
            this.$store.dispatch("shoppingCart/removeItem", item);
        },
        deleteItemCart(item){
            this.$store.dispatch("shoppingCart/deleteFromCart", item);
        },
        getProvince() {
            ApiService.query('/api/admin/get-full-province?type=province').then(({data}) => {
                if (data['success']) {
                    this.dataProvince = data['data']
                }
            })
        },
        getDistrict(item){
            this.form.Province = item.ProvinceName
            this.form.District = ''
            this.dataDistrict=[]
            this.form.Commune = ''
            this.dataCommune=[]
            ApiService.query('/api/admin/get-full-province?type=district&ProvinceCode='+item.ProvinceCode).then(({data})=>{
                if(data['success']){
                    this.dataDistrict = data['data']
                }
            })
        },
        getCommune(item){
            this.form.District = item.ProvinceName
            this.form.Commune = ''
            ApiService.query('/api/admin/get-full-province?type=commune&ProvinceCode='+item.ProvinceCode).then(({data})=>{
                if(data['success']){
                    this.dataCommune = data['data']
                }
            })
        }
    },
    computed: {
        ...mapState([
            "cart"
        ]),
        ...mapGetters([
            "cartSize",
            "cartTotalAmount"
        ]),
        tempTotalPrice(){
            let total=0
            this.$store.getters.shoppingCart.cart.map(e=>{
                total+= e.payment.total*e.payment.price
            })
            return total

        },
        TotalPrice(){
            let total=0
            this.$store.getters.shoppingCart.cart.map(e=>{
                total+= e.payment.total*e.payment.price
            })
            return total

        }
    },
}
</script>

<style scoped>
    .payment-bank{
        padding: 10px;
        border: 1px solid rgb(0,0,0,0.1);
    }
.cart-item {
    position: relative;
    display: flex;
    flex-flow: row wrap;
    padding: 0;
}

.cart-item__remove {
    cursor: pointer;
    position: absolute;
    top: 0;
    right: 0;
    transition: all .2s;
    z-index: 3;
}

.cart-item__title {
    font-weight: 700;
    font-size: .9rem;
    max-width: 85%;
    display: block;
}

.pricing-info__item {
    display: flex;
    justify-content: space-between;
}

.cart-item__thumbnail {
    border-radius: 20px;
}

.cart-item__thumbnail-block.shopping--cart {
    position: relative;
    width: 126px;
}

.payment-method__item {
    display: flex;
    align-items: center;
    border: 1px solid #D9D9D9;
    border-radius: 16px;
    padding: 15px 20px;
    cursor: pointer;
    transition: .2s all;
    opacity: .6;
}

.payment-method__item-icon-wrapper img {
    min-width: 35px;
    max-height: 35px;
    max-width: 55px;
}

.payment-method__item.active,
.payment-method__item:not(.disabled):hover {
    border: 1px solid #2f5acf;
    opacity: 1;
}

.checkout-btn {
    border-radius: 16px;
    height: 55px;
    width: 100%;
    padding: 15px 20px;
    background-color: #000;
    color: #fff;
    text-align: center;
    border: none;
    cursor: pointer;
    transition: all .2s;
}

.payment-method__item:not(:last-child) {
    margin-bottom: 1rem;
}

.cart-item__block {
    display: flex;
    height: 100%;
    flex-flow: row;
    flex-wrap: wrap;
}

.cart-item__select .vs__dropdown-toggle {
    display: inline-flex !important;
    padding: 3px 6px !important;
    height: 30px !important;
    border-radius: 8px !important;
    border: 1px solid #000 !important;
    margin-bottom: 5px !important;
}

.cart-item__actions {
    width: 100%;
    margin-top: auto;
    display: flex;
    flex-flow: column;
    flex-wrap: wrap;
}

.cart-item__variant {
    font-size: .8rem;
}

.cart-item__info {
    width: 100%;
}

.cart-item__actions-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: right;
}

.cart__column-right {
    margin-left: 1.5rem;
    flex: 3;
}

.cart-left-section {
    border-right: 1px solid #d9d9d9;
}
.payment-method__item-icon-wrapper {
    margin: 0 1.5rem;
}
@media screen and (max-width: 946px){
    .cart-item__thumbnail-block.shopping--cart {
        position: relative;
        width: 30vw;
    }
    .cart__column.cart__column-right.shopping--cart{
        width: 50vw !important;
    }
}
</style>
