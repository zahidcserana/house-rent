<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\FormRequest;

class DestroyRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = [
            'id' => [
                'required',
                'exists:roles,id,deleted_at,NULL'
            ]
        ];

        return $rules;
    }
}
