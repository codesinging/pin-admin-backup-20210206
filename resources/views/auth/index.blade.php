@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="h-full flex items-center justify-center">
        <particles-js></particles-js>

        <el-card class="login-card z-10">
            <div slot="header">
                <span>用户登录</span>
            </div>

        </el-card>
    </div>
    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {}
            },
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