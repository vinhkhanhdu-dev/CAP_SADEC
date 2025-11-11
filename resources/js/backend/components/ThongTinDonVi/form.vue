<template>    
    <div class="form_product_color">
       <div style="margin-top: -30px">
           <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">{{title}}</span>
           <el-divider></el-divider>
       </div>
        <el-form :model="form"  ref="form" label-width="150px" class="demo-ruleForm">
            <el-form-item :rules="requiredForm" label="Mã đơn vị" prop="maDonVi">
                <el-input disabled v-model="form.maDonVi"></el-input>
            </el-form-item>
            <el-form-item :rules="requiredForm" label="Tên đơn vị" prop="tenDonVi">
                <el-input v-model="form.tenDonVi"></el-input>
            </el-form-item>           
            <el-form-item :rules="requiredForm" label="Chi tiết đơn vị" prop="thongTinChiTiet">
                <el-input type="textarea" v-model="form.thongTinChiTiet"></el-input>
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
                    maDonVi:'',
                    tenDonVi:'',               
                    thongTinChiTiet:''
                },
                requiredForm: { required: true, message: 'Vui lòng không bỏ trống!', trigger: 'blur' }
            }
        },
        mounted() {
            if(this.resID){
                this.title='Cập nhật thông tin đơn vị'
                this.getDetail(this.resID)
            }else {
                this.title='Thêm mới thông tin đơn vị'
                this.$refs.form.resetFields()
                this.genCode()
            }
        },
        watch:{
            trigger(e){
                if(this.resID){
                    this.title='Cập nhật thông tin đơn vị'
                    this.getDetail(this.resID)
                }else {
                    this.title='Thêm mới thông tin đơn vị'
                    this.$refs.form.resetFields()
                    this.genCode()
                }
            }
        },
        methods:{
            async genCode() {
                let _this = this
                ApiService.query('/api/admin/thongtindonvi/gen_code').then(({data}) => {
                    _this.form.maDonVi = data
                })
            },
            submit(){
                let _this= this
                let url
                url = this.resID?('/api/admin/thongtindonvi/update/'+this.resID):'/api/admin/thongtindonvi/create'
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
                    url: '/api/admin/thongtindonvi/detail/'+id,
                })
                    .then(({data})=> {
                        if(data['success']){
                            let res = data['data']
                            _this.form.maDonVi = res['maDonVi']
                            _this.form.tenDonVi = res['tenDonVi']
                            _this.form.tenDonViEN = res['tenDonViEN']
                            _this.form.thongTinChiTiet = res['thongTinChiTiet']                       
                        }
                    });

            },
        }
    }
</script>

<style scoped>

</style>
