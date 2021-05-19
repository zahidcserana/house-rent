<?php

namespace App\Http\Requests\House;

use App\Http\Requests\FormRequest;

class StoreRequest extends FormRequest
{
    public static function validationRules()
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id,deleted_at,NULL'
            ],
            'name' => [
                'required'
            ],
            'status' => [
                'sometimes'
            ],
        ];
    }
}
