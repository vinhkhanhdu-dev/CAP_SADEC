<template>
    <div class="form_product_color">
        <div style="margin-top: -30px">
            <span style="font-size: 13px; font-weight: bold; text-transform: uppercase">{{ title }}</span>
            <el-divider></el-divider>
        </div>
        <el-form :model="form" ref="form" label-width="120px" class="demo-ruleForm">
           
            <el-form-item :rules="requiredForm" label="Mã action" prop="code">
                <el-input v-model="form.code" :disabled="false"></el-input>
            </el-form-item>
            <el-form-item :rules="requiredForm" label="Tên action" prop="name">
                <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="Module cha" prop="module_code">
                <el-input :disabled="true" v-model="form.module_code"></el-input>
            </el-form-item>
            <el-form-item label="Loại action" prop="type">
                <div class="form-group">
                    <el-select style="width: 100%" v-model="form.type" size="large"
                                filterable 
                                placeholder="Chọn loại action">
                        <el-option
                            v-for="item in listAction"
                            :key="item.id"
                            :label="item.title"
                            :value="item.id"
                        >                                            
                        </el-option>
                    </el-select>
                </div>
            </el-form-item>
         
        </el-form>
        <div style="display: flex; justify-content: end">
            <el-button type="primary" @click="submit">Lưu lại</el-button>
            <el-button @click="$refs.form.resetFields()">Reset Form</el-button>
        </div>
    </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'
import ApiService from '../../common/api.service'
export default {
    name: "create_update",
    components: {
        VueUploadMultipleImage,
    },
    props: ['resID','triggerLoad'],
    data() {
        return {
            title: '',
            form: {
                name: '',
                code: '',
                type:'',
                module_code: this.$route.params.id_module
            },
            formData: new FormData(),
            requiredForm: { required: true, message: 'Vui lòng không bỏ trống!', trigger: 'blur' },
            listAction:[
                {id:1, title:'Thêm'},
                {id:2, title:'Xóa'},
                {id:3, title:'Cập nhật'},
                {id:4, title:'Khác'},
            ]
        }
    },
    mounted() {
        if (this.resID) {
            this.title = 'Cập nhật action'
            this.getDetail(this.resID)
        } else {
            this.title = 'Thêm mới action'
            this.genCode()
            this.$refs.form.resetFields()
        }
    },
    watch: {
        resID(e) {
            this.form.title= '',
            this.form.value= '',
            this.images= []
            if (e) {
                this.title = 'Cập nhật màu sản phẩm'
                this.getDetail(e)
            } else {
                this.title = 'Thêm mới màu sản phẩm'
                this.genCode()
            }
           
        },
        triggerLoad(e){       
            this.title= '',
            this.value= '',
            this.images=[]
            if (this.resID) {
                this.title = 'Cập nhật màu sản phẩm'
                this.getDetail(this.resID)
            } else {
                this.title = 'Thêm mới màu sản phẩm'
                this.genCode()
            }
            
           
        }
    },
    methods: {
        // convert base64 to file
        dataURLtoFile(dataurl, filename) {
            var arr = dataurl.split(','),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n);

            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, { type: mime });
        },
        uploadImageSuccess(formData, index, fileList) {
            this.form.image = this.dataURLtoFile(fileList[0].path, fileList[0].name);
            // console.log('data', formData, index, fileList)
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
        },
        beforeRemove(index, done, fileList) {
            done()            
            this.form.image = '';
        },
        appendToFormData() {
            let _this = this
            _this.formData =new FormData()
            Object.keys(this.form).forEach(key => {   
                if(this.form[key]){
                     _this.formData.set(key, this.form[key])
                }             
               
            });          
        },
        async genCode() {
            let _this = this
            ApiService.query('/api/admin/action/gen_code').then(({data}) => {
                _this.form.code = data
            })
        },
        submit() {
            let _this = this
            let url
            this.appendToFormData()
            url = this.resID ? ('/api/admin/action/update/' + this.resID) : '/api/admin/action/create'
            this.$refs['form'].validate((valid) => {
                if (valid) {
                    axios({
                        method: 'post',
                        url: url,
                        data: _this.formData
                    })
                        .then(function (response) {
                            if (response.data['success']) {
                                _this.$notify({
                                    title: 'Success',
                                    message: response.data['mess'],
                                    type: 'success'
                                });

                                _this.$emit('success')
                                _this.$refs.form.resetFields()
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
        async getDetail(id) {
            let _this = this
            await axios({
                method: 'get',
                url: '/api/admin/product_color/detail/' + id,
            })
                .then(({ data }) => {
                    if (data['success']) {
                        let res = data['data']
                        _this.form.title = res['title']
                        _this.form.value = res['value']
                        res['image'] && (_this.images = [{path:res['image']}])

                    }
                });

        },
    }
}
</script>

<style scoped></style>
