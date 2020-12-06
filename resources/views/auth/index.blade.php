@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="h-full flex items-center justify-center">
        <particles-js></particles-js>

        <el-card class="login-card z-10" v-loading="statuses.login||statuses.redirect">
            <div slot="header">
                <span>用户登录</span>
            </div>

            <el-form ref="form" :model="user" :disabled="statuses.login||statuses.redirect" size="default">
                <el-form-item prop="name" :rules="rules.name">
                    <el-input v-model="user.name" placeholder="登录账号">
                        <div slot="prepend" class="w-16">登录账号</div>
                    </el-input>
                </el-form-item>

                <el-form-item prop="password" :rules="rules.password">
                    <el-input v-model="user.password" placeholder="登录密码" show-password>
                        <div slot="prepend" class="w-16">登录密码</div>
                    </el-input>
                </el-form-item>

                <el-form-item prop="captcha" v-if="useCaptcha" :rules="rules.captcha">
                    <el-input v-model="user.captcha" class="captcha-input">
                        <div slot="prepend" class="w-16 text-center">验 证 码</div>
                        <div slot="append" class="flex items-center justify-center">
                            <el-image
                                    v-show="statuses.loaded"
                                    :src="captchaSrc"
                                    class="cursor-pointer"
                                    style="width:120px; height:36px;"
                                    @click="onRefreshCaptcha"
                                    @load="onCaptchaLoaded"
                            ></el-image>
                            <i v-if="!statuses.loaded" class="el-icon-loading"></i>
                        </div>
                    </el-input>
                </el-form-item>


                <div class="text-center">
                    <el-button type="primary" class="w-full" @click="onSubmit">登录</el-button>
                </div>
            </el-form>
        </el-card>
    </div>
    <script>
        const captchaSrc = '{{ admin_config('auth.captcha') ? captcha_src() : '' }}'
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    user: {
                        name: '',
                        password: '',
                        captcha: '',
                    },
                    rules: {
                        name: [
                            {required: true, message: '登录账号不能为空', trigger: 'blur'},
                        ],
                        password: [
                            {required: true, message: '登录密码不能为空', trigger: 'blur'},
                        ],
                        captcha: [
                            {required: true, message: '请输入验证码', trigger: 'blur'},
                        ],
                    },
                    useCaptcha: @json(admin_config('auth.captcha')),
                    captchaSrc: captchaSrc,
                }
            },
            methods: {
                onSubmit() {
                    this.$refs.form.validate(valid => {
                        if (valid) {
                            this.$http.post('auth/login', this.user, {label: 'login'}).then(res => {
                                this.$true('redirect')
                                setTimeout(() => {
                                    location.href = adminBaseUrl
                                }, 1000)
                            })
                        } else {
                            this.$message.warning('表单验证未通过，请重新填写。')
                        }
                    })
                },
                onRefreshCaptcha() {
                    this.refreshCaptcha()
                },
                onCaptchaLoaded() {
                    this.$true('loaded')
                },
                refreshCaptcha() {
                    this.$false('loaded')
                    this.captchaSrc = captchaSrc + (new Date()).getTime()
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

        .captcha-input .el-input-group__append{
            padding: 1px !important;
            min-width: 120px;
        }
    </style>
@endsection