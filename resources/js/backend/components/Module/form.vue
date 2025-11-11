<template>
    <div class="row">    
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                    <h3 class="card-title">MODULE DETAIL</h3>
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
                                     label-width="120px" class="demo-ruleForm">        
                                <el-form-item label="Mã module" prop="code">
                                    <div class="form-group">
                                        <el-input :disabled="true" validate-event placeholder="Nhập tên danh mục"
                                                    v-model="formData.code"></el-input>
                                    </div>
                                </el-form-item>                         
                                <el-form-item label="Tên module" prop="name">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập tên danh mục"
                                                  v-model="formData.name"></el-input>
                                    </div>
                                </el-form-item>                              
                                                          
                                <el-form-item label="Class" prop="class">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập tên danh mục"
                                                  v-model="formData.class"></el-input>
                                    </div>
                                </el-form-item>     

                                <el-form-item label="Path" prop="path">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập đường dẫn"
                                                  v-model="formData.path"></el-input>
                                    </div>
                                </el-form-item>                              
                                                          
                                <el-form-item label="Alias" prop="alias">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập alias"
                                                  v-model="formData.alias"></el-input>
                                    </div>
                                </el-form-item>                              
                                                          

                                <el-form-item label="Module cha" prop="id_parent">
                                    <div class="form-group">
                                        <el-select style="width: 100%" v-model="formData.id_parent" size="large"
                                                   filterable 
                                                   placeholder="Chọn danh mục cha">
                                            <el-option
                                                v-for="item in listCategoryParent"
                                                :key="item.id"
                                                :label="item.code + ' | ' + item.name"
                                                :value="item.id"
                                            >                                            
                                            </el-option>
                                        </el-select>
                                    </div>
                                </el-form-item>

                                <el-form-item label="Type" prop="type">
                                    <div class="form-group">
                                        <el-select style="width: 100%" v-model="formData.type" size="large"
                                                   filterable 
                                                   placeholder="Chọn loại module">
                                            <el-option
                                                v-for="item in listCategoryParent"
                                                :key="item.id"
                                                :label="item.code + ' | ' + item.name"
                                                :value="item.id"
                                            >                                            
                                            </el-option>
                                        </el-select>
                                    </div>
                                </el-form-item>


                                <el-form-item label="Icon" prop="icon">
                                    <div class="form-group">                                
                                        <el-input v-model="formData.icon"
                                                  placeholder="Nhập icon có dạng fa fa-nameicon"></el-input>
                                    </div>
                                </el-form-item>

                                <el-form-item label="Index" prop="index">
                                    <div class="form-group">                                
                                        <el-input v-model="formData.index"
                                                  placeholder="Nhập index" type="number"></el-input>
                                    </div>
                                </el-form-item>

                                <el-form-item label="Hiển thị/ ẩn" prop="status">
                                    <div class="form-group">
                                        <el-switch
                                            active-value="1"
                                            inactive-value="0"
                                            v-model="formData.status"
                                            active-color="#13ce66"
                                            inactive-color="#ff4949">
                                        </el-switch>
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
                    <el-button @click="$router.push({name:'ModuleList'})">Đóng</el-button>
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
        return {
            images:[],
            idUpdate: '',
            rules: {
                name: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},
                ],
                path: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'change'},
                ],
            },
            data: [],
            filterDataCategorys: '',
            listCategoryParent: [],
            defaultProps: {
                children: 'children',
                label: 'label'
            },
            options: [{
                value: 1,
                label: 'Level 1'
            }, {
                value: 2,
                label: 'Level 2',
            }, {
                value: 3,
                label: 'Level 3'
            }, {
                value: 4,
                label: 'Level 4'
            }, {
                value: 5,
                label: 'Level 5'
            }],
            form:new FormData(),
            formData: {
                code:'',
                name:'',
                id_parent:'',     
                index:'',
                alias:'',
                class:'',
                icon:'',
                path:'',
                type:'',
                status:"1"
            }

        }
    },
    mounted() {
        this.getDataParent()
        if(this.$route.params.id){
            this.idUpdate=this.$route.params.id
            this.getDetail(this.$route.params.id)
        }else{
            this.genCode()
            
        }
    },
    methods: {
        resetForm(formName) {
            this.images=[]
            this.$refs[formName].resetFields();
        },
       
        async getDataParent(id, update) {
            let _this = this
            ApiService.query('/api/admin/module', {params: {type: 'data'}}).then(({data}) => {
                _this.listCategoryParent = data['data']
                console.log(data);
            })

        },
        async genCode() {
            let _this = this
            ApiService.query('/api/admin/module/gen_code').then(({data}) => {
                _this.formData.code = data
            })
        },
        async getDetail(id) {
            let _this = this
            _this.listCategoryParent = []
            _this.idUpdate = id
            let idParent

            await axios({
                method: 'get',
                url: '/api/admin/module/detail/' + id,
            })
                .then(({data}) => {
                    if (data['success']) {
                        let res = data['data']
                        _this.formData.code = res['code']
                        _this.formData.name = res['name']
                        _this.formData.class = res['class']
                        _this.formData.id_parent = res['id_parent']
                        _this.formData.icon = res['icon']                       
                        _this.formData.path = res['path']                       
                        _this.formData.alias = res['alias']                       
                        _this.formData.type = res['type']                       
                        _this.formData.index = res['index']                       
                        _this.formData.status = res['status'].toString()
                    }
                });
            await _this.getDataParent(idParent, true)

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
                        url: '/api/admin/module/create',
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
                                _this.$router.push({name:"ModuleList"})
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
                        url: '/api/admin/module/update/' + _this.idUpdate,
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
                                _this.$router.push({name:"ModuleList"})
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
</style>
