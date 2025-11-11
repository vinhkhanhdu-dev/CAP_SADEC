<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                    <h3 class="card-title">DANH SÁCH THÍ SINH</h3>
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
                            <div class="row"
                                 style="display: flex; flex-wrap: nowrap; padding: 8px; justify-content: space-between">
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
                                <div>        
                                    <el-button @click="$router.push({name:'DanhSachThiSinhCreate'})" class="ml-2"
                                               type="primary"><i
                                        class="el-icon-plus"></i> Thêm mới
                                    </el-button>
                                </div>

                            </div>
                            <el-table
                                empty-text="Chưa có dữ liệu !"
                                :data="tableData"
                                style="width: 100%"
                                border
                                :resizable="true"
                                v-loading="loadingTable"
                                :row-class-name="tableRowClassName">

                                <el-table-column
                                    prop="tenKhoiThi"
                                    label="KHỐI/LỚP"
                                    sortable
                                >                                   
                                </el-table-column>
                                <el-table-column
                                    prop="tenNamHoc"
                                    label="NĂM HỌC"
                                    sortable
                                >
                                </el-table-column> 
                                <el-table-column
                                    prop="ghiChu"
                                    label="GHI CHÚ"
                                    sortable
                                >
                                </el-table-column>   
                                <el-table-column
                                    label="THAO TÁC"
                                    width="420px"
                                >
                                    <template slot-scope="scope">     
                                        <el-button                                          
                                            type="primary"
                                            size="mini"
                                            @click="sapPhongThi(scope.row)"><i class="el-icon-finished"></i> Sắp phòng thi
                                        </el-button>       
                                        <el-button                                          
                                            type="primary"
                                            size="mini"
                                            @click="openDialogList(scope.row)"><i class="el-icon-finished"></i> Xem danh sách
                                        </el-button>                              
                                      
                                        <el-button                                          
                                            type="primary"
                                            size="mini"
                                            @click="update(scope.row)"><i class="el-icon-edit"></i>
                                        </el-button>
                     
                                        <el-popconfirm                                            
                                            confirm-button-text='Xóa'
                                            cancel-button-text='Không'
                                            :title="'Bạn có chắc chắn muốn xóa ?'"
                                            @confirm="()=>deleteBanner(scope.row)"
                                        >
                                            <el-button slot="reference" type="danger"
                                                       size="mini"><i class="el-icon-delete"></i>
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
     
       
        <el-dialog :visible.sync="validDialogDanhSach" width="50vw">
            <div style="margin-top: -30px">
                <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">DÁNH SÁCH THÍ SINH {{ dataActiveList.tenKhoiThi }} ({{ dataActiveList.tenNamHoc }})</span>
                <el-divider></el-divider>
            </div>
            <div>               
                <el-table
                    :data="listDataThiSinh"
                    border
                    height="400px"
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
                    </el-table-column>
                    <el-table-column
                    prop="gioiTinh"
                    label="Giới Tính"
                    >                                     
                    </el-table-column>
                    <el-table-column
                    prop="ngaySinh"
                    label="Ngày Sinh"
                    >                                      
                    </el-table-column>
                    <el-table-column
                    prop="noiSinh"
                    label="Nơi Sinh"
                    >                                       
                    </el-table-column>   
                    <el-table-column
                    prop="CCCD"
                    label="CCCD"
                    >                                       
                    </el-table-column>   
                </el-table>                   
            </div>
        </el-dialog>

        <el-dialog :visible.sync="validSapPhongThi" width="50vw">
            <sapPhongThi @close="validSapPhongThi = false" :trigerReload="trigerReload" :dataParams="dataActiveList"></sapPhongThi>
        </el-dialog>
    </div>

</template>

<script>
import ApiService from '../../common/api.service';
import formData from "./form";
import VueQRCodeComponent from 'vue-qrcode-component'
import {PDFDocument, rgb} from 'pdf-lib';
import genPdfFunction from '../../common/genPdfFunction';
import commonFn from '../../common/commonFn';
import sapPhongThi from './sapPhongThi.vue';
export default {
    components: {formData, VueQRCodeComponent, sapPhongThi},
    mixins:[genPdfFunction, commonFn],
    data() {
        return {
            fileList: [],
            idUpdate: '',
            outerVisible: false,
            viewPdf: false,
            loadingTable: false,
            tableData: [],
            slideData: [],
            textSearch: '',
            currentPage: 1,
            options: {
                Total: 10,
                Page: 1,
                PageLimit: 10
            },
            pdfSrc: '',
            qrValue: 'https://example.com',
            publicKey: '',
            signature: '',
            validDialog: false,
            validDialogDanhSach: false,
            validSapPhongThi: false,
            statusValid: '',
            percentage: 0,
            dataActiveList:'',
            listDataThiSinh:[],
            trigerReload : new Date().getTime(),

        }
    },
    mounted() {  
        this.getList()        
    },

    methods: {
        async getDanhSachThiSinh(maKhoiThi, maNamHoc){
            let _this = this
            await ApiService.query('/api/admin/danhsachthisinh/danhsach', {params: {maNamHoc: maNamHoc,maKhoiThi: maKhoiThi}}).then(({data}) => {
                _this.listDataThiSinh = data['data']              
            })
        },
        async openDialogList(e){
            this.validDialogDanhSach = true
            this.dataActiveList = e
            await this.getDanhSachThiSinh(this.dataActiveList.maKhoiThi, this.dataActiveList.maNamHoc)
        },
        async sapPhongThi(e){
            this.validSapPhongThi = true
            this.dataActiveList = e
            this.trigerReload = new Date().getTime()
            console.log(this.trigerReload);
            
            // await this.getDanhSachThiSinh(this.dataActiveList.maKhoiThi, this.dataActiveList.maNamHoc)
        },
        // Handle file upload success
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

        beforeUpload(file) {
            if (this.fileList.length >= 1) {
                this.fileList.splice(0, 1); // Remove existing file
            }
            return true; // Allow upload
        },
        clearFile(){
            this.fileList = [];   
            this.publicKey=''
            this.signature=''         
            this.statusValid=''         
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
            this.publicKey = this.signature = this.statusValid = ''
        },
        success() {
            this.outerVisible = false
            this.getList()
        },
        update(e) {
            this.$router.push({name: 'DanhSachThiSinhUpdate', params: {maNamHoc: e.maNamHoc, maKhoiThi:e.maKhoiThi}})
        },
        handleSizeChange(val) {
            this.options.PageLimit = val
            this.getList()
        },
        handleCurrentChange(val) {
            this.options.Page = val
            this.getList()
        },
      
        deleteBanner(data) {
            let _this = this
            axios({
                method: 'post',
                url: '/api/admin/danhsachthisinh/delete',
                data: data

            })
                .then(function (response) {
                    if (response.data['success']) {
                        _this.$notify({
                            title: 'Success',
                            message: response.data['mess'],
                            type: 'success'
                        });
                        _this.getList()
                    } else {
                        _this.$notify({
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
            this.options.Page && (param.Page = this.options.Page)
            this.options.PageLimit && (param.PageLimit = this.options.PageLimit)
            this.textSearch && (param.TextSearch = this.textSearch)
            axios({
                method: 'get',
                url: '/api/admin/danhsachthisinh',
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

<style lang="scss">
.el-table .warning-row {
    background: oldlace;
}

.el-table .success-row {
    background: #f0f9eb;
}

.dialog-pdf-viewer {
    .el-dialog__body {
        padding: 0 !important
    }

    .el-dialog__header {
        display: none;
    }
}

</style>
