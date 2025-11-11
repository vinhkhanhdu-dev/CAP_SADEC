<template>
    <div class="main-login">
        <div class="login-box">
            <!-- /.login-logo -->
            <!-- <div style="display: flex; justify-content: center; padding-top: 10px">
                <img style="width: 200px; height: auto;" src="/images/logo.webp"/>
            </div> -->
            <div style="margin-top: 20px; background-color: unset; line-height: 25px;" class="login-logo">
                <!-- <a style="color: #ee4d2d; font-size: 23px; font-weight: bold;" href="/"><b>HỆ THỐNG SẮP PHÒNG THI</b> </a> -->
                <br>
                <!-- <a style="color: #ee4d2d; font-size: 20px; text-transform: uppercase; font-weight: bold" href="/"><b>Trường Trung Cấp Nghề Tân Hiệp Tỉnh Kiên Giang</b></a> -->
            </div>
            <div style="background-color: unset" class="card-body login-card-body">
                <el-form label-position="right" status-icon :model="formData" :rules="rules" ref="formData" class="demo-ruleForm">
                    <el-form-item :inline-message="true" prop="email">
                        <div class="form-group">
                            <el-input type="email" validate-event placeholder="Email" v-model="formData.email">
                                <i slot="prefix" class="el-input__icon el-icon-message"></i>
                            </el-input>
                        </div>
                    </el-form-item>
                    <el-form-item :inline-message="true" prop="password">
                        <div class="form-group">
                            <el-input show-password  validate-event placeholder="Password" type="password" v-model="formData.password">
                                <i slot="prefix" class="el-input__icon el-icon-lock"></i>
                            </el-input>
                        </div>
                    </el-form-item>
                </el-form>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <el-button style="background: #ee4d2d; color: #fff;text-transform: uppercase; width: 100%; height: 40px;" :loading="loading" @click="login()">Đăng nhập</el-button>
                    </div>
                    <div class="col-12 mt-2">
                        <el-button style="background: rgb(0,0,0,0.5); color: #fff;text-transform: uppercase; width: 100%; height: 40px;" >Đăng ký</el-button>
                    </div>
                   
                </div
                <div class="mt-2" style="width:100%; display:flex; justify-content: center">
                    <a href="/" style="color: #ee4d2d">
                        <i class="el-icon-s-home"></i>  Return to home
                    </a>
                </div>
             


            </div>

             <!-- /.login-box -->
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { LOGIN } from '../../../store/muation-types';
// import LangSelect from '@/components/LangSelect';
export default {
    name: "login",
    data(){
        return{
            rules: {
                email: [
                    { required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur' },
                    // { min: 3, max: 5, message: 'Length should be 3 to 5', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur' },
                ],
            },
            formData:{
                email:'',
                password:'',
            },
            loading:false
        }
    },
    methods:{
        login() {
            this.$refs['formData'].validate(valid => {
                if (valid) {
                    this.loading=true
                    this.$store
                        .dispatch(`user/${LOGIN}`, this.formData)
                        .then(() => {
                            this.loading = false;                         
                            this.$router.replace(
                                {
                                    path: this.redirect || this.$store.state.settings.redirect,
                                    query: this.otherQuery,
                                },
                                onAbort => {}
                            );
                        })
                        .catch(() => {
                            this.loading = false;
                        });
                } else {
                    this.loading = false;
                    return false;
                }
            });
        }
    },
    computed:{
        ...mapGetters(['user', 'lang']),
    }
}
</script>

<style>
    .main-login{
        /* padding-left: 20px; */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #2d3a4b;
        /* background-image: url('/img/bg.jpg'); */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh
    }
    .login-box{
        background-color: rgb(255,255,255,0.9);                
        /* background-color: rgb(0,0,0, 0.6); */
        box-shadow: -16px 18px 0px 5px rgba(222,222,222,0.08);
        -webkit-box-shadow: -16px 18px 0px 5px rgba(222,222,222,0.08);
        -moz-box-shadow: -16px 18px 0px 5px rgba(222,222,222,0.08);
        width: 400px;
        /* height:100vh; */
        border-radius: 0px 50px 50px 0px;
    }
</style>
