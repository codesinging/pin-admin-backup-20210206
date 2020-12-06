<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Validation;

use Closure;

class Validate
{
    /**
     * The validation rules.
     * @var Rule[]
     */
    protected $rules = [];

    /**
     * Validate constructor.
     * @param array|string|Closure|Rule ...$rules
     */
    public function __construct(...$rules)
    {
        $this->rule(...$rules);
    }

    /**
     * Make a Validate instance.
     * @param array|string|Closure|Rule ...$rules
     * @return static
     */
    public static function make(...$rules)
    {
        return new static(...$rules);
    }

    /**
     * @param array|string|Closure|Rule ...$rules
     * @return $this
     */
    public function rule(...$rules)
    {
        foreach ($rules as $rule) {
            $this->rules[] = Rule::make($rule);
        }
        return $this;
    }

    /**
     * Get all rules.
     * @return Rule[]
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * Get all rules data.
     * @return array
     */
    public function data()
    {
        $rules = [];
        foreach ($this->rules as $rule) {
            $rules[] = $rule->data();
        }

        return $rules;
    }
}