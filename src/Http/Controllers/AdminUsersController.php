<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Http\Requests\AdminUserRequest;
use CodeSinging\PinAdmin\Models\AdminUser;
use CodeSinging\PinAdmin\Viewless\Views\ModelView;
use Illuminate\Support\Str;

class AdminUsersController extends Controller
{
    public function index(ModelView $view)
    {
        $view->table->idColumn();
        $view->table->column('name', '名称');
        $view->table->createdAtColumn('创建时间');
        $view->table->updatedAtColumn('更新时间');

        $view->form->item('name', '名称')->input()->validate(['required'=>true, 'message' => '不能为空', 'trigger' => 'blur']);

        return $view->render();
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
        ], [
            'password.required' => '密码不能为空',
        ]);

        $result = $adminUser->fill($request->all())->save();

        return $result ? $this->success('添加成功') : $this->error('添加失败');
    }
}