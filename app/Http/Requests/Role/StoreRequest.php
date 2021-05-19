<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\FormRequest;

class StoreRequest extends FormRequest
{
    public static function validationRules()
    {
        return [
            'name' => [
                'required'
            ],
            'status' => [
                'sometimes'
            ],
            'description' => [
                'sometimes'
            ]
        ];
    }
}
