<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\FormRequest;
use App\Rules\UniqueNumberCheck;

class UpdateRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = StoreRequest::validationRules();

        foreach ($rules['name'] as $key => $rule) {
            if (is_a($rule, UniqueNumberCheck::class)) {
                unset($rules['name'][$key]);
                break;
            }
        }

        return $rules;
    }
}
