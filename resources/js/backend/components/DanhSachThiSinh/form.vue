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
                                     label-width="220px" class="demo-ruleForm">                                  
                                
                                <span class="title-divider">Thông tin năm học</span>     
                                <el-divider></el-divider>                                 
                                <el-form-item label="Khối thi" prop="maKhoiThi">
                                    <div class="form-group">
                                        <el-select style="width: 100%" v-model="formData.maKhoiThi" size="large"
                                                   filterable 
                                                   placeholder="Chọn khối thi">
                                            <el-option
                                                v-for="item in listKhoiThi"
                                                :key="item.id"
                                                :label="item.maKhoiThi + ' | ' + item.tenKhoiThi"
                                                :value="item.maKhoiThi"
                                            >                                            
                                            </el-option>
                                        </el-select>
                                    </div>
                                </el-form-item>                                                           
                                 
                                <!-- <span class="title-divider">Thông tin xét tốt nghiệp và cấp chứng chỉ</span>     -->
                                <!-- <el-divider></el-divider> -->
                                <el-form-item label="Năm học" prop="maNamHoc">
                                    <div class="form-group">
                                        <el-select style="width: 100%" v-model="formData.maNamHoc" size="large"
                                                   filterable 
                                                   placeholder="Chọn năm học">
                                            <el-option
                                                v-for="item in listNamHoc"
                                                :key="item.id"
                                                :label="item.maNamHoc + ' | ' + item.tenNamHoc"
                                                :value="item.maNamHoc"
                                            >                                            
                                            </el-option>
                                        </el-select>
                                    </div>
                                </el-form-item>        
                                <div style="display: flex; justify-content: space-between;">
                                     <span class="title-divider">Danh sách thí sinh</span>   
                                     <div>
                                        <el-button @click="validDialogUpload=true" type="primary"><i class="el-icon-upload"></i>Import Excel</el-button>
                                        <el-button @click="addRowList()" type="primary"><i class="el-icon-plus"></i>Thêm mới</el-button>
                                        <el-button v-show="formData.maKhoiThi && formData.maNamHoc" @click="getDanhSachThiSinh()" type="success"><i class="el-icon-refresh-left"></i> Load danh sách</el-button>
                                        <el-button v-show="formData.maKhoiThi && formData.maNamHoc && listDataThiSinh.length>0" @click="activeEdit= !activeEdit" >
                                            <i class="el-icon-edit"></i> 
                                            Cập nhật 
                                            <el-switch
                                            
                                            :value="!activeEdit"
                                            active-color="#13ce66"
                                            inactive-color="#ff4949">
                                            </el-switch>
                                        </el-button>
                                    </div>
                                    
                                </div>
                              
                                <el-divider></el-divider>  
                                <el-table
                                    :data="listDataThiSinh"
                                    border
                                    style="width: 100%">
                                    <el-table-column                                 
                                    label="STT"
                                    width="50px"
                                    >                                        
                                        <template slot-scope="scope">
                                            <span>{{ scope.$index + 1}}</span>
                                        </template>
                                    </el-table-column>                             
                                    <el-table-column
                                    prop="tenThiSinh"
                                    label="Tên Thí Sinh"
                                    >
                                        <template slot-scope="scope">
                                            <component :readonly="activeEdit" :is="'el-input'" v-model="scope.row.tenThiSinh" >{{ scope.row.tenThiSinh }}</component>
                                        </template>
                                    </el-table-column>
                                    <el-table-column
                                    prop="gioiTinh"
                                    label="Giới Tính"
                                    >
                                        <template slot-scope="scope">
                                            <component :readonly="activeEdit" :is="'el-input'" v-model="scope.row.gioiTinh" >{{ scope.row.gioiTinh }}</component>
                                        </template>
                                    </el-table-column>
                                    <el-table-column
                                    prop="ngaySinh"
                                    label="Ngày Sinh"
                                    >
                                        <template slot-scope="scope">
                                            <component :readonly="activeEdit" :is="'el-input'" v-model="scope.row.ngaySinh" >{{ scope.row.ngaySinh }}</component>
                                        </template>
                                    </el-table-column>
                                    <el-table-column
                                    prop="CCCD"
                                    label="CCCD"
                                    >
                                        <template slot-scope="scope">
                                            <component :readonly="activeEdit" :is="'el-input'" v-model="scope.row.CCCD" >{{ scope.row.CCCD }}</component>
                                        </template>
                                    </el-table-column>
                                    <!-- <el-table-column
                                    prop="ketQua"
                                    label="Kết Quả"
                                   >
                                        <template slot-scope="scope">
                                            <component :readonly="scope.row.edit" :is="'el-input'" v-model="scope.row.ketQua" >{{ scope.row.ketQua }}</component>
                                        </template>
                                    </el-table-column> -->
                                    <el-table-column
                                    prop="edit"
                                    width="100px"
                                    label="Thao Tác"
                                   >
                                        <template slot-scope="scope">
                                            <!-- <el-button v-show="listDataThiSinh.length>0" @click="scope.row.edit= !scope.row.edit" >
                                                <i class="el-icon-edit"></i> 
                                                Cập nhật 
                                                <el-switch
                                                
                                                :value="!scope.row.edit"
                                                active-color="#13ce66"
                                                inactive-color="#ff4949">
                                                </el-switch>
                                            </el-button> -->
                                            <el-popconfirm                                            
                                                confirm-button-text='Xóa'
                                                cancel-button-text='Không'
                                                :title="'Bạn có chắc chắn muốn xóa ?'"
                                                @confirm="()=>deleteRow(scope)"
                                            >
                                                <el-button slot="reference" type="danger" style="height: 38px;"><i class="el-icon-delete"></i> Xóa</el-button>
                                            </el-popconfirm>
                                        </template>
                                    </el-table-column>
                                </el-table>                                                               
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
                    <el-button @click="$router.push({name:'DanhSachThiSinh'})">Đóng</el-button>
                </div>
            </div>

            <!-- dialog -->
            <el-dialog :visible.sync="validDialogUpload" width="50vw">
            <div style="margin-top: -30px">
                <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">Import file excel</span>                
                <el-divider></el-divider>
            </div>
            <div>
                <el-upload                    
                    accept=".xls,.xlsx,.csv"
                    class="upload-demo"
                    drag
                    action=""
                    :limit="1"
                    :on-change="importExcel"
                    :auto-upload="false"
                    :on-remove="handleRemove"
                    :before-upload="beforeUpload"
                    :file-list="fileList">
                    <div @click="clearFile" style="height: 100%; width: 100%;">
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text"><em>Click to upload</em></div>
                    </div>
                   
                    <!-- <div class="el-upload__tip" slot="tip">pdf files with a size less than 500kb</div> -->
                </el-upload>
                <el-divider v-if="fileList"></el-divider>
                <el-button @click="downloadTemplate()"><i class="el-icon-download"></i>Tải file mẫu</el-button>
                <el-button v-show="fileList" style="margin-left: 10px;" size="small" type="success"
                           @click="uploadExcel()">Import file
                </el-button>
            </div>
        </el-dialog>
        </div>
    </div>

</template>

<script>
import { readonly } from 'vue';
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
            activeEdit:false,
            title:'THÊM MỚI THÍ SINH',           
            idUpdate: '',
            rules: {
                tenThiSinh: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},
                ],
                ngaySinh: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},
                ],
                gioiTinh: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},
                ],
                maKhoiThi: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},
                ],
                maNamHoc: [
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
            },
            data: [],
            filterDataCategorys: '',
            listNamHoc: [],
            listKhoiThi: [],             
            form:new FormData(),
            formData: {
                maThiSinh:'',
                tenThiSinh:'',
                ngaySinh:'',
                gioiTinh:'',
                CCCD:'',
                ketQua:'',
                ghiChu:'',
                maKhoiThi:'',
                maNamHoc:'',               
            },
            files: [],
            fileListOption: [],
            limitImg:1,
            fileList:[],
            dialogVisible:false,
            dialogImageUrl:false,
            validDialogUpload:false,
            listDataThiSinh:[],
            form: new FormData()
        }
    },
    async mounted() {
        this.title=this.$route.name=='UserUpdate'?'CẬP NHẬT THÔNG TIN THÍ SINH':'THÊM MỚI THÍ SINH'
        await this.getListNamHoc()
        await this.getListKhoiThi()
        if(this.$route.params.id){
            this.idUpdate=this.$route.params.id
            await this.getDetail(this.$route.params.id)
        }
    },
    methods: {
        downloadTemplate(){
            var link = document.createElement("a");
            link.href = '/excel/DanhSachThiSinh.xlsx'; // Set the file URL
            link.download = name;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            link.remove();
        },
        importExcel(e){           
            this.fileList = [event.target.files[0]]            
        },
        uploadExcel(){
            this.form.set('file', this.fileList[0])
            ApiService.post('/api/admin/danhsachthisinh/import',  this.form).then(({data}) => {
                if(data.success){
                    this.listDataThiSinh = data['data']
                    this.validDialogUpload = false
                }             
            })
        },
        beforeUpload(file) {
            if (this.fileList.length >= 1) {
                this.fileList.splice(0, 1); // Remove existing file
            }
            return true; // Allow upload
        },
        clearFile(){
            this.fileList = [];  
        },
        fakeLoading() {
            this.percentage = 0
            setInterval(() => {
                if (this.percentage < 100) {
                    this.percentage += 10;
                }
            }, 100);
        },
        handleRemove(el) {
            this.fileList = this.fileList.filter(e => e.uid != el.uid)           
        },
        handleSuccess(response, file, fileList) {
            console.log('File uploaded successfully!', response);
            // You can access the response data here, which will typically be the server response.
            if (response && response.success === true) {
                this.$notify({
                                title: 'Success',
                                message: response.data['mess'],
                                type: 'success'
                            });
                this.getList()
            } else {
                this.$notify({
                    title: 'Error',
                    message: 'Import thất bại, Vui lòng kiểm tra nội dung file',
                    type: 'error'
                });
            }
        },
        getDanhSachThiSinh(){
            let _this = this
            ApiService.query('/api/admin/danhsachthisinh/danhsach', {params: {maNamHoc: this.formData.maNamHoc,maKhoiThi:this.formData.maKhoiThi}}).then(({data}) => {
                _this.listDataThiSinh = data['data']              
            })
        },
        deleteRow(id){
            this.listDataThiSinh[id.$index] && this.listDataThiSinh.splice(id.$index,1)
            
        },
        async addRowList(){              
            this.listDataThiSinh.push({            
                tenThiSinh:'',
                gioiTinh:'',
                ngaySinh:'',
                CCCD:'',
                maNamHoc:'',
                maKhoiThi:'',  
                edit:false,            
            })
            this.activeEdit = true
        },
       
         //Custorm upload images
        handlePictureCardPreview(file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        handleUploadChange(file) {
            if (this.fileList.findIndex(e => e.uid == file.uid) == -1) {
                this.fileList.push(file)
            }
        },
        messLimit() {
            this.$notify({
                title: 'Error',
                message: 'Không upload số lượng ảnh vượt quá mức cho phép',
                type: 'error'
            });
        },
        uploadFile(i) {
            // this.$refs['uploadFile'+i]
            this.$refs['uploadFile' + i][0].click();
        },
        clearImage(i){      
            this.fileListOption.splice(i, 1,null); 
        },
        handleFileUpload(event, index) {
            // Get the uploaded file
            const file = event.target.files[0]
            // Update the files array with the new file
            this.$set(this.fileListOption, index, file)           
          
        },  
        removeImg(el) {           
            if (el.url) {
                this.formData.delete_image=(el.url)
            }
            this.fileList = this.fileList.filter(e => e.uid != el.uid)
            // ApiService.post('/api/admin/removeFile', { path: el.url })
        },

        fileUrl(index) {
            // Get the URL for the uploaded file
            if (this.fileListOption[index] && this.fileListOption[index] instanceof File) {
                return URL.createObjectURL(this.fileListOption[index])
            }else{
                return this.fileListOption[index]
            }
        },

        handleSubmit(event) {
            event.preventDefault()
            // Handle form submission here
        },
        resetForm(formName) {            
            this.$refs[formName].resetFields();
        },
       
        async getListNamHoc(id, update) {
            let _this = this
            ApiService.query('/api/admin/danhsachnamhoc', {params: {type: 'data'}}).then(({data}) => {
                _this.listNamHoc = data['data']              
            })

        },
        async getListKhoiThi(id, update) {
            let _this = this
            ApiService.query('/api/admin/danhsachkhoithi', {params: {type: 'data'}}).then(({data}) => {
                _this.listKhoiThi = data['data']              
            })

        },       
        async getDetail(id) {
            let _this = this
            _this.idUpdate = id
            await axios({
                method: 'get',
                url: '/api/admin/danhsachthisinh/detail/' + id,
            })
                .then(({data}) => {                  
                    if (data['success']) {
                        let res = data['data']
                        _this.formData.maThiSinh=res['maThiSinh'],
                        _this.formData.tenThiSinh=res['tenThiSinh'],
                        _this.formData.ngaySinh=res['ngaySinh'],
                        _this.formData.gioiTinh=res['gioiTinh'],
                        _this.formData.CCCD=res['CCCD'],
                        _this.formData.ghiChu=res['ghiChu'],
                        _this.formData.maKhoiThi=res['maKhoiThi'],
                        _this.formData.maNamHoc=res['maNamHoc']                     
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
            if(this.listDataThiSinh.length>0){
                _this.form.set('ListThiSinh',JSON.stringify(this.listDataThiSinh))
            } else{
                _this.form.set('ListThiSinh','clear')
            }              
            
        },
        create() {
            let _this = this
            _this.appendToFormData()                
            this.$refs['formData'].validate((valid) => {
                if (valid) {
                    axios({
                        method: 'post',
                        url: '/api/admin/danhsachthisinh/create',
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
                                _this.$router.push({name:"DanhSachThiSinh"})
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
            _this.appendFileToFormData()           
            this.$refs['formData'].validate((valid) => {
                if (valid) {
                    axios({
                        method: 'post',
                        url: '/api/admin/danhsachthisinh/update/' + _this.idUpdate,
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
                                _this.$router.push({name:"DanhSachThiSinh"})
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
.custorm-upload .el-upload--picture-card {
    width: 120px;
    height: unset;
    line-height: 10px;
    padding: 25px;
}

.custorm-upload .el-upload-list--picture-card .el-upload-list__item {
    width: 120px;
    height: 120px;
}
.box-image-option:hover .overlay-remove{
    opacity:1 !important;
    background-color:rgb(0,0,0,0.3)!important;
    color:#fff;
    transition: all 0.9ms linear;
}
</style>
