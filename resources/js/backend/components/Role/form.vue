<template>
    <div class="row">    
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                    <h3 class="card-title">ROLE DETAIL</h3>
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
                                <el-form-item label="Mã role" prop="code">
                                    <div class="form-group">
                                        <el-input :disabled="true" validate-event placeholder="Nhập tên danh mục"
                                                    v-model="formData.code"></el-input>
                                    </div>
                                </el-form-item>                         
                                <el-form-item label="Tên role" prop="name">
                                    <div class="form-group">
                                        <el-input validate-event placeholder="Nhập tên role"
                                                  v-model="formData.name"></el-input>
                                    </div>
                                </el-form-item>    

                                <el-form-item label="Role cha" prop="id_parent">
                                    <div class="form-group">
                                        <el-select style="width: 100%" v-model="formData.id_parent" size="large"
                                                   filterable 
                                                   placeholder="Chọn role cha">
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
                            </el-form>
                            <el-divider content-position="left">CHI TIẾT QUYỀN</el-divider>
                            <el-form label-position="right" :inline-message="true" :show-message="false" label-width="120px" >  
                            <!-- <div v-for="item in listModule" :key="item.id">
                                <el-form-item >
                                    <el-checkbox-group v-model="formData.ListModule">  
                                    <div style="font-weight: bold;"> 
                                        <el-checkbox :value="item.code" :label="item.code">
                                            {{ item.name }}
                                        </el-checkbox> 
                                    </div>
                                    </el-checkbox-group>                                  
                                    <el-checkbox-group v-model="formData.ListAction">                
                                        <div style="padding-left: 25px; border: 1px dotted rgb(0, 0, 0, 0.2); border-radius: 5px;" v-if="item.action" >                                   
                                            <el-checkbox v-for="action in item.action" :key="action.id" :label="action.code">  {{ action.name }} </el-checkbox>     
                                        </div>
                                     </el-checkbox-group>
                                </el-form-item>
                            </div> -->
                            <el-form-item >
                            <div class="row" style="display: flex; flex-wrap: nowrap;">
                                <el-input
                                    placeholder="Nhập kí tự cần tìm kiếm..."
                                    v-model="filterDataCategorys">
                                </el-input>
                            </div>
                            <el-divider></el-divider>
                            <el-tree
                                ref="tree"
                                empty-text="Không tìm thấy !"
                                :filter-node-method="filterNode"
                                v-show="listModule"
                                :data="listModule"
                                :show-checkbox="false"
                                node-key="id"                                
                                default-expand-all
                                class="tree-role"
                                :expand-on-click-node="false">
                                <span class="custom-tree-node" slot-scope="{ node, data }">                                  
                                    <el-checkbox-group v-model="formData.ListModule">  
                                    <div style="font-weight: bold;"> 
                                        <el-checkbox :value="data.code" :label="data.code">
                                            {{ data.name }}
                                        </el-checkbox> 
                                    </div>
                                    </el-checkbox-group>                                  
                                    <el-checkbox-group v-model="formData.ListAction">                
                                        <div v-if="data.action" >                                   
                                            <el-checkbox v-for="action in data.action" :key="action.id" :label="action.code">  {{ action.name }} </el-checkbox>     
                                        </div>
                                     </el-checkbox-group>
                                </span>
                            </el-tree>
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
                    <el-button @click="$router.push({name:'RoleList'})">Đóng</el-button>
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
        },     
    },
    components: {
        VueUploadMultipleImage,
    },
    data() {
        return {
            checkAll:false,
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
                ListModule:[],
                ListAction:[],
            },
            listModule:[],
            isIndeterminate: true

        }
    },
    mounted() {
        this.getDataParent()
        this.getListModule()
        if(this.$route.params.id){
            this.idUpdate=this.$route.params.id
            this.getDetail(this.$route.params.id)
        }else{
            this.genCode()            
        }
    },
    methods: {        
        filterNode(value, data) {
            if (!value) return true;
            return data.name.indexOf(value) !== -1;
        },    
        getListModule() {
            let _this = this          
            ApiService.query('/api/admin/module', {params: {type: 'treeData'}}).then(({data}) => {
                _this.listModule = data['data']
            })
        },   
        resetForm(formName) {
            this.images=[]
            this.$refs[formName].resetFields();
        },
       
        async getDataParent(id, update) {
            let _this = this
            ApiService.query('/api/admin/role', {params: {type: 'data'}}).then(({data}) => {
                _this.listCategoryParent = data['data']
       
            })

        },
        async genCode() {
            let _this = this
            ApiService.query('/api/admin/role/gen_code').then(({data}) => {
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
                url: '/api/admin/role/detail/' + id,
            })
                .then(({data}) => {
                    if (data['success']) {
                        let res = data['data']
                        _this.formData.code = res['code']
                        _this.formData.name = res['name']                       
                        _this.formData.id_parent = res['id_parent']
                        _this.formData.ListAction = JSON.parse(res['ListAction']) 
                        _this.formData.ListModule = JSON.parse(res['ListModule'])                        
                    }
                });
            await _this.getDataParent(idParent, true)

        },
      
        appendToFormData() {
            let _this = this
            _this.form =new FormData()
            Object.keys(this.formData).forEach(key => {   
                if(this.formData[key]){
                    if(key=='ListModule' || key =='ListAction'){
                        _this.form.set(key, JSON.stringify(this.formData[key]))
                        return
                    }else{
                        _this.form.set(key, this.formData[key])
                    }
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
                        url: '/api/admin/role/create',
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
                                _this.$router.push({name:"RoleList"})
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
                        url: '/api/admin/role/update/' + _this.idUpdate,
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
                                _this.$router.push({name:"RoleList"})
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
.tree-role .el-tree-node__content{
    margin: 10px;
    display: flex;
    align-items: center;
    /* border: 1px dotted rgb(0,0,0,0.2);
    border-radius: 5px;
    margin-bottom: 5px; */
   
}
</style>
