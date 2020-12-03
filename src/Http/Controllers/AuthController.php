<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

class AuthController
{
    public function index()
    {
        return admin_view('auth.index');
    }
}