<template>
    <div class="article-single" v-loading="loading">
        <div class="article-detail-header">
            <div class="container container--medium">
                <div class="breadcrumb" style="padding-bottom: 10px;">
                    <ol class="page-breadcrumb breadcrumb__list">
                        <li><a @click="$router.push({name:'home'})" class="breadcrumb__item">Trang chủ</a></li>
                        <li><a @click="$router.push({name:'list-blog'})" class="breadcrumb__item">Blog</a></li>
                        <li><a class="breadcrumb__item">{{dataDetail['title']}}</a></li>
                    </ol>
                </div>
                <div class="article-detail-header__inner">
                    <div class="article-detail-header__content">
                        <div data-id="6422c07bb721500ede02babc" class="article-detail-header__title"><h1>{{dataDetail['title']}}</h1></div>
                        <div class="article-detail-header__description">
                            <p>
                               Hastag: {{dataDetail['hastag']}}
                            </p>
                        </div>
                        <div class="article-detail-header__date"><p class="time" style="color: rgba(0, 0, 0, 0.533);">
                            Ngày đăng: <span>{{dataDetail['created_at']|formatDate}}</span></p></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container container--medium" v-html="dataDetail['description']"></div>
    </div>
</template>

<script>
    import ApiService from "../../../backend/common/api.service";

    export default {
        name: "BlogDetail",
        data(){
            return  {
                dataDetail:'',
                loading:false
            }
        },
        mounted(){
          if(this.$route.params.id){
              this.getDataDetail()
          }else {
              this.$router.push({name:'list-blog'})
          }
        },
        methods:{
            getDataDetail(){
                this.loading=true
                ApiService.query('/api/admin/blogs/detail/'+this.$route.params.id).then(({data})=>{
                    if(data['success']){
                        this.dataDetail = data['data']
                    }else {
                        this.$router.push({name:'list-blog'})
                    }
                    this.loading=false
                })
            }
        }

    }
</script>

<style scoped>
    .article-single{
        margin-top: 10px;
    }
</style>
