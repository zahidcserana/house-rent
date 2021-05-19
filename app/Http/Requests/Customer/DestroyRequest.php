<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\FormRequest;

class DestroyRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = [
            'id' => [
                'required',
                'exists:flats,id,deleted_at,NULL'
            ]
        ];

        return $rules;
    }
}
