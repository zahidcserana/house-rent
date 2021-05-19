<?php

namespace App\Http\Requests\Invoice;

use App\Http\Requests\FormRequest;

class DestroyRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = [
            'id' => [
                'required',
                'exists:invoices,id,deleted_at,NULL'
            ]
        ];

        return $rules;
    }
}
