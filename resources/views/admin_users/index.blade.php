@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="p-5">
        <div class="flex items-center justify-between">
            <div class="space-x-2">
                <el-button @click="onAddButtonClick" type="primary" icon="el-icon-plus">添加</el-button>
                <el-button @click="onRefreshButtonClick" :loading="statuses.refresh" icon="el-icon-refresh">刷新</el-button>
            </div>
        </div>

        <el-table :data="lists.data" v-loading="statuses.refresh" border class="mt-3">
            <el-table-column type="selection" align="center"></el-table-column>
            <el-table-column prop="id" label="ID" width="80" align="center"></el-table-column>
            <el-table-column prop="name" label="名称"></el-table-column>
            <el-table-column prop="created_at" label="创建时间" align="center"></el-table-column>
            <el-table-column prop="updated_at" label="更新时间" align="center"></el-table-column>
            <el-table-column label="操作" align="center">
                <div slot-scope="scope" class="space-x-2">
                    <el-button @click="onEditButtonClick(scope.row)" type="primary" size="mini">修改</el-button>
                    <el-popconfirm title="删除后无法恢复，确定要删除吗？" @confirm="onDelete(scope.row)">
                        <el-button slot="reference" :loading="statuses['delete_'+scope.row.id]" type="danger" size="mini">删除</el-button>
                    </el-popconfirm>
                </div>
            </el-table-column>
        </el-table>

        <div class="bg-gray-50 p-2 mt-3">
            <el-pagination
                    background
                    :layout="lists.pageable ? 'total, prev, pager, next, jumper' : 'total, prev, pager, next'"
                    :total="lists.total"
                    :current-page.sync="lists.page"
                    :page-size.sync="lists.size"
                    @size-change="onPaginationSizeChange"
                    @current-change="onPaginationCurrentChange"
            >
            </el-pagination>
        </div>

        <el-dialog title="编辑用户" :visible.sync="editDialog.visible" width="50%" @opened="onEditDialogOpened">

            <el-form ref="form" :model="formData" :rules="formRules[formMode]">
                <el-form-item prop="name" label="名称">
                    <el-input v-model="formData.name" placeholder="用户名称"></el-input>
                </el-form-item>

                <el-form-item prop="password" label="密码">
                    <el-input v-model="formData.password" placeholder="登录密码" show-password></el-input>
                </el-form-item>
            </el-form>

            <div slot="footer" class="flex items-center justify-between">
                <div></div>
                <div class="space-x-2">
                    <el-button @click="editDialog.visible = false">取消</el-button>
                    <el-button type="primary" @click="onSave" :loading="statuses.save">保存</el-button>
                </div>
            </div>
        </el-dialog>
    </div>

    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    formMode: 'add',
                    formData: {},
                    formRules: {
                        add: {
                            name: [
                                {required: true, message: '名称不能为空', trigger: 'blur'},
                            ],
                            password: [
                                {required: true, message: '密码不能为空', trigger: 'blur'},
                            ],
                        },
                        edit: {
                            name: [
                                {required: true, message: '名称不能为空', trigger: 'blur'},
                            ],
                        }
                    },
                    lists: {
                        pageable: true,
                        size: 1,
                    },
                    editDialog: {
                        visible: false,
                    },
                }
            },

            methods: {
                onAddButtonClick() {
                    this.formMode = 'add'
                    this.formData = {}
                    this.editDialog.visible = true
                },

                onEditButtonClick(row) {
                    this.formMode = 'edit'
                    this.editDialog.visible = true
                    this.formData = Object.assign({}, row)
                },

                onEditDialogOpened() {
                    this.$refs.form.clearValidate()
                },

                onRefreshButtonClick() {
                    this.refreshLists()
                },

                refreshLists() {
                    this.$http.get('admin_users/lists', {
                        label: 'refresh',
                        params: {
                            pageable: this.lists.pageable,
                            page: this.lists.page,
                            size: this.lists.size,
                        }
                    }).then(res => {
                        this.lists = res.data.lists
                    })
                },

                onSave() {
                    this.$refs.form.validate(valid => {
                        if (valid) {
                            if (this.formMode === 'add') {
                                this.$http.post('admin_users', this.formData, {label: 'save'}).then(res => {
                                    this.refreshLists()
                                    this.editDialog.visible = false
                                })
                            } else {
                                this.$http.put('admin_users/' + this.formData.id, this.formData, {label: 'save'}).then(res => {
                                    this.refreshLists()
                                    this.editDialog.visible = false
                                })
                            }
                        } else {
                            this.$message.warning('表单验证失败，请重新填写。')
                        }
                    })
                },

                onDelete(row) {
                    this.$http.delete('admin_users/' + row.id, {label: 'delete_' + row.id}).then(res => {
                        this.refreshLists()
                    })
                },

                onPaginationSizeChange(){
                    this.refreshLists()
                },

                onPaginationCurrentChange(){
                    this.refreshLists()
                },
            },

            created() {
                this.refreshLists()
            },
        })
    </script>
@endsection

@section('style')

@endsection