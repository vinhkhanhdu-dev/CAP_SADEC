<template>
    <div>
        <el-steps :active="active" align-center>
        <el-step title="Bước 1" description="Chọn thông tin"></el-step>
        <el-step title="Bước 2" description="Danh sách thí sinh"></el-step>
        <el-step title="Bước 3" description="Phòng và môn thi"></el-step>
        <el-step title="Bước 4" description="Hoàn tất"></el-step>
        </el-steps>
        <div v-show="active==0" class="mt-2">
            <el-divider></el-divider>
            <span style="font-weight: bold; text-transform: uppercase;">Chọn thông tin sắp phòng thi</span>
            <el-divider></el-divider>
            <div class="form-group">
                <el-select :disabled="false" style="width: 100%" v-model="maDonVi" size="large"
                            filterable 
                            placeholder="Chọn đơn vị">
                    <el-option
                        v-for="item in listDonVi"
                        :key="item.id"
                        :label="item.maDonVi + ' | ' + item.tenDonVi"
                        :value="item.maDonVi"
                    >                                            
                    </el-option>
                </el-select>
            </div>
            <div class="form-group">
                <el-select :disabled="false" style="width: 100%" v-model="maKyThi" size="large"
                            filterable 
                            placeholder="Chọn kỳ thi">
                    <el-option
                        v-for="item in listKyThi"
                        :key="item.id"
                        :label="item.maKyThi + ' | ' + item.tenKyThi"
                        :value="item.maKyThi"
                    >                                            
                    </el-option>
                </el-select>
            </div>
            <div class="form-group">
                <el-select :disabled="true" style="width: 100%" v-model="maKhoiThi" size="large"
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
            <div class="form-group">
                <el-select :disabled="true" style="width: 100%" v-model="maNamHoc" size="large"
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
            <el-button style="margin-top: 12px;" @click="next">Bước tiếp theo</el-button>
        </div>
        <div v-show="active==1" class="mt-2" style="max-height: 400px;">
            <el-divider></el-divider>
            <span style="font-weight: bold; text-transform: uppercase;">Danh sách thí sinh</span>
            <el-divider></el-divider>
            <el-table
                :data="listDataThiSinh"
                border
                height="250"
                style="width: 100%;">
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
                prop="CCCD"
                label="CCCD"
                >                                       
                </el-table-column>   
            </el-table>  
            <el-button style="margin-top: 12px;" @click="next">Bước tiếp theo</el-button> 
        </div>
        <div v-show="active==2" class="mt-2" style="max-height: 400px;">
            <el-divider></el-divider>
                <span style="font-weight: bold; text-transform: uppercase;">Chọn môn thi</span>
            <el-divider></el-divider>
            <el-checkbox-group v-model="monThi" >
                <el-checkbox v-for="item in listMonThi" :key="item.maMonHoc" :label="item.maMonHoc">{{ item.tenMonHoc }}</el-checkbox>                
            </el-checkbox-group>
            <el-divider></el-divider>
                <span style="font-weight: bold; text-transform: uppercase;">Chọn phòng thi</span>
            <el-divider></el-divider>
            <el-checkbox-group v-model="phongThi" >
                <el-checkbox v-for="item in listPhongThi" :key="item.maPhongThi" :label="item.maPhongThi">{{ item.tenPhongThi }}</el-checkbox>                
            </el-checkbox-group>
            <el-button style="margin-top: 12px;" @click="sapPhongThi()">Sắp phòng thi</el-button>
        </div>
        <div v-show="active==3" class="mt-2" style="max-height: 400px; display: flex; justify-content: center;align-items: center;">
            <div v-if="loading">
                 <lottie-animation style="width: 300px; height: 300px;" ref="anim"
                    :animationData="require('../../../common/Animation - 1731050852688.json')" />
                    <br>         
                    <span>Đang sắp xếp phòng thi, Vui lòng đợi</span>
            </div>              
        </div>   
        <div v-show="active==4" class="mt-2" style="max-height: 400px; display: flex; justify-content: center;align-items: center;">
            <el-result icon="success" title="Thành công" subTitle="Sắp xếp phòng thi hoàn tất">
            <template slot="extra">
                <el-button type="primary" size="medium" @click="hoanTat">Hoàn tất</el-button>
            </template>
            </el-result>
        </div>        
       
    </div>
     
</template>
<script>
import ApiService from '../../common/api.service';
import LottieAnimation from 'lottie-web-vue'
    export default{
        components:{LottieAnimation},
        name:'sapPhongThi',
        props:['trigerReload','dataParams'],
        data(){
            return{
                listNamHoc:'',
                listKhoiThi:'',
                listDonVi:'',
                listKyThi:'',
                maKhoiThi:'',
                maNamHoc:'',
                active: 0,
                listDataThiSinh:[],
                listMonThi:[],
                listPhongThi:[],
                phongThi:[],
                monThi:[],
                maDonVi:'',
                maKyThi:'',
                form:new FormData(),
                loading:false
            }
        },
        watch:{
            trigerReload(e){
                this.active = 0               
                this.initPage()
            },
            active(e){
                if(this.active==1){
                    this.getDanhSachThiSinh()
                }else if(this.active == 2){
                    this.getListMonThi()                
                    this.getListPhongThi()
                }else if(this.active == 3){
                }
            }
        },
        mounted(){
            this.initPage()
        },
        methods:{              
            hoanTat(){
                this.active=3
                this.$emit('close')
            },     
            next() {
                if (this.active++ > 2) this.active = 0;
            },
            async initPage(){
                await this.getListKhoiThi()
                await this.getListNamHoc()
                await this.getListDonVi()
                await this.getListKyThi()
                this.maNamHoc = this.dataParams.maNamHoc
                this.maKhoiThi = this.dataParams.maKhoiThi
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
                    console.log(data);
                           
                })
            },     
            async getListDonVi() {
                let _this = this
                ApiService.query('/api/admin/thongtindonvi', {params: {type: 'data'}}).then(({data}) => {
                    _this.listDonVi = data['data']       
                    console.log(data);
                           
                })
            },     
            async getListKyThi() {
                let _this = this
                ApiService.query('/api/admin/danhsachkythi', {params: {type: 'data'}}).then(({data}) => {
                    _this.listKyThi = data['data']       
                    console.log(data);
                           
                })
            },     
            getDanhSachThiSinh(){
                let _this = this
                ApiService.query('/api/admin/danhsachthisinh/danhsach', {params: {maNamHoc: this.maNamHoc,maKhoiThi:this.maKhoiThi}}).then(({data}) => {
                    _this.listDataThiSinh = data['data']              
                })
            },  

            sapPhongThi(){
                this.loading=true
                this.active = 3
                this.form =new FormData()                
                this.form.set('maNamHoc', this.maNamHoc)
                this.form.set('maKhoiThi', this.maKhoiThi)
                this.form.set('maDonVi', this.maDonVi)
                this.form.set('maKyThi', this.maKyThi)
                this.form.set('phongThi',JSON.stringify(this.phongThi) )
                this.form.set('monThi',JSON.stringify(this.monThi))
                this.form.set('danhSachThiSinh',JSON.stringify(this.listDataThiSinh))                  
                ApiService.post('/api/admin/sapphongthi',  this.form).then(({data}) => {
                    this.loading = false
                    this.active = 4
                })
            }
        }

    }
</script>