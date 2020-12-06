<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Database\Seeders;

use CodeSinging\PinAdmin\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        AdminUser::truncate();
        AdminUser::create([
            'name' => 'admin',
            'password' => 'admin888',
        ]);
    }
}