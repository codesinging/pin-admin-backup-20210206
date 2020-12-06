<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

use CodeSinging\PinAdmin\Models\Support\ListsTrait;
use CodeSinging\PinAdmin\Models\Support\SerializeDate;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use SerializeDate;
    use ListsTrait;
}