<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Http\Requests\AdminUserRequest;

class AuthController extends Controller
{
    public function index()
    {
        $this->setPageTitle('用户登录');
        return $this->adminView('auth.index');
    }

    public function login(AdminUserRequest $request)
    {
        $request->validate([
            'password' => ['required'],
        ], [
            'password.required' => '密码不能为空',
        ]);

        if (admin_config('auth.captcha')){
            $request->validate([
                'captcha' => ['required', 'captcha'],
            ], [
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '验证码不正确',
            ]);
        }

        $credentials = $request->only('name', 'password');

        if (admin_auth()->attempt($credentials)){
            return $this->success('登录成功');
        } else{
            return $this->error('登录失败');
        }
    }

    public function logout()
    {
        admin_auth()->logout();
        return $this->success('注销成功');
    }
}