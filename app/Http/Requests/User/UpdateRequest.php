<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Arr;
use App\Rules\UniqueNumberCheck;
use App\Http\Requests\FormRequest;

class UpdateRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = StoreRequest::validationRules();

        foreach ($rules['email'] as $key => $rule) {
            if (strpos($rule, 'unique') !== false) {
                unset($rules['email'][$key]);
                break;
            }
        }

        $rules['email'][] = 'exists:users';

        $rules['password'] = Arr::prepend($rules['password'], 'nullable');

        foreach ($rules['password_confirmation'] as $key => $rule) {
            if (strpos($rule, 'required') !== false) {
                unset($rules['password_confirmation'][$key]);
                break;
            }
        }

        $rules['password_confirmation'] = Arr::prepend($rules['password_confirmation'], 'nullable');

        return $rules;
    }
}
