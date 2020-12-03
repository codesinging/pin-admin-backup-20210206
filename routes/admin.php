<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use Illuminate\Support\Facades\Route;

Route::prefix(admin_config('route_prefix'))
    ->group(function () {

        Route::middleware(['web'])->group(function () {
            Route::get('/auth', [\CodeSinging\PinAdmin\Http\Controllers\AuthController::class, 'index']);
        });

        Route::middleware(['web', 'admin.auth:' . admin()->guard()])->group(function () {
            Route::get('/', [\CodeSinging\PinAdmin\Http\Controllers\IndexController::class, 'index']);
        });

    });