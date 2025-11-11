<template>
    <div class="dashboard-contain" v-loading="loading" style="height: 100%">
        <div class="row" style="min-height: 200px">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-info">
                    <span class="info-box-icon"><i class="el-icon-notebook-1"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bookmarks</span>
                        <span class="info-box-number">0</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                        70% Increase in 30 Days
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-success">
                    <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">0</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                        70% Increase in 30 Days
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-warning">
                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Events</span>
                        <span class="info-box-number">0</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                        70% Increase in 30 Days
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-danger">
                    <span class="info-box-icon"><i class="fas fa-comments"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Comments</span>
                        <span class="info-box-number">0</span>
                        <div class="progress">
                            <div class="progress-bar" style="width:0%"></div>
                        </div>
                        <span class="progress-description">
                        70% Increase in 30 Days
                        </span>
                    </div>

                </div>
            </div>
        </div>        
    </div>
</template>

<script>

export default {
    name: "index",
    data(){
        return{
            loading:true
        }
    },
    created(){
        setTimeout(()=>{
            this.loading=false
        },500)
    }
}
</script>

<style scoped>

</style>
