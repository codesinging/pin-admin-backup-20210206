<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use Illuminate\Support\Facades\Route;

Route::prefix(admin_config('route_prefix'))
    ->name(admin_label() . '.')
    ->group(function () {

        Route::middleware(['web'])->group(function () {

            Route::get('/auth', [\CodeSinging\PinAdmin\Http\Controllers\AuthController::class, 'index'])->name('auth.index');
            Route::post('/auth/login', [\CodeSinging\PinAdmin\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
            Route::get('/auth/logout', [\CodeSinging\PinAdmin\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

        });

        Route::middleware(['web', 'admin.auth:' . admin()->guard()])->group(function () {

            Route::get('/', [\CodeSinging\PinAdmin\Http\Controllers\IndexController::class, 'index'])->name('index.index');
            Route::get('home', [\CodeSinging\PinAdmin\Http\Controllers\IndexController::class, 'home'])->name('index.home');

            Route::get('admin_users/lists', [\CodeSinging\PinAdmin\Http\Controllers\AdminUsersController::class, 'lists'])->name('admin_users.lists');
            Route::resource('admin_users', \CodeSinging\PinAdmin\Http\Controllers\AdminUsersController::class)->except('create', 'edit');

//            Route::get('admin_menus/lists', [\CodeSinging\PinAdmin\Http\Controllers\AdminMenusController::class, 'lists']);
//            Route::resource('admin_menus', \CodeSinging\PinAdmin\Http\Controllers\AdminMenusController::class)->except('create', 'edit');

            admin()->routeResource('admin_menus', \CodeSinging\PinAdmin\Http\Controllers\AdminMenusController::class)->except('create', 'edit');

        });

    });