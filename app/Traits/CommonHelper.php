<?php

namespace App\Traits;

trait CommonHelper
{
    public function genControllerContent($controllerName, $modelName, $pathController, $feildNameGenCode, $textGenCode)
    {
        $namespace='';
        if($pathController !=''){
            $namespace="\\".strtolower($pathController);
        }
        $content = <<<PHP
        <?php

        namespace App\Http\Controllers$namespace;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;
        use App\Models\admin\\$modelName;
        use Illuminate\Http\JsonResponse;
        use App\Services\QueryService;

        class {$controllerName} extends Controller
        {
            public function index(Request \$request)
            {
                try {
                    \$limit = \$request->get('PageLimit', 25);
                    \$page = \$request->get('Page', 1);
                    \$ascending = (int) \$request->get('ascending', 0);
                    \$orderBy = \$request->get('orderBy', '');
                    \$search = \$request->get('TextSearch', '');
                    \$columnSearch = \$request->get('columnSearch', ['tenDonVi']);
                    \$betweenDate = \$request->get('updated_at', []);
                    \$queryService = new QueryService(new {$modelName}());
                    \$queryService->columnSearch = \$columnSearch;
                    \$queryService->search = \$search;
                    \$queryService->betweenDate = \$betweenDate;
                    \$queryService->limit = \$limit;
                    \$queryService->ascending = \$ascending;
                    \$queryService->orderBy = \$orderBy;                   
                    \$query = \$queryService->queryTable();
                    \$query = \$query->paginate(\$limit,['*'],'page',\$page);    
                    \$product = \$query->toArray();
                    return \$this->jsonTable(\$product);  
                  
                } catch (\Exception \$e) {
                    return response()->json(['success' => false, 'mess' => \$e->getMessage()]);
                }
            }

            public function store(Request \$request)
            {
                try {
                    \$formData = \$request->post();
                    \$res = {$modelName}::create(\$formData);
                    return response()->json(['success' => true, 'mess' => 'Thêm mới thành công!', 'data' => \$res]);
                } catch (\Exception \$e) {
                    return response()->json(['success' => false, 'mess' => \$e->getMessage()]);
                }
            }

            public function show(\$id)
            {
                try {
                    \$res = {$modelName}::find(\$id);
                    return response()->json(['success' => true, 'data' => \$res]);
                } catch (\Exception \$e) {
                    return response()->json(['success' => false, 'mess' => \$e->getMessage()]);
                }
            }

            public function update(Request \$request, \$id)
            {
                try {
                    \$formData = \$request->post();
                    \$res = {$modelName}::find(\$id)->update(\$formData);
                    return response()->json(['success' => true, 'mess' => 'Cập nhật thành công!', 'data' => \$res]);
                } catch (\Exception \$e) {
                    return response()->json(['success' => false, 'mess' => \$e->getMessage()]);
                }
            }

            public function destroy(\$id)
            {
                try {
                    \$res = {$modelName}::find(\$id)->delete();
                    return response()->json(['success' => true, 'mess' => 'Xóa thành công!']);
                } catch (\Exception \$e) {
                    return response()->json(['success' => false, 'mess' => \$e->getMessage()]);
                }
            }
            public function genCode(){
                \$lastCode = {$modelName}::orderBy('{$feildNameGenCode}', 'desc')->first(); // lấy mã cuối cùng trong database      
                if (!\$lastCode) {
                    \$number = 1;
                } else {
                    \$number = intval(substr(\$lastCode->{$feildNameGenCode}, -3)) + 1; // lấy số cuối cùng của mã và tăng giá trị lên 1
                }    
                \$newCode = '{$textGenCode}' . str_pad(\$number, 4, '0', STR_PAD_LEFT); // tạo mã mới dựa trên số đó và định dạng "ABCXXX"
                return \$newCode;
            }
        }
        PHP;
        return $content;
    }
    public function genMargationContent($tableName, $fields){
        $schemaFields = "";
        foreach ($fields as $field) {
            $name = $field['fieldname'];
            $type = $field['type'];
            $size = isset($field['size']) && $type === 'string' ? "$field[size]" : "";
            $nullable = isset($field['nullable']) && $field['nullable'] ? '->nullable()' : '';
            $unique = isset($field['unique']) && $field['unique'] ? '->unique()' : '';
            if(!$size){
                $schemaFields .= "\$table->$type('$name')$nullable$unique;\n                ";
            }else{
                 $schemaFields .= "\$table->$type('$name', $size)$nullable$unique;\n                ";
            }
           
        }

        return <<<EOT
            <?php

            use Illuminate\Database\Migrations\Migration;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Support\Facades\Schema;

            return new class extends Migration {
                public function up()
                {
                    Schema::create('$tableName', function (Blueprint \$table) {
                        \$table->id();
                        $schemaFields
                        \$table->timestamps();
                    });
                }

                public function down()
                {
                    Schema::dropIfExists('$tableName');
                }
            };
        EOT;
    
    }
    public function generateModelContent($modelName, $tableName, $fields)
    {
        $fields = (array_column($fields,'fieldname'));
        $fillableFields = implode(",\n        ", array_map(fn($field) => "'$field'", $fields));

                return <<<EOT
        <?php

        namespace App\Models\admin;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class $modelName extends Model
        {
            use HasFactory;
            protected \$table = '$tableName';
            protected \$fillable = [
                $fillableFields
            ];
        }
        EOT;
    }

    public function genListRouter($path, $controllerName, $componentName='Ex'){
        return  $newRoutes = <<<EOT
        //{$componentName}
        Route::get('$path', '$controllerName@index');
        Route::get('$path/gen_code', '$controllerName@genCode');
        Route::get('$path/detail/{id}', '$controllerName@show');
        Route::post('$path/update/{id}', '$controllerName@update');
        Route::post('$path/create', '$controllerName@store');
        Route::post('$path/delete/{id}', '$controllerName@destroy');    
    EOT;
    }

    public function generateVueTemplateTable($nameComponent, $titleTable='NAME TABLE', $pathApi, $fields){
        $pathApi='/api/admin/'.$pathApi;
        $listFeild = '';
        foreach ($fields as $field) {
            $prop = $field['prop'];
            $label = $field['label'];
            $sortable = isset($field['sortable']) && $field['sortable'] ? 'sortable' : '';
            
            $listFeild .= "<el-table-column prop=\"$prop\" label=\"$label\" $sortable></el-table-column>\n                                    ";
        }               
        return $content = 
        <<<VUE
            <template>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                                <h3 class="card-title">{$titleTable}</h3>
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
                                        <div class="row" style="display: flex; flex-wrap: nowrap; padding: 8px; justify-content: space-between">
                                            <el-input
                                                style="width: 500px"
                                                v-model="textSearch"
                                                placeholder="Nhập kí tự cần tìm kiếm"
                                                @keyup.enter.native="getList()"
                                            >
                                                <template v-slot:append>
                                                    <el-button type="primary" @click="getList()"><i class="el-icon-search"></i> Tìm
                                                        kiếm
                                                    </el-button>

                                                </template>
                                            </el-input>
                                            <el-button @click="outerVisible=true; idUpdate=''; trigger= new Date().getTime()" class="ml-2" type="primary"><i
                                                class="el-icon-plus"></i> Thêm mới
                                            </el-button>
                                        </div>
                                        <el-table
                                            empty-text="Chưa có dữ liệu !"
                                            :data="tableData"
                                            style="width: 100%"
                                            border
                                            :resizable="true"
                                            v-loading="loadingTable"
                                            :row-class-name="tableRowClassName">

                                            {$listFeild}                                      
                                            <el-table-column
                                                prop="created_at"
                                                label="NGÀY TẠO"
                                                width="150"
                                            >
                                                <template slot-scope="scope">
                                                    {{ scope.row.created_at | formatDate}}
                                                </template>
                                            </el-table-column>
                                            <el-table-column
                                                label="THAO TÁC"
                                                width="180"
                                            >
                                                <template slot-scope="scope">
                                                    <el-button
                                                        size="mini"
                                                        @click="update(scope.row)">Cập
                                                        nhật
                                                    </el-button>
                                                    <!-- <el-button
                                                    size="mini"
                                                    type="danger"
                                                    @click="delete(scope.row.id)">Xóa</el-button> -->
                                                    <el-popconfirm
                                                        confirm-button-text='Xóa'
                                                        cancel-button-text='Không'
                                                        :title="'Bạn có chắc chắn muốn xóa hình ảnh này ?'"
                                                        @confirm="()=>deleteBanner(scope.row.id)"
                                                    >
                                                        <el-button slot="reference" type="danger"
                                                                size="mini"><i class="el-icon-delete"></i> Xóa
                                                        </el-button>
                                                    </el-popconfirm>
                                                </template>
                                            </el-table-column>
                                            <template slot="empty">
                                                <el-empty description="No data"></el-empty>
                                            </template>
                                        </el-table>
                                    </div>
                                    <div class="block" style="margin-left: 0px;margin-right: 8px;padding: 10px;width: 100%">
                                        <el-pagination
                                            @size-change="handleSizeChange"
                                            @current-change="handleCurrentChange"
                                            :current-page.sync="currentPage"
                                            :page-sizes="[10, 20, 50, 100]"
                                            :page-size="options.PageLimit"
                                            layout="total, sizes, prev, pager, next, jumper"
                                            :total="options.Total">
                                        </el-pagination>
                                    </div>
                                    <!-- /.col -->

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    <el-dialog :visible.sync="outerVisible">
                        <formData :resID="idUpdate" :trigger="trigger" @success="success"/>
                    </el-dialog>
                </div>

            </template>

            <script>
            import formData from "./form";
            export default {
                name:"{$nameComponent}",
                components:{formData},
                data() {
                    return {
                        trigger: new Date().getTime(),
                        idUpdate:'',
                        outerVisible:false,
                        loadingTable:false,
                        tableData: [],
                        slideData: [],
                        textSearch: '',
                        currentPage: 1,
                        options:{
                            Total:10,
                            Page:1,
                            PageLimit:10
                        }
                    }
                },
                mounted() {
                    this.getList()
                },
                methods: {
                    success(){
                    this.outerVisible = false
                    this.getList()
                    },
                    update(e){
                        this.idUpdate = e.id
                        this.outerVisible=true
                        this.trigger=new Date().getTime()
                    },
                    handleSizeChange(val) {
                        this.options.PageLimit = val
                        this.getList()
                    },
                    handleCurrentChange(val) {
                        this.options.Page = val
                        this.getList()
                    },
                    updateStatus(id, hidden) {
                        let _this = this
                        var formData = new FormData()
                        console.log(hidden, hidden == "0" ? "1" : "0")
                        formData.append('hidden', hidden == "0" ? "1" : "0")
                        axios({
                            method: 'post',
                            url: '{$pathApi}/update/' + id,
                            data: formData
                        })
                            .then(function (response) {
                                if (response.data['success']) {
                                    _this.\$notify({
                                        title: 'Success',
                                        message: response.data['mess'],
                                        type: 'success'
                                    });
                                    _this.getList()
                                } else {
                                    _this.\$notify({
                                        title: 'Error',
                                        message: response.data['mess'],
                                        type: 'error'
                                    });
                                }

                            });

                    },
                    deleteBanner(id) {
                        let _this = this
                        axios({
                            method: 'post',
                            url: '{$pathApi}/delete/' + id,
                        })
                            .then(function (response) {
                                if (response.data['success']) {
                                    _this.\$notify({
                                        title: 'Success',
                                        message: response.data['mess'],
                                        type: 'success'
                                    });
                                    _this.getList()
                                } else {
                                    _this.\$notify({
                                        title: 'Error',
                                        message: response.data['mess'],
                                        type: 'error'
                                    });
                                }
                            });
                    },
                    getList() {
                        let _this = this
                        _this.loadingTable = true
                        let param = {}
                        this.options.Page &&(param.Page = this.options.Page)
                        this.options.PageLimit &&(param.PageLimit = this.options.PageLimit)
                        this.textSearch && (param.TextSearch = this.textSearch)
                        axios({
                            method: 'get',
                            url: '{$pathApi}',
                            params: param
                        })
                            .then(function ({data}) {
                                if (data['success']) {
                                    _this.tableData = data['data']
                                    _this.options.Total = data['total']
                                    _this.slideData = data['data'].filter(e => e.hidden == 1)
                                }
                                _this.loadingTable = false
                            });
                    }, changeStatus(id) {
                        alert(id)
                    },
                    tableRowClassName({row, rowIndex}) {
                        if (rowIndex === 1) {
                            return 'warning-row';
                        } else if (rowIndex === 3) {
                            return 'success-row';
                        }
                        return '';
                    }
                }
            };
            </script>

            <style>
            .el-table .warning-row {
                background: oldlace;
            }

            .el-table .success-row {
                background: #f0f9eb;
            }
            </style>

        VUE;
    }

    public function generateVueTemplateForm($nameComponent, $titleTable='NAME TABLE', $pathApi, $fields, $titleForm, $feildNameGenCode){
        $pathApi='/api/admin/'.$pathApi;
        $listFeild = '';
        $listForm = '';
        $formFields = '';
        $formDetail ='';
        foreach ($fields as $field) {
            $type = isset($field['type']) && $field['type'] === 'textarea' ? 'textarea' : 'input';
            $disabled = isset($field['disabled']) && $field['disabled'] ? 'disabled' : '';
            $formFields .= "<el-form-item disabled :rules=\"requiredForm\" label=\"{$field['label']}\" prop=\"{$field['prop']}\">\n                    ";
            $formFields .= "<el-input type=\"{$type}\" v-model=\"form.{$field['prop']}\" {$disabled}></el-input>";
            $formFields .= "\n                </el-form-item>";
            $listForm .=$field['prop'].":'',\n                        ";
            $formDetail .="_this.form.{$field['prop']} = res['{$field['prop']}']\n                                ";
        }               
        return $content = 
        <<<VUE
            <template>    
                <div class="form_product_color">
                <div style="margin-top: -30px">
                    <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">{{title}}</span>
                    <el-divider></el-divider>
                </div>
                    <el-form :model="form"  ref="form" label-width="150px" class="demo-ruleForm">
                        {$formFields}
                    </el-form>
                    <div style="display: flex; justify-content: end">
                        <el-button type="primary" @click="submit">Lưu lại</el-button>
                        <el-button @click="\$refs.form.resetFields()">Reset Form</el-button>
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
                                {$listForm}
                            },
                            requiredForm: { required: true, message: 'Vui lòng không bỏ trống!', trigger: 'blur' }
                        }
                    },
                    mounted() {
                        if(this.resID){
                            this.title='Cập nhật {$titleForm}'
                            this.getDetail(this.resID)
                        }else {
                            this.title='Thêm mới {$titleForm}'
                            this.\$refs.form.resetFields()
                            this.genCode()
                        }
                    },
                    watch:{
                        trigger(e){
                            if(this.resID){
                                this.title='Cập nhật {$titleForm}'
                                this.getDetail(this.resID)
                            }else {
                                this.title='Thêm mới {$titleForm}'
                                this.\$refs.form.resetFields()
                                this.genCode()
                            }
                        }
                    },
                    methods:{
                        async genCode() {
                            let _this = this
                            ApiService.query('{$pathApi}/gen_code').then(({data}) => {
                                _this.form.{$feildNameGenCode} = data
                            })
                        },
                        submit(){
                            let _this= this
                            let url
                            url = this.resID?('{$pathApi}/update/'+this.resID):'{$pathApi}/create'
                            this.\$refs['form'].validate((valid) => {
                                if (valid) {
                                    axios({
                                        method: 'post',
                                        url: url,
                                        data: this.form
                                    })
                                        .then(function (response) {
                                            if(response.data['success']){
                                                _this.\$notify({
                                                    title: 'Success',
                                                    message: response.data['mess'],
                                                    type: 'success'
                                                });

                                                _this.\$emit('success')
                                                _this.\$refs.form.resetFields()
                                            }else{
                                                _this.\$notify({
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
                                url: '{$pathApi}/detail/'+id,
                            })
                                .then(({data})=> {
                                    if(data['success']){
                                        let res = data['data']
                                        {$formDetail}                       
                                    }
                                });

                        },
                    }
                }
            </script>

            <style scoped>

            </style>


        VUE;
    }

    public function generateVueRouter($path, $componentName){
        return  $vueRoutes = <<<EOT
            \n
                    //{$componentName}
                    {
                        path: '/$path',
                        component: () => import('../components/$componentName/index'),
                        name: '{$componentName}List',
                        meta: { title: '{$componentName}List' }
                    },
                    {
                        path: '/$path/create',
                        component: () => import('../components/$componentName/form'),
                        name: '{$componentName}Create',
                        meta: { title: '{$componentName}Create', type: 'Form' }
                    },
                    {
                        path: '/$path/:id?',
                        component: () => import('../components/$componentName/form'),
                        name: '{$componentName}Update',
                        meta: { title: '{$componentName}Update', type: 'Form' }
                    },
        EOT;
    }
        
}