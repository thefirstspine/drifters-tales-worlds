<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SaveData implements Rule
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
        $serialized = self::unserializeSaveData($value);
        $badwordFrValidator = new BadwordFr();
        return isset($serialized['username'])
            && $badwordFrValidator->passes('', $serialized['username']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid serialized player entity.';
    }

    public static function unserializeSaveData($input)
    {
        $ret = [];
        foreach (explode(";", $input) as $field)
        {
            $field = explode('=', $field);
            if (sizeof($field) === 2)
            {
                $ret[$field[0]] = $field[1];
            }
        }
        return $ret;
    }

}
