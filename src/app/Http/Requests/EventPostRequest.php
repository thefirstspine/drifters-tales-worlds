<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class EventPostRequest extends SavePostRequest
{

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                'name' => [
                    'required',
                    Rule::in([
                        'nantosueltaKilled',
                        'mossySourceKilled',
                        'monarchKilled',
                    ]),
                ],
            ]
        );
    }
}
