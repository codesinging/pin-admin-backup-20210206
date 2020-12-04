<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Http\Support\JsonResponses;
use CodeSinging\PinAdmin\Http\Support\PageTitle;
use CodeSinging\PinAdmin\Http\Support\ViewResponses;

class Controller extends \App\Http\Controllers\Controller
{
    use PageTitle;
    use JsonResponses;
    use ViewResponses;
}