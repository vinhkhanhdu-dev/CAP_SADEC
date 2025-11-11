<template>
    <div class="container" v-loading="loading" style="margin-top: 20px">
        <div style="padding-bottom: 10px">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }">Trang chủ</el-breadcrumb-item>
                <el-breadcrumb-item><a href="#">Tất cả sản phẩm</a></el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <el-divider></el-divider>
        <div>
            <el-row :gutter="20">
                <el-col :span="2" :xs="24">
                    <h3>SẢN PHẨM</h3>
                </el-col>
                <el-col style="padding-bottom:10px" :span="5" :xs="24">
                    <el-input @keyup.enter.native="getListProduct()" v-model="textSearch"
                        placeholder="Nhập kí tự cần tìm kiếm">
                        <template v-slot:append>
                            <el-button type="primary"><i class="el-icon-search"></i>
                            </el-button>

                        </template>
                    </el-input>
                </el-col>
                <el-col :span="5" :xs="24">
                    <!-- <el-cascader v-if="this.$store.state.category.categorys.length" placeholder="Chọn danh mục"
                    v-model="categorySelect"
                    :props="{label:'title',value:'id',multiple:true,checkStrictly:'true',collapseTags:false,checkStrictly:true,leaf:'id', emitPath:false}"
                    :options="this.$store.state.category.categorys">
                    </el-cascader> -->
                    <!-- <el-input></el-input> -->
                    <el-select style="width: 100%" @change="getListProduct()" v-model="categorySelect" size="large"
                        filterable clearable placeholder="Chọn danh mục">
                        <el-option v-for="item in this.$store.state.category.flattenData" :key="item.id" :label="item.title"
                            :value="item.id" :disabled="item.disabled">
                        </el-option>
                    </el-select>
                </el-col>
            </el-row>
        </div>
        <el-divider></el-divider>
        <div id="products" v-for="item in $store.state.category.flattenData"
            v-if="dataProduct.filter(e => e.category.id == item.id).length > 0"
            class="grid grid--five-columns large-grid--four-columns tablet-grid--three-columns mobile-grid--two-columns">
            <div class="grid__column" style="position: relative;">
                <div class="collection-thumbnail" style="display: flex; align-items: center; justify-content: center;">
                    <span class="name__product title__category">
                         {{ item.title }}
                    </span>
                    <img :src="item['img']" alt="Áo Nam">
                </div>
            </div>
            <div class="grid__column" v-for="item in dataProduct.filter(e => e.category.id == item.id)"
                style="position: relative">
                <div class="product-grid product option-changed">
                    <div class="product-grid__thumbnail">
                        <div class="product-grid__image" @click="$router.push({ name: 'product-detail', params: { id: item.id } })">
                            <img loading="lazy" :src="item.images_product[0].path" class="home-banner">
                        </div>
                        <span class="product-grid__tags product-grid__tags--sale">Sale</span>
                        <div class="product-grid__select">
                            <div class="option-select">
                                <!--                                    <label class="option-select__item" v-for="itemSize in item['options_product'].filter((a, i) => item['options_product'].findIndex((s) => a.id_size === s.id_size) === i)" style="">-->
                                <!--                                    <label class="option-select__item" v-for="itemSize in JSON.parse(itemOption['list_size'])"  style="">-->
                                <label class="option-select__item"
                                    v-for="itemSize in getListSizeInString(item['options_product'])" style="">
                                    <input type="radio">
                                    <span class="checkmark">
                                        {{ itemSize }}
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
                                    <span class="checkmark"
                                        v-bind:style="{ 'background-color': itemColor['color']['value'] }"></span>
                                </div>
                            </div>
                        </div>
                        <h3 class="product-grid__title">
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
            <div id="btnLoadMore-giam-70" class="grid__column" style="display: unset;">
                <div data-collection="giam-70" rel-script="product-loadmore-giam70" class="collection-giam70"
                    style="cursor: pointer;"></div>
            </div>
        </div>
        <div v-if="dataProduct.length == 0" style="text-align: center;margin-bottom: 20px;">
            <span>Không tìm thấy sản phẩm phù hợp theo yêu cầu của bạn!</span>
            <br>
            <span>
                Vui lòng <a @click="$router.push({ name: 'home' })" style="font-weight: bold; text-decoration: underline;">quay
                    lại</a> để tiếp tục mua sắm bạn nhé!
            </span>
        </div>
        <div rel-script="loadmore" v-show="dataProduct.length < countData && dataProduct.length > 0" data-current-page="1"
            data-last-page="3" style="text-align: center; margin-bottom: 2em;">
            <a class="btn btn-primary loadmore" @click="pagelimit = pagelimit + 20, getListProduct('loadmore')">Xem thêm</a>
        </div>
    </div>
</template>
<script>
import { parse } from 'qs';
import ApiService from '../../../backend/common/api.service'

export default {
    data() {
        return {
            dataProduct: [],
            textSearch: '',
            page: 1,
            pagelimit: 20,
            countData: 0,
            cate: '',
            options: [],
            categorySelect: '',
            loading: false,
        }
    },
    watch: {
        $route(){
            this.$route.query.keyword && (this.textSearch=  this.$route.query.keyword)
            this.$route.query.category && (this.categorySelect= parseInt(this.$route.query.category))
            this.getListProduct()
        }
    },
    mounted() {
        this.$route.query.keyword && (this.textSearch=  this.$route.query.keyword)
        this.$route.query.category && (this.categorySelect= parseInt(this.$route.query.category))
        this.getListProduct()
    },
    methods: {
        getListProduct(type) {
            this.loading = true
            let params = {
                page: this.page,
                limit: this.pagelimit
            }
            this.textSearch && (params.search = this.textSearch)
            ApiService.query('/api/admin/products', { params: params }).then(({ data }) => {
                if (data['success']) {
                    // if (type == 'loadmore') {
                    //     if (this.categorySelect) {
                    //         this.dataProduct = this.dataProduct.concat(data['data'].filter(e => e.id_category == this.categorySelect))
                    //     } else {
                    //         this.dataProduct = this.dataProduct.concat(data['data'])
                    //     }
                    // } else {
                        if (this.categorySelect) {
                            this.dataProduct = (data['data']).filter(e => e.id_category == this.categorySelect)
                        } else {
                            this.dataProduct = (data['data'])
                        }
                    // }

                    this.countData = data['count']
                }
                this.loading = false
            })
        },
        getListSizeInString(e) {
            let arr = []
            e & e.map(el => {
                arr = arr.concat(JSON.parse(el.list_size))
            })
            return ([...new Set(arr)])
        },
    },
    computed: {

    }
}
</script>

<style>
.collection-thumbnail img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

.collection-thumbnail img {
    object-position: top;
}

.collection-thumbnail {
    height: 100%;
    overflow: hidden;
    border-radius: 20px;
    position: relative;
}
.title__category{
    position: relative;
    z-index: 9; font-size: 35px;
    text-transform: uppercase;
    font-weight: 400; color: #ffffff; background-color: rgb(0,0,0,0.3); padding: 10px; border-radius: 10px
}
@media screen and (max-width: 961px){
    .title__category{
        font-size: 12px;
    }
}
</style>
