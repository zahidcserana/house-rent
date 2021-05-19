<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;

class DestroyRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = [
            'id' => [
                'required',
                'exists:users,id,deleted_at,NULL'
            ]
        ];

        return $rules;
    }
}
