<template>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="/images/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
      <!-- <span class="brand-text font-weight-light">{{$appSetting.NAME}}</span> -->
       <a class="brand-text font-weight-light" style="color: #fff; font-size: 18px;" href="/"><b>DEV TOOL</b> </a>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/images/no_img.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $store.getters.user.name }}</a>
        </div>
      </div> -->
    <el-menu
      :router="true"
      v-if="!loading && data.length>0"
      :default-active="active"
      :collapse="$store.getters.sidebar.opened"
      class="el-menu-vertical-demo"
      background-color="#343a40"
      text-color="#fff"
      style="border-right: none;"
      active-text-color="#ffd04b">
      <template v-for="item in data">
        <component :route="{path:item.path}"
        v-if="ListModule.includes(item.code) || $store.getters.user.name=='admin'" :index="item.path" :is="item.children.length > 0? 'el-submenu':'el-menu-item'">
         <i v-if="item.children.length == 0" :class="item.icon?item.icon:'el-icon-setting'"></i>
          <template slot="title">
            <i v-if="item.children.length > 0" :class="item.icon?item.icon:'el-icon-setting'"></i>
            <span >{{ item.name }}</span>
          </template>
            <component  :route="{path:item2.path}"
            v-if="ListModule.includes(item2.code) || $store.getters.user.name=='admin'" :key="item2.id" :index="item2.path"  v-for="item2 in item.children"
            :is="item2.children.length > 0? 'el-submenu':'el-menu-item'">
            <template slot="title">
                <i :class="item2.icon?item2.icon:'el-icon-setting'"></i>
                <span>{{ item2.name }}</span>
              </template>
                <component :route="{path:item3.path}"
                v-if="ListModule.includes(item3.code) || $store.getters.user.name=='admin'" :key="item3.id" :index="item3.path" v-for="item3 in item2.children"
                :is="item3.children.length > 0? 'el-submenu':'el-menu-item'">
                <template slot="title">
                  <i :class="item3.icon?item3.icon:'el-icon-setting'"></i>
                  <span >{{ item3.name }}</span>
                </template>
              </component>
            </component>
        </component>
      </template>
    </el-menu>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

  </aside>
</template>

<script>
import ApiService from '../common/api.service'
export default {
  mounted() {
     this.$store.getters.sidebar.opened  &&  this.$store.dispatch('app/toggleSideBar')
     this.getList()
     if(this.$store.getters.user && this.$store.getters.user.ListModule){
        this.ListModule =(this.$store.getters.user.ListModule[0]);
     }
     
  },
  watch:{
    $route(to, from) {
      console.log(`Route changed from ${from.path} to ${to.path}`)
    }
  },
  data(){
    return{
      data:[],
      ListModule:[],
      loading:false,
      active:'',
    }
  },
  methods:{
    getList() {
        let _this = this
        this.loading=true
        ApiService.query('/api/admin/module', {params: {type: 'treeData'}}).then(({data}) => {
            _this.data = data['data']
            _this.loading = false
            _this.active = _this.$route.path
        })
    },
  }

}
</script>

<style>
.el-menu-item.is-active{
  background-color: #4f5962 !important;
}
.sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand).sidebar-focused, .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover {
   width: 75px;
}
.sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .brand-text{
  visibility: hidden;
}
.sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .user-panel>.info{
  visibility: hidden;
}

</style>
