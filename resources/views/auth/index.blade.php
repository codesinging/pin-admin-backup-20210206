@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="h-full flex items-center justify-center">
        <particles-js></particles-js>

        <el-card class="login-card z-10 -mt-20" v-loading="statuses.login">
            <div slot="header">
                <span>用户登录</span>
            </div>

            <el-form ref="form" :model="user" :rules="rules" :disabled="statuses.login">
                <el-form-item prop="name">
                    <el-input v-model="user.name" placeholder="登录账号">
                        <template slot="prepend">登录账号</template>
                    </el-input>
                </el-form-item>

                <el-form-item prop="password">
                    <el-input v-model="user.password" placeholder="登录密码">
                        <template slot="prepend">登录密码</template>
                    </el-input>
                </el-form-item>

                <div>
                    <el-button type="primary" class="w-full" @click="onSubmit">登录</el-button>
                </div>
            </el-form>
        </el-card>
    </div>
    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    user: {
                        name: 'admin',
                        password: '123',
                    },
                    rules: {
                        name: [
                            {required: true, message: '登录账号不能为空', trigger: 'blur'},
                        ],
                        password: [
                            {required: true, message: '登录密码不能为空', trigger: 'blur'},
                        ],
                    }
                }
            },
            methods: {
                onSubmit(){
                    this.$refs.form.validate(valid=>{
                        if (valid){
                            this.$http.post('auth/login', this.user, {label: 'login'}).then(res=>{
                                console.log(res)
                            })
                        } else {
                            this.$message.warning('表单验证未通过，请重新填写。')
                        }
                    })
                },
            }
        })
    </script>
@endsection

@section('style')
    <style>
        html, body {
            height: 100%;
        }

        .login-card {
            width: 500px;
        }
    </style>
@endsection