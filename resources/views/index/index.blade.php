@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="h-full">
        <el-container class="h-full">
            <el-aside class="h-full bg-gray-700 transition-all duration-300 ease-in-out" :width="collapsed ? '64px' : '240px'">
                <div class="flex items-center justify-center bg-gray-900 space-x-2 px-3 py-3.5 overflow-hidden">
                    <img src="{{ admin_asset('images/pinfan-logo-white.svg') }}" alt="PinFan Logo" class="h-8">
                    <img src="{{ admin_asset('images/pinfan-admin-logo-white.svg') }}" alt="PinFan Logo" class="h-6" v-show="!collapsed">
                </div>
            </el-aside>
            <el-container>
                <el-header class="flex items-center justify-between bg-gray-200">
                    <div class="flex items-center space-x-2">
                        <el-tooltip :content="collapsed ? '展开菜单' : '收缩菜单'">
                            <div @click="collapsed = !collapsed" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 hover:bg-gray-400 text-gray-600 hover:text-white cursor-pointer">
                                <i :class="[collapsed ? 'bi-arrow-bar-right' : 'bi-arrow-bar-left']"></i>
                            </div>
                        </el-tooltip>
                        <el-tooltip :content="fullscreen ? '退出全屏' : '全屏显示'">
                            <div @click="onFullscreenToggle" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 hover:bg-gray-400 text-gray-600 hover:text-white cursor-pointer">
                                <i :class="[fullscreen ? 'bi-fullscreen-exit' : 'bi-fullscreen']"></i>
                            </div>
                        </el-tooltip>
                    </div>
                </el-header>
            </el-container>
        </el-container>
    </div>
    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    collapsed: false,
                    fullscreen: false,
                }
            },
            methods: {
                onFullscreenToggle() {
                    if (fullscreen.isEnabled) {
                        fullscreen.toggle().then(() => {
                            this.fullscreen = !this.fullscreen
                        })
                    }
                }
            }
        })
    </script>
@endsection

@section('style')
    <style>
        html, body {
            height: 100%;
        }
    </style>
@endsection