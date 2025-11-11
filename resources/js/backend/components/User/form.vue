<template>
    <div class="row">    
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                    <h3 class="card-title">{{ title }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>              
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <el-form label-position="right" :model="formData" :rules="rules" ref="formData"
                                     label-width="180px" class="demo-ruleForm">   
                                <span class="title-divider">Thông tin nhân viên</span>     
                                <el-divider></el-divider>
                                <el-form-item label="Tên nhân viên" prop="name">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập tên nhân viên"
                                                    v-model="formData.name"></el-input>
                                    </div>
                                </el-form-item>                         
                                <el-form-item label="Chức vụ/ chức danh" prop="chucvu">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập chức vụ/ chức danh"
                                                    v-model="formData.chucvu"></el-input>
                                    </div>
                                </el-form-item>     
                                <el-form-item label="Đơn vị trực thuộc" prop="donvicongtac">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập tên đơn vị trực thuộc"
                                                    v-model="formData.donvicongtac"></el-input>
                                    </div>
                                </el-form-item>                       
                                                            
                                <el-form-item label="Số điện thoại" prop="phone_number">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập số điện thoại"
                                                  v-model="formData.phone_number"></el-input>
                                    </div>
                                </el-form-item> 
                                <el-form-item label="Ghi chú" prop="note">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập ghi chú"
                                                  v-model="formData.note"></el-input>
                                    </div>
                                </el-form-item> 
                                <span class="title-divider">Thông tin đăng nhập</span>     
                                <el-divider></el-divider>                                 
                                <el-form-item label="Email" prop="email">
                                    <div class="form-group">
                                        <el-input :disabled="idUpdate!=''" validate-event placeholder="Nhập email"
                                                  v-model="formData.email"></el-input>
                                    </div>
                                </el-form-item> 
                                                          
                                <el-form-item v-if="!idUpdate" label="Password"  prop="password">
                                    <div class="form-group">
                                        <el-input show-password type="password" validate-event placeholder="Nhập password"
                                                  v-model="formData.password"></el-input>
                                    </div>
                                </el-form-item>     

                                <el-form-item v-if="!idUpdate" label="Nhập lại password"  prop="password_confirmation">
                                    <div class="form-group">
                                        <el-input show-password type="password" validate-event placeholder="Nhập lại password trùng với bên trên"
                                                  v-model="formData.password_confirmation">                                                       
                                        </el-input>
                                    </div>
                                </el-form-item>     
                                <span class="title-divider">Thông tin quyền và các thao tác hệ thống</span>    
                                <el-divider></el-divider>
                                <el-form-item label="Chọn quyền" prop="role_code">
                                    <div class="form-group">
                                        <el-select style="width: 100%" v-model="formData.role_code" size="large"
                                                   filterable 
                                                   placeholder="Chọn quyền">
                                            <el-option
                                                v-for="item in listCategoryParent"
                                                :key="item.id"
                                                :label="item.code + ' | ' + item.name"
                                                :value="item.code"
                                            >                                            
                                            </el-option>
                                        </el-select>
                                    </div>
                                </el-form-item>

                                <el-form-item label="Screen default" prop="id_module_default">
                                    <div class="form-group">
                                        <el-select v-if="listModule" style="width: 100%" v-model="formData.id_module_default" size="large"
                                                   filterable 
                                                   placeholder="Chọn màn hình mặc định vào khi đăng nhập">
                                            <el-option
                                                v-for="item in listModule"
                                                :key="item.id"
                                                :label="item.code + ' | ' + item.name"
                                                :value="item.id"
                                            >                                            
                                            </el-option>
                                        </el-select>
                                    </div>
                                </el-form-item>                               
                            </el-form>

                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: flex; justify-content: end;">
                    <el-button v-show="!idUpdate" type="success" @click="create"><i class="el-icon-plus"></i> Lưu lại
                    </el-button>
                    <el-button v-show="idUpdate" type="success" @click="update"><i class="el-icon-edit"></i> Cập nhật
                    </el-button>
                    <el-button @click="$router.push({name:'UserList'})">Đóng</el-button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import ApiService from '../../common/api.service';
import VueUploadMultipleImage from 'vue-upload-multiple-image'



export default {
    watch: {
        filterDataCategorys(val) {
            this.$refs.tree.filter(val);
        }
    },
    components: {
        VueUploadMultipleImage,
    },
    data() {
        var validatePass = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('Vui lòng không bỏ trống'));
            } else {        
                if (this.formData.password !== '') {
                    this.$refs.formData.validateField('password_confirmation');
                }
                callback();
            }
        };
        var validatePass2 = (rule, value, callback) => {    
            if (value === '') {
                callback(new Error('Vui lòng nhập lại mật khẩu'));
            } else if (value !== this.formData.password) {
                callback(new Error('Mật khẩu không trùng khớp'));
            } else {
                callback();
            }
        };
        return {
            title:'THÊM MỚI NHÂN VIÊN',           
            idUpdate: '',
            rules: {
                name: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},
                ],
                email: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},
                    {
                        type: 'email',
                        message: 'Vui lòng nhập đúng định dạng: abc@gmail.com',
                        trigger: ['blur', 'change'],
                    },
                ],               
                password: [
                    {required: true, validator: validatePass, trigger: 'blur' }
                ],
                password_confirmation: [
                    {required: true, validator: validatePass2, trigger: 'blur' }
                ],
            },
            data: [],
            filterDataCategorys: '',
            listCategoryParent: [],
            listModule: [],             
            form:new FormData(),
            formData: {
                name:'',
                email:'',
                chucvu:'',
                phone_number:'',
                note:'',
                password:'',     
                password_confirmation:'',
                donvicongtac:'',
                role_code:'',
                id_module_default:'',
            }

        }
    },
    async mounted() {
        this.title=this.$route.name=='UserUpdate'?'CẬP NHẬT THÔNG TIN NHÂN VIÊN':'THÊM MỚI NHÂN VIÊN'
        await this.getListRole()
        await this.getListModule()
        if(this.$route.params.id){
            this.idUpdate=this.$route.params.id
            await this.getDetail(this.$route.params.id)
        }
    },
    methods: {
        resetForm(formName) {            
            this.$refs[formName].resetFields();
        },
       
        async getListRole(id, update) {
            let _this = this
            ApiService.query('/api/admin/role', {params: {type: 'data'}}).then(({data}) => {
                _this.listCategoryParent = data['data']              
            })

        },
        async getListModule(id, update) {
            let _this = this
            ApiService.query('/api/admin/module', {params: {type: 'data'}}).then(({data}) => {
                _this.listModule = data['data']              
            })

        },       
        async getDetail(id) {
            let _this = this
            _this.idUpdate = id
            await axios({
                method: 'get',
                url: '/api/admin/users/detail/' + id,
            })
                .then(({data}) => {
                    if (data['success']) {
                        let res = data['data']
                        _this.formData.name = res['name']
                        _this.formData.email = res['email']
                        _this.formData.chucvu = res['chucvu']                      
                        _this.formData.note = res['note']                       
                        _this.formData.phone_number = res['phone_number']                       
                        _this.formData.donvicongtac = res['donvicongtac'] 
                        _this.formData.role_code = res['role_code']                       
                        _this.formData.id_module_default = parseInt(res['id_module_default']) 

                    }
                 
                });
           
        },
      
        appendToFormData() {
            let _this = this
            _this.form =new FormData()
            Object.keys(this.formData).forEach(key => {   
                if(this.formData[key]){
                     _this.form.set(key, this.formData[key])
                }             
               
            });          
        },
        create() {
            let _this = this
            _this.appendToFormData()          
            this.$refs['formData'].validate((valid) => {
                if (valid) {
                    axios({
                        method: 'post',
                        url: '/api/admin/users/create',
                        data: _this.form
                    })
                        .then(function (response) {
                            if (response.data['success']) {
                                _this.$notify({
                                    title: 'Success',
                                    message: response.data['mess'],
                                    type: 'success'
                                });
                                _this.resetForm('formData')
                                _this.$router.push({name:"UserList"})
                            } else {
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
        update() {
            let _this = this
            _this.appendToFormData()
            this.$refs['formData'].validate((valid) => {
                if (valid) {
                    axios({
                        method: 'post',
                        url: '/api/admin/users/update/' + _this.idUpdate,
                        data: _this.form
                    })
                        .then(function (response) {
                            if (response.data['success']) {
                                _this.$notify({
                                    title: 'Success',
                                    message: response.data['mess'],
                                    type: 'success'
                                });
                                _this.resetForm('formData')                               
                                _this.idUpdate = ''
                                _this.$router.push({name:"UserList"})
                            } else {
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
        }
    }
};
</script>

<style>
.custom-tree-node {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    padding-right: 8px;
}

.label__form {
    font-size: 13px;
}

/* .label__form::before{
  content: '+ ';
} */
.title-divider{
    font-weight: bold;
    color: rgb(0,0,0,0.6);
}
.title-divider::before{
    content: "+";
}
</style>
