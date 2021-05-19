<?php

namespace App\Http\Requests\Invoice;

use App\Http\Requests\FormRequest;
use App\Rules\UniqueNumberCheck;

class UpdateRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = StoreRequest::validationRules();

        return $rules;
    }
}
