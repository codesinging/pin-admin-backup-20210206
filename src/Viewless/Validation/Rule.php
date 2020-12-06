<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Validation;

use Closure;
use Illuminate\Support\Str;

/**
 * Class Rule
 *
 * @method $this isString()
 * @method $this isNumber()
 * @method $this isBoolean()
 * @method $this isMethod()
 * @method $this isRegexp()
 * @method $this isInteger()
 * @method $this isFloat()
 * @method $this isArray()
 * @method $this isObject()
 * @method $this isEnum()
 * @method $this isDate()
 * @method $this isUrl()
 * @method $this isHex()
 * @method $this isEmail()
 *
 * @package CodeSinging\PinAdmin\Viewless\Validation
 */
class Rule
{
    /**
     * The rule data.
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $commonRules = [
        'required' => ['required' => true, 'message' => '不能为空', 'trigger' => 'change'],
        'date' => ['type' => 'date', 'message' => '类型不正确', 'trigger' => 'change'],
        'number' => ['type' => 'number', 'message' => '类型不正确', 'trigger' => 'change'],
        'email' => ['type' => 'email', 'message' => '类型不正确', 'trigger' => 'change'],
        'integer' => ['type' => 'integer', 'message' => '类型不正确', 'trigger' => 'change'],
        'url' => ['type' => 'url', 'message' => '类型不正确', 'trigger' => 'change'],
        'hex' => ['type' => 'hex', 'message' => '类型不正确', 'trigger' => 'change'],
        'float' => ['type' => 'float', 'message' => '类型不正确', 'trigger' => 'change'],
        'string' => ['type' => 'string', 'message' => '类型不正确', 'trigger' => 'change'],
        'boolean' => ['type' => 'boolean', 'message' => '类型不正确', 'trigger' => 'change'],
    ];

    /**
     * Rule constructor.
     * @param string|array|null $data
     */
    public function __construct($data = null)
    {
        $this->rule($data);
    }

    /**
     * Set rule data.
     * @param string|array|null $data
     * @return $this
     */
    public function rule($data = null)
    {
        if (is_array($data)) {
            $this->data = $data;
        } elseif (is_string($data)) {
            if (isset($this->commonRules[$data])) {
                $this->data = $this->commonRules[$data];
            }
        }
        return $this;
    }

    /**
     * Make a rule instance.
     * @param array|string|Closure|Rule|null $data
     * @return static
     */
    public static function make($data = null)
    {
        if ($data instanceof Closure) {
            $data = call_closure($data, new static());
        }
        if ($data instanceof self) {
            return $data;
        }
        return new static($data);
    }

    /**
     * Set validator type to use.
     * @param string $type
     * @return $this
     */
    public function type(string $type)
    {
        $this->data['type'] = $type;
        return $this;
    }

    /**
     * Set required property.
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true)
    {
        $this->data['required'] = $required;
        return $this;
    }

    /**
     * @param string $pattern
     * @return $this
     */
    public function pattern(string $pattern)
    {
        $this->data['pattern'] = $pattern;
        return $this;
    }

    /**
     * @param int $min
     * @return $this
     */
    public function min(int $min)
    {
        $this->data['min'] = $min;
        return $this;
    }

    /**
     * @param int $max
     * @return $this
     */
    public function max(int $max)
    {
        $this->data['max'] = $max;
        return $this;
    }

    /**
     * @param int $len
     * @return $this
     */
    public function len(int $len)
    {
        $this->data['len'] = $len;
        return $this;
    }

    /**
     * @param array $enum
     * @return $this
     */
    public function enum(array $enum = [])
    {
        $this->data['enum'] = $enum;
        return $this;
    }

    /**
     * @param bool $whitespace
     * @return $this
     */
    public function whitespace(bool $whitespace = true)
    {
        $this->data['whitespace'] = true;
        return $this;
    }

    /**
     * @param string $transform
     * @return $this
     */
    public function transform(string $transform)
    {
        $this->data['transform'] = $transform;
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function message(string $message)
    {
        $this->data['message'] = $message;
        return $this;
    }

    /**
     * @param string $validator
     * @return $this
     */
    public function validator(string $validator)
    {
        $this->data['validator'] = $validator;
        return $this;
    }

    /**
     * @param string $trigger
     * @return $this
     */
    public function trigger(string $trigger)
    {
        $this->data['trigger'] = $trigger;
        return $this;
    }

    /**
     * @return $this
     */
    public function triggerWhenChange()
    {
        $this->trigger('change');
        return $this;
    }

    /**
     * @return $this
     */
    public function triggerWhenBlur()
    {
        $this->trigger('blur');
        return $this;
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return $this
     */
    public function __call(string $method, array $parameters = [])
    {
        if (Str::startsWith($method, 'is') && strlen($method) > 2) {
            $type = lcfirst(substr($method, 2));
            $this->type($type);
        }

        return $this;
    }

    /**
     * Get the rule data.
     * @return array
     */
    public function data()
    {
        return $this->data;
    }
}