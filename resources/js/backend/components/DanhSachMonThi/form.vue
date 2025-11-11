<template>    
    <div class="form_product_color">
       <div style="margin-top: -30px">
           <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">{{title}}</span>
           <el-divider></el-divider>
       </div>
        <el-form :model="form"  ref="form" label-width="150px" class="demo-ruleForm">
            <el-form-item :rules="requiredForm" label="Mã môn thi" prop="maMonHoc">
                <el-input disabled v-model="form.maMonHoc"></el-input>
            </el-form-item>
            <el-form-item :rules="requiredForm" label="Tên môn thi" prop="tenMonHoc">
                <el-input v-model="form.tenMonHoc"></el-input>
            </el-form-item>           
            <el-form-item :rules="requiredForm" label="Hình thức thi" prop="hinhThucThi">
                <el-input v-model="form.hinhThucThi"></el-input>
            </el-form-item>           
            <el-form-item :rules="requiredForm" label="Chi tiết môn thi" prop="thongTinChiTiet">
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
                    maMonHoc:'',
                    tenMonHoc:'',      
                    hinhThucThi:'',     
                    thongTinChiTiet:'',
                    ghiChu:'',
                },
                requiredForm: { required: true, message: 'Vui lòng không bỏ trống!', trigger: 'blur' }
            }
        },
        mounted() {
            if(this.resID){
                this.title='Cập nhật thông tin môn thi'
                this.getDetail(this.resID)
            }else {
                this.title='Thêm mới thông tin môn thi'
                this.$refs.form.resetFields()
                this.genCode()
            }
        },
        watch:{
            trigger(e){
                if(this.resID){
                    this.title='Cập nhật thông tin môn thi'
                    this.getDetail(this.resID)
                }else {
                    this.title='Thêm mới thông tin môn thi'
                    this.$refs.form.resetFields()
                    this.genCode()
                }
            }
        },
        methods:{
            async genCode() {
                let _this = this
                ApiService.query('/api/admin/danhsachmonthi/gen_code').then(({data}) => {
                    _this.form.maMonHoc = data
                })
            },
            submit(){
                let _this= this
                let url
                url = this.resID?('/api/admin/danhsachmonthi/update/'+this.resID):'/api/admin/danhsachmonthi/create'
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
                    url: '/api/admin/danhsachmonthi/detail/'+id,
                })
                    .then(({data})=> {
                        if(data['success']){
                            let res = data['data']
                            _this.form.maMonHoc = res['maMonHoc']
                            _this.form.tenMonHoc = res['tenMonHoc']
                            _this.form.hinhThucThi = res['hinhThucThi']
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
