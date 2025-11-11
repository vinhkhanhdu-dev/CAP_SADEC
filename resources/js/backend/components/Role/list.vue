<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                    <h3 class="card-title">LIST ROLE</h3>
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
                            <div class="row" style="display: flex; flex-wrap: nowrap;">
                                <el-input
                                    placeholder="Nhập kí tự cần tìm kiếm..."
                                    v-model="filterDataCategorys">
                                </el-input>
                                <el-button @click="$router.push({name:'RoleCreate'})" class="ml-2" type="primary"><i
                                    class="el-icon-plus"></i> Thêm mới
                                </el-button>
                            </div>
                            <el-divider></el-divider>
                            <el-tree
                                ref="tree"
                                empty-text="Không tìm thấy !"
                                :filter-node-method="filterNode"
                                v-show="data"
                                :data="data"
                                :show-checkbox="false"
                                node-key="id"
                                class="tree-module"
                                default-expand-all
                                :expand-on-click-node="false">
                                <span class="custom-tree-node" slot-scope="{ node, data }">
                                <span><i v-if="data.icon" :class="data.icon"></i> <span style="font-weight: bold; ">{{ data.code }}</span>{{' | '+ data.name }}</span>
                                <span>                            
                                        
                                    <el-button      
                                        type="text"                                      
                                        size="mini"
                                        style="color:green"
                                        @click="() => getDetail(data.id)">
                                        <i class="el-icon-edit"></i> Cập nhật
                                    </el-button>                         
                                    <el-divider direction="vertical"></el-divider>
                                    <el-popconfirm
                                        confirm-button-text='Xóa'
                                        cancel-button-text='Không'
                                        :title="'Bạn có chắc chắn muốn xóa danh mục *'+data.title+ '* không ?'"
                                        @confirm="()=>deleteCategory(data.id)"
                                    >
                                    <el-button slot="reference" style="color: red;" type="text"                 
                                                size="mini"><i class="el-icon-delete"></i> Xóa</el-button>
                                    </el-popconfirm>
                                </span>
                                </span>
                            </el-tree>
                        </div>
                    </div>
                    <!-- /.row -->
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
            rules: {
                title: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'blur'},                  
                ],              
                level: [
                    {required: true, message: 'Vui lòng không bỏ trống', trigger: 'change'},
                ],
            },
            data: [],
            filterDataCategorys: '',          
        }
    },
    mounted() {
        this.getList()         
    },
    methods: {     
        filterNode(value, data) {
            if (!value) return true;
            return data.name.indexOf(value) !== -1;
        },      
        getList() {
            let _this = this          
            ApiService.query('/api/admin/role', {params: {type: 'treeData'}}).then(({data}) => {
                _this.data = data['data']
            })
        },         
        async getDetail(id) {
            this.$router.push({name:'RoleUpdate',params:{id:id}}).catch(()=>{})
        },
        deleteCategory(id) {
            let _this = this
            axios({
                method: 'post',
                url: '/api/admin/role/delete/' + id,
                responseType: 'stream'
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
.tree-module .el-tree-node__content{
    height: 40px;
    /* border: 1px dotted rgb(0,0,0,0.2);
    border-radius: 5px;
    margin-bottom: 5px; */
   
}
.custom-tree-node{
    /* border-bottom: 1px solid rgba(53, 191, 7, 0.2); */
   
}
.el-tree-node__content:hover, .el-upload-list__item:hover {
    background-color:transparent !important;
}
</style>
