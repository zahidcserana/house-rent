<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;

class StoreRequest extends FormRequest
{
    public static function validationRules()
    {
        return [
            'name' => [
                'required'
            ],
            'mobile' => [
                'sometimes'
            ],
            'email' => [
                'required',
                'email',
                'unique:users'
            ],
            'role_id' => [
                'required',
                'exists:roles,id,deleted_at,NULL'
            ],
            'status' => [
                'sometimes'
            ],
            'password' => [
                'confirmed',
                'min:6',
                'regex:/[a-zA-Z0-9@$!%*#?&]/',
            ],
            'password_confirmation' => [
                'required'
            ]
        ];
    }
}
