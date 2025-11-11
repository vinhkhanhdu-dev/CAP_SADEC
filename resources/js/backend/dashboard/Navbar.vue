<template>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" @click="toggleSideBar()" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
<!--      <li class="nav-item d-none d-sm-inline-block">-->
<!--        <a  href="/"-->
<!--                target='_blank' class="nav-link"><i class="el-icon-s-home"></i> Trang chủ</a>-->
<!--      </li>-->
<!--      <li class="nav-item d-none d-sm-inline-block">-->
<!--        <a href="#" class="nav-link">Contact</a>-->
<!--      </li>-->
    </ul>
      <!-- <div class="breadcrumb-mobile--hidden">
          <Breadcrumb />
      </div> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <el-dropdown trigger="click"  v-if="$store.getters.user">
        <span class="el-dropdown-link">         
            <img height="40px" src="/images/no_img.jpg" class="img-circle" alt="User Image">        
        </span>
        <el-dropdown-menu slot="dropdown" style="width: 150px;">
          <el-dropdown-item>            
                <div style="display: flex; justify-content: center;">
                  <span style="font-weight: bold; font-size: 16px;">{{ $store.getters.user.name }}</span>
                </div>
                <div style="display: flex; justify-content: center;">                 
                  <span style="font-size: 12px;" v-if="$store.getters.user.roles">{{ $store.getters.user.roles[0] }}</span>
                </div>          
          </el-dropdown-item>   
          <el-divider class="mt-1 mb-1"></el-divider>
          <el-dropdown-item>
            <a @click="logout">
                <i class="fas fa-user"></i>
                My profile
            </a>            
          </el-dropdown-item>
          <el-divider class="mt-1 mb-1"></el-divider>      
          <el-dropdown-item>
            <a @click="logout">
                <i class="fas fa-cog"></i>
                Setting
            </a>
          </el-dropdown-item>    
          <el-divider class="mt-1 mb-1"></el-divider>   
          <el-dropdown-item>
            <a @click="logout">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
          </el-dropdown-item>
        </el-dropdown-menu>
     </el-dropdown>
    </ul>
  </nav>
  <!-- /.navbar -->
</template>

<script>
import Breadcrumb from "./Breadcrumb";
import { LOGOUT } from '../../store/muation-types';
import { mapGetters } from 'vuex';
export default {
    components:{Breadcrumb},
    methods: {
        toggleSideBar(){
          this.$store.dispatch('app/toggleSideBar')
        },
        logout() {
            this.$confirm('Bạn có muốn đăng xuất khỏi hệ thống?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Không đồng ý',
                type: 'warning'
            }).then(() => {
                this.$store.dispatch(`user/${LOGOUT}`).then(() => {
                    this.$router.push({name: 'CheckFile'});
                });
            }).catch(() => {

            });

        },
    }, 

}
</script>

<style>
 @media only screen and (max-width: 1200px) {
     .breadcrumb-mobile--hidden{
        display: none;
     }
 }
</style>
