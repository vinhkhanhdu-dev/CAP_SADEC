<template>
    <section class="homepage-search">
        <div class="container container--medium">
            <div class="homepage-search__wrapper">
                <h2 class="homepage-search__heading">Bạn tìm gì hôm nay?</h2>
                <!-- <div class="homepage-search__inner"> -->
                   <el-input type="text" name="keyword" v-model="keyword"
                          placeholder="Hãy thử bắt đầu với &quot;Quần đen&quot; xem sao"
                          @keyup.enter.native="$router.push({name:'list-product',query:{keyword:keyword}})"
                          rel-script="spotlight-search-control-home"
                          class="input-search"
                         />
                <!-- </div> -->
                <div class="homepage-search__content">
                    <p class="homepage-search__description">Hãy thử tìm bất kỳ từ khoá nào nhé. hadovn gợi ý nè:</p>
                    <div class="homepage-search__buttons"><a href="#" rel-script="homepage-search-button" class="homepage-search__button">áo thun</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">hoodie</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">oversize</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">cm24</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">promax</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "HomePageSearch",
        data(){
            return{
                keyword:''
            }
        }
    }
</script>

<style>
    .input-search .el-input__inner{
        border-radius: 50px !important;
        height: 50px;
    }
</style>
