<?php

namespace App\Http\Requests\House;

use App\Http\Requests\FormRequest;

class DestroyRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = [
            'id' => [
                'required',
                'exists:houses,id,deleted_at,NULL'
            ]
        ];

        return $rules;
    }
}
