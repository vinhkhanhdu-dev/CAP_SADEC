<template>    
    <div class="form_product_color">
       <div style="margin-top: -30px">
           <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">{{title}}</span>
           <el-divider></el-divider>
       </div>
        <el-form :model="form"  ref="form" label-width="150px" class="demo-ruleForm">
            <el-form-item :rules="requiredForm" label="Mã kỳ thi" prop="maKyThi">
                <el-input disabled v-model="form.maKyThi"></el-input>
            </el-form-item>
            <el-form-item :rules="requiredForm" label="Tên kỳ thi" prop="tenKyThi">
                <el-input v-model="form.tenKyThi"></el-input>
            </el-form-item>           
            <el-form-item :rules="requiredForm" label="Chi tiết kỳ thi" prop="thongTinChiTiet">
                <el-input type="textarea" v-model="form.thongTinChiTiet"></el-input>
            </el-form-item>
            <el-form-item :rules="requiredForm" label="Ghi chú" prop="ghiChu">
                <el-input type="textarea" v-model="form.ghiChu"></el-input>
            </el-form-item>
        </el-form>
        <div style="display: flex; justify-content: end">
            <el-button type="primary" @click="submit">Lưu lại</el-button>
            <el-button @click="$refs.form.resetFields()">Reset Form</el-button>
        </div>
    </div>
</template> 
<script>
    import ApiService from '../../common/api.service'
    export default {
        name: "create_update",
        props:['resID','trigger'],
        data(){
            return {
                title:'',
                form:{
                    maKyThi:'',
                    tenKyThi:'',               
                    thongTinChiTiet:'',
                    ghiChu:'',
                },
                requiredForm: { required: true, message: 'Vui lòng không bỏ trống!', trigger: 'blur' }
            }
        },
        mounted() {
            if(this.resID){
                this.title='Cập nhật thông tin kỳ thi'
                this.getDetail(this.resID)
            }else {
                this.title='Thêm mới thông tin kỳ thi'
                this.$refs.form.resetFields()
                this.genCode()
            }
        },
        watch:{
            trigger(e){
                if(this.resID){
                    this.title='Cập nhật thông tin kỳ thi'
                    this.getDetail(this.resID)
                }else {
                    this.title='Thêm mới thông tin kỳ thi'
                    this.$refs.form.resetFields()
                    this.genCode()
                }
            }
        },
        methods:{
            async genCode() {
                let _this = this
                ApiService.query('/api/admin/danhsachkythi/gen_code').then(({data}) => {
                    _this.form.maKyThi = data
                })
            },
            submit(){
                let _this= this
                let url
                url = this.resID?('/api/admin/danhsachkythi/update/'+this.resID):'/api/admin/danhsachkythi/create'
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        axios({
                            method: 'post',
                            url: url,
                            data: this.form
                        })
                            .then(function (response) {
                                if(response.data['success']){
                                    _this.$notify({
                                        title: 'Success',
                                        message: response.data['mess'],
                                        type: 'success'
                                    });

                                    _this.$emit('success')
                                    _this.$refs.form.resetFields()
                                }else{
                                    _this.$notify({
                                        title: 'Error',
                                        message: response.data['mess'],
                                        type: 'error'
                                    });
                                }

                            });
                    } else {
                        return false;
                    }
                });
            },
            async getDetail(id){
                let _this = this
                await axios({
                    method: 'get',
                    url: '/api/admin/danhsachkythi/detail/'+id,
                })
                    .then(({data})=> {
                        if(data['success']){
                            let res = data['data']
                            _this.form.maKyThi = res['maKyThi']
                            _this.form.tenKyThi = res['tenKyThi']
                            _this.form.thongTinChiTiet = res['thongTinChiTiet']
                            _this.form.ghiChu = res['ghiChu']                       
                        }
                    });

            },
        }
    }
</script>

<style scoped>

</style>
