<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneUppercase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rule = '/^(?:(?:\+|00)86)?1[3-9]\d{9}$/';

        $res = preg_match($rule, $value);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '手机号不匹配';
    }
}
