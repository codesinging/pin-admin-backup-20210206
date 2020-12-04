<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Models\AdminMenu;

class IndexController extends Controller
{
    public function index()
    {
        $adminMenus = AdminMenu::all();
        return $this->adminView('index.index', compact('adminMenus'));
    }
}