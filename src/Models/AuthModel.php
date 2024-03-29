<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

use CodeSinging\PinAdmin\Models\Support\ListsTrait;
use CodeSinging\PinAdmin\Models\Support\SerializeDate;
use Illuminate\Foundation\Auth\User;

class AuthModel extends User
{
    use SerializeDate;
    use ListsTrait;
}