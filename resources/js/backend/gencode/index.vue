<template>
    <div>
        <el-card>
            <el-steps :active="active" finish-status="success" align-left>
                <el-step title="Step 1" description="Generate php file"></el-step>
                <el-step title="Step 2" description="Generate vue file"></el-step>
                <el-step title="Step 3" description="Finish generate code"></el-step>
            </el-steps>
        </el-card>
        <el-card v-if="active==1">          
            <div class="text item">
                <el-form ref="form" :model="formModel" label-width="150px">
                    <el-form-item label="Table name">
                        <el-input v-model="formModel.nameTable" placeholder="user -> create_user_table"></el-input>
                    </el-form-item>
                    <el-form-item label="Model name">
                        <el-input v-model="formModel.nameModel" placeholder="users"></el-input>
                    </el-form-item>
                    <!-- <el-form-item label="Path model">
                        <el-input v-model="formModel.nameModel" placeholder="admin -> admin/nameModel"></el-input>
                    </el-form-item> -->
                    <el-form-item label="Controller name">
                        <el-input v-model="formModel.controllerName" placeholder="UserController"></el-input>
                    </el-form-item>
                    <el-form-item label="Fieldname gencode">
                        <el-input v-model="formModel.feildNameGenCode" placeholder="maNhanVien"></el-input>
                    </el-form-item>
                    <el-form-item label="Text gencode">
                        <el-input v-model="formModel.textGenCode" placeholder="NV -> NV0001"></el-input>
                    </el-form-item>
                    <el-form-item label="List field tabel">
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <el-button @click="addRowList()" type="primary" small>Add row</el-button>                               
                            </div>
                        </div>
                        <el-divider></el-divider>
                        <el-table :data="listField" border style="width: 100%">
                            <el-table-column label="stt" width="50px">
                                <template slot-scope="scope">
                                    <span>{{ scope.$index + 1 }}</span>
                                </template>
                            </el-table-column>
                            <el-table-column prop="fieldname" label="fieldname">
                                <template slot-scope="scope">
                                    <component :is="'el-input'" v-model="scope.row.fieldname">{{
                                        scope.row.fieldname }}</component>
                                </template>
                            </el-table-column>
                            <el-table-column prop="type" label="type">
                                <template slot-scope="scope">
                                    <component :is="'el-select'" v-model="scope.row.type"> 
                                        <el-option
                                            v-for="item in listType"
                                            :key="item"
                                            :label="item"
                                            :value="item"
                                        >                                            
                                        </el-option>
                                    </component>
                                     
                                </template>
                            </el-table-column>
                            <el-table-column prop="size" label="size">
                                <template slot-scope="scope">
                                    <component :is="'el-input'" v-model="scope.row.size">{{
                                        scope.row.size }}</component>
                                </template>
                            </el-table-column>
                            <el-table-column prop="nullable" label="nullable">
                                <template slot-scope="scope">
                                    <component :is="'el-checkbox'" v-model="scope.row.nullable">{{
                                        scope.row.nullable }}</component>                                       
                                </template>
                            </el-table-column>
                            <el-table-column prop="unique" label="unique">
                                <template slot-scope="scope">
                                    <component  :is="'el-checkbox'" v-model="scope.row.unique">{{
                                        scope.row.unique }}</component>
                                </template>
                            </el-table-column>
                            <el-table-column prop="edit" width="100px" label="action">
                                <template slot-scope="scope">                          
                                    <el-popconfirm confirm-button-text='Xóa' cancel-button-text='Không'
                                        :title="'Bạn có chắc chắn muốn xóa ?'" @confirm="() => deleteRow(scope)">
                                        <el-button slot="reference" type="danger" style="height: 38px;"><i
                                                class="el-icon-delete"></i> Xóa</el-button>
                                    </el-popconfirm>
                                </template>
                            </el-table-column>
                        </el-table>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="getContentMigration()">Viewcode</el-button>       
                        <el-button style="margin-top: 12px;" @click="back">Back step</el-button>                  
                        <el-button style="margin-top: 12px;" @click="next">Next step</el-button>                  
                        <el-button>Cancel</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </el-card>      
        <el-card v-if="active==2">          
            <div class="text item">
                <el-form ref="form" :model="vueModel" label-width="150px">
                    <el-form-item label="Function name">
                        <el-input v-model="vueModel.nameComponent" placeholder="QuanLyDanhSach -> name:'QuanLyDanhSachTable,Form'"></el-input>
                    </el-form-item>
                    <el-form-item label="Funtion path">
                        <el-input v-model="vueModel.pathComponent" placeholder="QuanLyDanhSach -> Path folder vue file: QuanLyDanhSach/index, form"></el-input>
                    </el-form-item> 
                    <el-form-item label="Title table">
                        <el-input v-model="vueModel.titleTable" placeholder="Quản Lý Danh Sách Năm Học"></el-input>
                    </el-form-item> 
                    <el-form-item label="Title form">
                        <el-input v-model="vueModel.titleForm" placeholder="thông tin năm học"></el-input>
                    </el-form-item>                    
                    <el-form-item label="List field tabel">
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <el-button @click="addRowListTable()" type="primary" small>Add row</el-button>                               
                            </div>
                        </div>
                        <el-divider></el-divider>
                        <el-table :data="listFieldTable" border style="width: 100%">
                            <el-table-column label="stt" width="50px">  
                                <template slot-scope="scope">
                                    <span>{{ scope.$index + 1 }}</span>
                                </template>
                            </el-table-column>
                            <el-table-column prop="label" label="label">
                                <template slot-scope="scope">
                                    <component :is="'el-input'" v-model="scope.row.label">{{
                                        scope.row.label }}</component>
                                </template>
                            </el-table-column>
                            <el-table-column prop="prop" label="prop">
                                <template slot-scope="scope">
                                    <component :is="'el-select'" v-model="scope.row.prop"> 
                                        <el-option
                                            v-for="item in listField.map(e=>e.fieldname)"
                                            :key="item"
                                            :label="item"
                                            :value="item"
                                        >                                            
                                        </el-option>
                                    </component>
                                </template>
                            </el-table-column>
                            <el-table-column prop="type" label="type">
                                <template slot-scope="scope">
                                    <component :is="'el-select'" v-model="scope.row.type"> 
                                        <el-option
                                            v-for="item in listTypeField"
                                            :key="item"
                                            :label="item"
                                            :value="item"
                                        >                                            
                                        </el-option>
                                    </component>
                                     
                                </template>
                            </el-table-column>                            
                            <el-table-column prop="required" label="required">
                                <template slot-scope="scope">
                                    <component :is="'el-checkbox'" v-model="scope.row.required">{{
                                        scope.row.required }}</component>                                       
                                </template>
                            </el-table-column>                            
                            <el-table-column prop="sortable" label="sortable">
                                <template slot-scope="scope">
                                    <component :is="'el-checkbox'" v-model="scope.row.sortable">{{
                                        scope.row.sortable }}</component>                                       
                                </template>
                            </el-table-column>                            
                            <el-table-column prop="disabled" label="disabled">
                                <template slot-scope="scope">
                                    <component :is="'el-checkbox'" v-model="scope.row.disabled">{{
                                        scope.row.disable }}</component>                                       
                                </template>
                            </el-table-column>                            
                            <el-table-column prop="edit" width="100px" label="action">
                                <template slot-scope="scope">                          
                                    <el-popconfirm confirm-button-text='Xóa' cancel-button-text='Không'
                                        :title="'Bạn có chắc chắn muốn xóa ?'" @confirm="() => deleteRowTable(scope)">
                                        <el-button slot="reference" type="danger" style="height: 38px;"><i
                                                class="el-icon-delete"></i> Xóa</el-button>
                                    </el-popconfirm>
                                </template>
                            </el-table-column>
                        </el-table>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="validExCode=true">Viewcode</el-button>       
                        <el-button style="margin-top: 12px;" @click="back">Back step</el-button>                          
                        <el-button style="margin-top: 12px;" @click="next">Next step</el-button>      
                        <el-button>Cancel</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </el-card>        
        <el-card v-show="active==3">           
            <el-button type="primary" @click="getContentMigration()">GetContentMigration</el-button>                       
            <el-button type="success" @click="getContentModel()">GetContentModel</el-button>                       
            <el-button type="danger" @click="getContentController()">GetContentController</el-button>     
            <el-button type="danger" @click="getContentRouter()">GetContentRouter</el-button>  
            <el-button type="primary" @click="getContentVueTable()">GetContentVueTable</el-button>          
            <el-button type="primary" @click="getContentVueForm()">GetContentVueForm</el-button>          
            <el-button type="primary" @click="getContentVueRouter()">GetContentVueRouter</el-button> 
            <el-divider></el-divider>
            <pre style="background-color: black; max-height: 60vh; overflow-x: auto;"><code style="color: #20c275;">{{ codeReview }}</code></pre>
            <el-button type="primary" @click="genCode()" :loading="loading">GenCode</el-button> 
            <el-button style="margin-top: 12px;" @click="back">Back step</el-button>     
        </el-card>
        <el-dialog :visible.sync="validExCode" width="50vw">
            <div v-show="active==1">
                <el-button type="primary" @click="getContentMigration()">GetContentMigration</el-button>                       
                <el-button type="success" @click="getContentModel()">GetContentModel</el-button>                       
                <el-button type="danger" @click="getContentController()">GetContentController</el-button>     
                <el-button type="danger" @click="getContentRouter()">GetContentRouter</el-button>     
            </div>
            <div v-show="active===2">
                <el-button type="primary" @click="getContentVueTable()">GetContentVueTable</el-button>          
                <el-button type="primary" @click="getContentVueForm()">GetContentVueForm</el-button>          
                <el-button type="primary" @click="getContentVueRouter()">GetContentVueRouter</el-button>          
            </div>
            <el-divider></el-divider>
            <pre style="background-color: black; max-height: 60vh; overflow-x: auto;"><code style="color: #20c275;">{{ codeReview }}</code></pre>
        </el-dialog>
    </div>
</template>
<script>
import ApiService from '../common/api.service'
export default {
    name: 'GenCodeExample',
    data() {
        return {
            active:1,
            form:new FormData(),
            loading:false,
            formModel:{
                nameTable:'',
                nameModel:'',
                controllerName:'',
                textGenCode:'',
                feildNameGenCode:''
                // controllerPath:'user',
            },
            vueModel:{
                nameComponent:'',
                pathComponent:'',                
                titleTable:'',                
                titleForm:'',                
            },
            codeReview: 'Chọn file để xem nội dung được tạo',     
            activeEdit: false,
            listField:[],
            listFieldTable:[],
            listType:['string','bigInteger','text'],
            listTypeField:['el-input','el-select','el-checkbox','el-textarea'],
            validExCode:false
        }
    },
    methods: {
        next() {
            if (this.active++ > 4) this.active = 1;
        },
        back() {
            if (this.active > 1) this.active--;
        },
        getContentMigration() {
            this.form=new FormData(),
            this.form.set('table_name',this.formModel.nameTable)
            
            if(this.listField.length>0){
                this.form.set('fields',JSON.stringify(this.listField))
            } else{
                this.form.set('fields','clear')
            }     
            ApiService.post('/api/get-content-migration',this.form).then(({ data }) => {
                this.codeReview = data
                // this.validExCode = true
            })
        },
        getContentModel() {
            this.form=new FormData(),
            this.form.set('table_name',this.formModel.nameTable)
            this.form.set('model_name',this.formModel.nameModel)
            if(this.listField.length>0){
                this.form.set('fields',JSON.stringify(this.listField))
            } else{
                this.form.set('fields','clear')
            }     
            ApiService.post('/api/get-content-model',this.form).then(({ data }) => {
                this.codeReview = data
                // this.validExCode = true

            })
        },
        getContentController() {
            this.form=new FormData(),
            this.form.set('controller_name',this.formModel.controllerName)
            this.form.set('feild_name_gencode',this.formModel.feildNameGenCode)
            this.form.set('text_gencode',this.formModel.textGenCode)
            // this.form.set('controller_path',this.formModel.controllerPath)
            this.form.set('model_name',this.formModel.nameModel)
            if(this.listField.length>0){
                this.form.set('fields',JSON.stringify(this.listField))
            } else{
                this.form.set('fields','clear')
            }     
            ApiService.post('/api/get-content-controller',this.form).then(({ data }) => {
                this.codeReview = data
                // this.validExCode = true

            })
        },
        getContentRouter() {
            this.form=new FormData(),        
            this.form.set('model_name',this.formModel.nameModel)          
            this.form.set('controller_name',this.formModel.controllerName)          
            ApiService.post('/api/get-content-router',this.form).then(({ data }) => {
                this.codeReview = data
                // this.validExCode = true

            })
        },
        getContentVueTable() {
            this.form=new FormData(),        
            this.form.set('component_name',this.vueModel.nameComponent)          
            this.form.set('component_path',this.vueModel.pathComponent)      
            this.form.set('model_name',this.formModel.nameModel)
            this.form.set('title_table',this.vueModel.titleTable)
            if(this.listFieldTable.length>0){
                this.form.set('fieldsTable',JSON.stringify(this.listFieldTable))
            } else{
                this.form.set('fieldsTable','clear')
            }   
            ApiService.post('/api/get-content-vue-table',this.form).then(({ data }) => {
                this.codeReview = data
                // this.validExCode = true
            })
        },
        getContentVueForm() {
            this.form=new FormData(),        
            this.form.set('component_name',this.vueModel.nameComponent)          
            this.form.set('component_path',this.vueModel.pathComponent)      
            this.form.set('model_name',this.formModel.nameModel)
            this.form.set('feild_name_gencode',this.formModel.feildNameGenCode)
            this.form.set('title_table',this.vueModel.titleTable)
            this.form.set('title_form',this.vueModel.titleForm)
            this.form.set('disabled',this.vueModel.disabled)       
            if(this.listFieldTable.length>0){
                this.form.set('fieldsTable',JSON.stringify(this.listFieldTable))
            } else{
                this.form.set('fieldsTable','clear')
            }   
            ApiService.post('/api/get-content-vue-form',this.form).then(({ data }) => {
                this.codeReview = data
                // this.validExCode = true
            })
        },
        getContentVueRouter() {
            this.form=new FormData(),        
            this.form.set('component_name',this.vueModel.nameComponent)          
            this.form.set('component_path',this.vueModel.pathComponent)      
            this.form.set('model_name',this.formModel.nameModel)
            this.form.set('feild_name_gencode',this.formModel.feildNameGenCode)
            this.form.set('title_table',this.vueModel.titleTable)
            this.form.set('title_form',this.vueModel.titleForm)
            this.form.set('disabled',this.vueModel.disabled)
            if(this.listFieldTable.length>0){
                this.form.set('fieldsTable',JSON.stringify(this.listFieldTable))
            } else{
                this.form.set('fieldsTable','clear')
            }   
            ApiService.post('/api/get-content-vue-router',this.form).then(({ data }) => {
                this.codeReview = data
                // this.validExCode = true
            })
        },
        genCode() {
            this.loading=true
            this.form=new FormData(),        
            this.form.set('component_name',this.vueModel.nameComponent)          
            this.form.set('component_path',this.vueModel.pathComponent)      
            this.form.set('model_name',this.formModel.nameModel)
            this.form.set('feild_name_gencode',this.formModel.feildNameGenCode)
            this.form.set('title_table',this.vueModel.titleTable)
            this.form.set('title_form',this.vueModel.titleForm)
            this.form.set('disabled',this.vueModel.disabled)
            this.form.set('table_name',this.formModel.nameTable)
            this.form.set('controller_name',this.formModel.controllerName)
            this.form.set('feild_name_gencode',this.formModel.feildNameGenCode)
            this.form.set('text_gencode',this.formModel.textGenCode)
            if(this.listFieldTable.length>0){
                this.form.set('fieldsTable',JSON.stringify(this.listFieldTable))
            } else{
                this.form.set('fieldsTable','clear')
            }   
            if(this.listField.length>0){
                this.form.set('fields',JSON.stringify(this.listField))
            } else{
                this.form.set('fields','clear')
            }     
            ApiService.post('/api/generate-code-all',this.form).then(({ data }) => {
                this.codeReview = data
                //this.validExCode = true
                if(data.success){
                    this.$notify({
                        title: 'Success',
                        message: data['mess'],
                        type: 'success'
                    });
                    this.loading=false
                    setTimeout(()=>{
                        location.reload();
                    },4000)
                }
            })
        },
        deleteRow(id){
            this.listField[id.$index] && this.listField.splice(id.$index,1)            
        },      
        async addRowList(){              
            this.listField.push(
                {            
                    fieldname: '',
                    type: '',
                    size: '',
                    nullable: '',  
                    unique:''     
                },               
            )   
            this.activeEdit = true
        },
        deleteRowTable(id){
            this.listFieldTable[id.$index] && this.listFieldTable.splice(id.$index,1)            
        },      
        async addRowListTable(){              
            this.listFieldTable.push(
                {            
                    label: '',
                    prop: '',
                    type: '',              
                    required:'',
                    sortable:'',     
                    disabled:'',     
                },              
            )
            this.activeEdit = true
        },
    }

}
</script>