<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Http\Requests\AdminUserRequest;
use CodeSinging\PinAdmin\Models\AdminUser;
use CodeSinging\PinAdmin\Viewless\Views\ModelView;
use Illuminate\Validation\Rule;

class AdminUsersController extends Controller
{
    public function index(ModelView $view)
    {
        return $this->adminView('admin_users.index');
    }

    public function lists(AdminUser $adminUser)
    {
        $lists = $adminUser->lists();
        return $this->success('获取列表成功', compact('lists'));
    }

    public function store(AdminUser $adminUser, AdminUserRequest $request)
    {
        $request->validate([
            'password' => ['required'],
            'name' => ['unique:admin_users']
        ], [
            'password.required' => '密码不能为空',
            'name.unique' => '用户名称已存在',
        ]);

        $result = $adminUser->fill($request->all())->save();

        return $result ? $this->success('添加成功') : $this->error('添加失败');
    }

    public function update(AdminUser $adminUser, AdminUserRequest $request)
    {
        $request->validate([
            'name' => [Rule::unique('admin_users')->ignore($adminUser)]
        ], [
            'name.unique' => '用户名称已存在',
        ]);

        $result = $adminUser->fill($request->all())->save();

        return $result ? $this->success('修改成功') : $this->error('修改失败');
    }

    public function destroy(AdminUser $adminUser)
    {
        return $adminUser->delete()
            ? $this->success('删除成功')
            : $this->error('删除失败');
    }
}