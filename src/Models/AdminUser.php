<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

class AdminUser extends AuthModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        if (!empty($value)){
            $this->attributes['password'] = bcrypt($value);
        }
    }
}