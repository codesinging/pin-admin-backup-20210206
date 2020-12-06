@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="overflow-x-hidden">
        <el-row :gutter="20">
            <el-col :span="12">
                <el-card>
                    <div slot="header">
                        <span>用户信息</span>
                    </div>
                    <div class="divide-y divide-dashed divide-gray-200">
                        <div class="flex items-center justify-between py-2">
                            <span>用户名称</span>
                            <span>{{ admin_user()['name'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span>创建时间</span>
                            <span>{{ admin_user()['created_at'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span>更新时间</span>
                            <span>{{ admin_user()['updated_at'] }}</span>
                        </div>
                    </div>
                </el-card>
            </el-col>
            <el-col :span="12">
                <el-card>
                    <div slot="header">
                        <span>系统信息</span>
                    </div>
                    <div class="divide-y divide-dashed divide-gray-200 font-mono">
                        <div class="flex items-center justify-between py-2">
                            <span>PHP</span>
                            <span>v{{ PHP_VERSION }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span>Laravel</span>
                            <span>v{{ app()->version() }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span>PinAdmin</span>
                            <span>v{{ admin()->version() }}</span>
                        </div>
                    </div>
                </el-card>
            </el-col>
        </el-row>
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

@endsection