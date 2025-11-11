<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                    <h3 class="card-title">DANH SÁCH NĂM HỌC</h3>
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
                                <!-- <el-input
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
                                </el-input> -->

                                <div>
                                    <el-select clearable :disabled="false" style="width: 300px" v-model="formSearch.maDonVi" size="small"
                                        filterable placeholder="Chọn đơn vị">
                                        <el-option v-for="item in listDonVi" :key="item.id"
                                            :label="item.maDonVi + ' | ' + item.tenDonVi" :value="item.maDonVi">
                                        </el-option>
                                    </el-select>
                                    <!-- </div> -->

                                    <el-select clearable :disabled="false" style="width: 250px" v-model="formSearch.maKyThi" size="small" filterable
                                        placeholder="Chọn kỳ thi">
                                        <el-option v-for="item in listKyThi" :key="item.id"
                                            :label="item.maKyThi + ' | ' + item.tenKyThi" :value="item.maKyThi">
                                        </el-option>
                                    </el-select>


                                    <el-select clearable :disabled="false" style="width: 250px" v-model="formSearch.maKhoiThi" size="small" filterable
                                        placeholder="Chọn khối thi">
                                        <el-option v-for="item in listKhoiThi" :key="item.id"
                                            :label="item.maKhoiThi + ' | ' + item.tenKhoiThi" :value="item.maKhoiThi">
                                        </el-option>
                                    </el-select>


                                    <el-select clearable :disabled="false" style="width: 250px" v-model="formSearch.maNamHoc" size="small" filterable
                                        placeholder="Chọn năm học">
                                        <el-option v-for="item in listNamHoc" :key="item.id"
                                            :label="item.maNamHoc + ' | ' + item.tenNamHoc" :value="item.maNamHoc">
                                        </el-option>
                                    </el-select>
                                    <el-select clearable :disabled="false" style="width: 250px" v-model="formSearch.maMonHoc" size="small" filterable
                                        placeholder="Chọn môn học">
                                        <el-option v-for="item in listMonThi" :key="item.id"
                                            :label="item.maMonHoc + ' | ' + item.tenMonHoc" :value="item.maMonHoc">
                                        </el-option>
                                    </el-select>
                                    
                                </div>

                                <el-button type="primary" @click="getList()">
                                    <i class="el-icon-search"></i> Tìm kiếm
                                </el-button>
                            <!-- <el-button @click="outerVisible = true; idUpdate = ''; trigger = new Date().getTime()"
                                class="ml-2" type="primary"><i class="el-icon-plus"></i> Thêm mới
                            </el-button> -->
                        </div>
                        <el-table empty-text="Chưa có dữ liệu !" :data="tableData" style="width: 100%" border
                            :resizable="true" v-loading="loadingTable" :row-class-name="tableRowClassName">

                            <el-table-column prop="don_vi.tenDonVi" label="ĐƠN VỊ" sortable>
                            </el-table-column>
                            <el-table-column prop="nam_hoc.tenNamHoc" label="NĂM HỌC" sortable>
                            </el-table-column>
                            <el-table-column prop="mon_hoc.tenMonHoc" label="MÔN HỌC" sortable>
                            </el-table-column>
                            <el-table-column prop="khoi_thi.tenKhoiThi" label="KHỐI /LỚP" sortable>
                            </el-table-column>
                            <el-table-column prop="ky_thi.tenKyThi" label="KHỐI /LỚP" sortable>
                            </el-table-column>
                            <el-table-column prop="phong_thi.tenPhongThi" label="PHÒNG THI" sortable>
                            </el-table-column>
                            <el-table-column label="THAO TÁC" width="250">
                                <template slot-scope="scope">
                                    <el-button type="primary" size="mini" @click="openDialogList(scope.row)"><i
                                            class="el-icon-finished"></i> Xem danh sách
                                    </el-button>
                                    <!-- danhsachthisinh/deleteKQ -->
                                    <el-popconfirm
                                            confirm-button-text='Xóa'
                                            cancel-button-text='Không'
                                            :title="'Bạn có chắc chắn muốn xóa hình ảnh này ?'"
                                            @confirm="()=>deleteItem(scope.row)"
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
                        <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange"
                            :current-page.sync="currentPage" :page-sizes="[10, 20, 50, 100]"
                            :page-size="options.PageLimit" layout="total, sizes, prev, pager, next, jumper"
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
        <div style="margin-top: -30px; display: flex; justify-content: space-between;" v-if="dataActiveList">
            <div>
                <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">DANH SÁCH THÍ SINH {{
                dataActiveList.khoi_thi.tenKhoiThi }} - {{ dataActiveList.phong_thi.tenPhongThi }}</span>
                <br>
                <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">ĐƠN VỊ: {{
                    dataActiveList.don_vi.tenDonVi }} </span>
                <br>
                {{ dataActiveList.ky_thi.tenKyThi }} - ({{ dataActiveList.nam_hoc.tenNamHoc }})
                <br>
                <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">Môn thi: {{
                    dataActiveList.mon_hoc.tenMonHoc }} </span>
            </div>
            <div class="pr-3">
                <el-button type="primary" @click="downloadMau1()"><i class="el-icon-download"></i> Mau.1</el-button>    
                <el-button type="primary" @click="downloadMau2()"><i class="el-icon-download"></i> Mau.2</el-button>    
                <el-button type="primary" @click="downloadMau3()"><i class="el-icon-download"></i> Mau.3</el-button>
            </div>    

        </div>
        <el-divider></el-divider>
        <div>
            <el-table :data="listDataThiSinh" border style="width: 100%" height="400px">
                <el-table-column label="STT" width="50px">
                    <template slot-scope="scope">
                        <span>{{ scope.$index + 1 }}</span>
                    </template>
                </el-table-column>
                <el-table-column prop="thi_sinh.tenThiSinh" label="Tên Thí Sinh">
                </el-table-column>
                <el-table-column prop="thi_sinh.gioiTinh" label="Giới Tính">
                </el-table-column>
                <el-table-column prop="thi_sinh.ngaySinh" label="Ngày Sinh">
                </el-table-column>
                <el-table-column prop="thi_sinh.noiSinh" label="Nơi Sinh">
                </el-table-column>
                <el-table-column prop="thi_sinh.CCCD" label="CCCD">
                </el-table-column>
            </el-table>
        </div>
    </el-dialog>
    <el-dialog :visible.sync="outerVisible">
        <formData :resID="idUpdate" :trigger="trigger" @success="success" />
    </el-dialog>
    </div>

</template>

<script>
import ApiService from "../../common/api.service";
import formData from "./form";
export default {
    components: { formData },
    data() {
        return {
            trigger: new Date().getTime(),
            idUpdate: '',
            dataActiveList: '',
            outerVisible: false,
            loadingTable: false,
            validDialogDanhSach: false,
            tableData: [],
            listDataThiSinh: [],
            slideData: [],
            textSearch: '',
            currentPage: 1,
            options: {
                Total: 10,
                Page: 1,
                PageLimit: 10
            },
            listNamHoc:[],
            listKhoiThi:[],
            listDonVi:[],
            listKyThi:[],
            listMonThi:[],
            formSearch:{
                // maMonHoc:'MONTHI0003',
                // maNamHoc:'NH0002',
                // maKhoiThi:'KHOI0002',
                // maKyThi:'KTH0001',
                // maDonVi:'DV0001'
                maMonHoc:'',
                maNamHoc:'',
                maKhoiThi:'',
                maKyThi:'',
                maDonVi:''
            },
            form: new FormData()

        }
    },
    async mounted() {       
        await this.getListNamHoc()
        await this.getListKhoiThi()
        await this.getListMonThi()
        await this.getListPhongThi()
        await this.getListDonVi()
        await this.getListKyThi()
        await this.getList()
    },
    methods: {
        downloadMau1(){
            this.form.set('tenPhongThi',this.dataActiveList.phong_thi.tenPhongThi)
            this.form.set('tenDonVi',this.dataActiveList.don_vi.tenDonVi)
            this.form.set('tenKyThi',this.dataActiveList.ky_thi.tenKyThi)
            this.form.set('danhSachThiSinh',JSON.stringify(this.listDataThiSinh))
            ApiService.post('/api/admin/danhsachthisinh/exportMau1',this.form).then(({data})=>{
                if(data.success){
                    var link = document.createElement("a");
                    link.download = name;
                    link.href = data.url;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    link.remove();
                } else {                   
                    this.$notify({
                        title: 'Error',
                        message: `Xuất dữ liệu thất bại `,
                        type: 'error'
                    });
                }
            })
        },
        downloadMau2(){
            this.form.set('tenPhongThi',this.dataActiveList.phong_thi.tenPhongThi)
            this.form.set('tenDonVi',this.dataActiveList.don_vi.tenDonVi)
            this.form.set('tenKyThi',this.dataActiveList.ky_thi.tenKyThi)
            this.form.set('danhSachThiSinh',JSON.stringify(this.listDataThiSinh))
            ApiService.post('/api/admin/danhsachthisinh/exportMau2',this.form).then(({data})=>{
                if(data.success){
                    var link = document.createElement("a");
                    link.download = name;
                    link.href = data.url;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    link.remove();
                } else {                   
                    this.$notify({
                        title: 'Error',
                        message: `Xuất dữ liệu thất bại `,
                        type: 'error'
                    });
                }
            })
        },
        downloadMau3(){
            this.form.set('tenPhongThi',this.dataActiveList.phong_thi.tenPhongThi)
            this.form.set('tenDonVi',this.dataActiveList.don_vi.tenDonVi)
            this.form.set('tenKyThi',this.dataActiveList.ky_thi.tenKyThi)
            this.form.set('danhSachThiSinh',JSON.stringify(this.listDataThiSinh))
            ApiService.post('/api/admin/danhsachthisinh/exportMau3',this.form).then(({data})=>{
                if(data.success){
                    var link = document.createElement("a");
                    link.download = name;
                    link.href = data.url;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    link.remove();
                } else {                   
                    this.$notify({
                        title: 'Error',
                        message: `Xuất dữ liệu thất bại `,
                        type: 'error'
                    });
                }
            })
        },
        async getListNamHoc() {
            let _this = this
            ApiService.query('/api/admin/danhsachnamhoc', {params: {type: 'data'}}).then(({data}) => {
                _this.listNamHoc = data['data']              
            })

        },
        async getListKhoiThi() {
            let _this = this
            ApiService.query('/api/admin/danhsachkhoithi', {params: {type: 'data'}}).then(({data}) => {
                _this.listKhoiThi = data['data']              
            })
        },     
        async getListMonThi() {
            let _this = this
            ApiService.query('/api/admin/danhsachmonthi', {params: {type: 'data'}}).then(({data}) => {
                _this.listMonThi = data['data']              
            })
        },     
        async getListPhongThi() {
            let _this = this
            ApiService.query('/api/admin/danhsachphongthi', {params: {type: 'data'}}).then(({data}) => {
                _this.listPhongThi = data['data']     
            })
        },     
        async getListDonVi() {
            let _this = this
            ApiService.query('/api/admin/thongtindonvi', {params: {type: 'data'}}).then(({data}) => {
                _this.listDonVi = data['data']  
            })
        },     
        async getListKyThi() {
            let _this = this
            ApiService.query('/api/admin/danhsachkythi', {params: {type: 'data'}}).then(({data}) => {
                _this.listKyThi = data['data'] 
            })
        },     
        async openDialogList(e) {
            this.validDialogDanhSach = true
            this.dataActiveList = e
            await this.getDanhSachThiSinh(this.dataActiveList)
        },
        async getDanhSachThiSinh(data) {
            let _this = this
            await ApiService.query('/api/admin/danhsachthisinhthuocphongthi', {
                params:
                {
                    maNamHoc: data.maNamHoc,
                    maKhoiThi: data.maKhoiThi,
                    maMonHoc: data.maMonHoc,
                    maPhongThi: data.maPhongThi,
                    maKyThi: data.maKyThi,
                    maDonVi: data.maDonVi,
                }
            }).then(({ data }) => {
                _this.listDataThiSinh = data['data']
            })
        },
        success() {
            this.outerVisible = false
            this.getList()
        },
        update(e) {
            this.idUpdate = e.id
            this.outerVisible = true
            this.trigger = new Date().getTime()
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
                url: '/api/admin/danhsachnamhoc/update/' + id,
                data: formData
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
        deleteItem(e) {
            this.dataActiveList = e
            let _this = this
            axios({
                method: 'post',
                url: '/api/admin/danhsachthisinh/deleteKQ',
                data: e
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
            this.formSearch && (param.formSearch = this.formSearch)
            axios({
                method: 'get',
                url: '/api/admin/ketquasapphongthi',
                params: param
            })
                .then(function ({ data }) {
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
        tableRowClassName({ row, rowIndex }) {
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
