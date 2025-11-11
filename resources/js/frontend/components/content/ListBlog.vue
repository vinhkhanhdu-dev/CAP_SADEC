<template>
    <div class="content__blog" v-loading="loading">
        <div class="banner_blog">
            <img class="image__blog" src="/img/Banner/blog.jpg"/>
        </div>
        <div class="homepage-search">
            <div class="container container--medium">
                <div class="homepage-search__wrapper">
                    <el-input type="text" name="keyword" v-model="keyword"
                              placeholder="Hãy thử bắt đầu với &quot;Quần đen&quot; xem sao"
                              @keyup.enter.native="getListDataBlog()"
                              rel-script="spotlight-search-control-home"
                              class="input-search"
                    >
                        <template v-slot:suffix>
                            <i class="el-icon-search"
                               style="font-size: 20px; padding-top: 15px; padding-right: 15px"></i>
                        </template>
                    </el-input>
                </div>
            </div>
        </div>
        <section class="blogs-listings">
            <div class="container container--medium">
                <div class="blogs-listings__heading" v-if="dataBlog.length>0">
                    Bài mới mỗi ngày
                </div>
                <div class="grid">
                    <div class="grid__column four-twelfths mobile--one-whole" v-for="item in dataBlog">
                        <div class="article-grid article-grid--listing" @click="$router.push({name:'blog-detail',params:{id:item['id']}})">
                            <div class="article-grid__thumbnail" style="height: 250px; width: 100%;background-color: rgba(154,154,154,0.11)"><a
                               ><img style="width: 100%; height: 100% ;object-fit: cover; position: center; border-radius: 20px"
                                :src="item['image']"
                                ></a></div>
                            <div class="article-grid__content"><h3 class="article-grid__title"><a
                               >
                               {{item['title']}}
                            </a></h3> <span class="article-grid__infomations"><a
                                >{{item['hastag']}}</a> | {{item['created_at']|formatDate}}
                                    </span>
                                <p class="article-grid__description">
                                    Hãy đọc tiếp bài viết dưới đây và cùng HaDoVn khám phá xem các trend hiện đang
                                    được giới trẻ yêu thích sử dụng nhất nhé.
                                </p></div>
                        </div>
                    </div>
                    <div class="article-load-more-container" v-if="dataBlog && dataBlog.length< countData">
                        <a class="article-load-more" @click="PageLimit = PageLimit+10 ; getListDataBlog()">
                        Xem thêm
                    </a> </div>
                </div>
                <div v-if="dataBlog.length == 0" style="text-align: center;margin-bottom: 20px;">
                    <span>Không tìm thấy bài viết phù hợp theo yêu cầu của bạn!</span>
                    <br>
                    <span>
                        Vui lòng <a @click="$router.push({ name: 'home' })" style="font-weight: bold; text-decoration: underline;">quay
                            lại</a> để tiếp tục mua sắm bạn nhé!
                    </span>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    import ApiService from "../../../backend/common/api.service";

    export default {
        name: "ListBlog",
        data(){
            return {
                dataBlog:[],
                countData:0,
                keyword:'',
                loading:false,
                PageLimit:10
            }
        },
        mounted(){
          this.getListDataBlog()
        },
        methods:{
            getListDataBlog(){
                let params={
                    Page:1,
                    PageLimit:this.PageLimit,
                }
                this.keyword &&(params.TextSearch=this.keyword)
                this.loading=true
                ApiService.query('/api/admin/blogs',{params:params}).then(({data})=>{
                    if(data['success']){
                        this.dataBlog = data['data']
                        this.countData = data['count']
                    }
                    this.loading=false
                })
            }
        }
    }
</script>

<style>
    .input-search .el-input__inner {
        border-radius: 50px !important;
        height: 50px;
    }

    .blogs-listings__heading {
        margin-top: 5px;
        padding: 10px 0 10px 20px;
        background: #2f5acf;
        border-radius: 10px;
        font-size: 30px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 1em;
    }

    .article-load-more {
        background-color: #2f5acf !important;
        padding: 12px 40px;
        border: none !important;
    }

    .article-load-more:hover, .btn:hover {
        color: #000;
        background-color: #d9d9d9 !important;
        border: 2px solid #d9d9d9;
    }

    .article-load-more, .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        height: 40px;
        border-radius: 16px;
        border: 2px solid #000;
        background-color: #000;
        color: #fff;
        padding: 0 30px;
        transition: all .2s;
        cursor: pointer;
    }

    .article-load-more-container {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

</style>
