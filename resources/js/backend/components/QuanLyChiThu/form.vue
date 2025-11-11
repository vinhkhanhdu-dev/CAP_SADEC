    <template>    
        <div class="form_product_color">
        <div style="margin-top: -30px">
            <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">{{title}}</span>
            <el-divider></el-divider>
        </div>
            <el-form :model="form"  ref="form" label-width="150px" class="demo-ruleForm">
                <el-form-item disabled :rules="requiredForm" label="Mã" prop="code">
                    <el-input type="input" v-model="form.code" disabled></el-input>
                </el-form-item><el-form-item disabled :rules="requiredForm" label="Tên công việc" prop="tencongviec">
                    <el-input type="input" v-model="form.tencongviec" ></el-input>
                </el-form-item><el-form-item disabled :rules="requiredForm" label="Số tiền đã chi" prop="sotienchi">
                    <el-input type="input" v-model="form.sotienchi" ></el-input>
                </el-form-item><el-form-item disabled :rules="requiredForm" label="Số tiền đã thu" prop="sotienthu">
                    <el-input type="input" v-model="form.sotienthu" ></el-input>
                </el-form-item><el-form-item disabled :rules="requiredForm" label="Tỉ lệ chênh lệch" prop="chenhlech">
                    <el-input type="input" v-model="form.chenhlech" ></el-input>
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
                        code:'',
                        tencongviec:'',
                        sotienchi:'',
                        sotienthu:'',
                        chenhlech:'',
                        
                    },
                    requiredForm: { required: true, message: 'Vui lòng không bỏ trống!', trigger: 'blur' }
                }
            },
            mounted() {
                if(this.resID){
                    this.title='Cập nhật thông tin chi thu'
                    this.getDetail(this.resID)
                }else {
                    this.title='Thêm mới thông tin chi thu'
                    this.$refs.form.resetFields()
                    this.genCode()
                }
            },
            watch:{
                trigger(e){
                    if(this.resID){
                        this.title='Cập nhật thông tin chi thu'
                        this.getDetail(this.resID)
                    }else {
                        this.title='Thêm mới thông tin chi thu'
                        this.$refs.form.resetFields()
                        this.genCode()
                    }
                }
            },
            methods:{
                async genCode() {
                    let _this = this
                    ApiService.query('/api/admin/nhatkychithu/gen_code').then(({data}) => {
                        _this.form.code = data
                    })
                },
                submit(){
                    let _this= this
                    let url
                    url = this.resID?('/api/admin/nhatkychithu/update/'+this.resID):'/api/admin/nhatkychithu/create'
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
                        url: '/api/admin/nhatkychithu/detail/'+id,
                    })
                        .then(({data})=> {
                            if(data['success']){
                                let res = data['data']
                                _this.form.code = res['code']
                                _this.form.tencongviec = res['tencongviec']
                                _this.form.sotienchi = res['sotienchi']
                                _this.form.sotienthu = res['sotienthu']
                                _this.form.chenhlech = res['chenhlech']
                                                       
                            }
                        });

                },
            }
        }
    </script>

    <style scoped>

    </style>

