<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Badword implements Rule
{

    protected $lang = '';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $listPath = resource_path("txt/badwords-{$this->lang}.txt");
        $listStr = file_get_contents($listPath);
        $listArr = explode("\n", $listStr);
        $valueToCkeck = strtolower($value);
        foreach ($listArr as $badword)
        {
            if (str_contains($valueToCkeck, $badword) && strlen($badword) > 0)
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute contains bad word.';
    }
}
