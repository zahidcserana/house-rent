<?php

namespace App\Http\Requests\InvoiceItem;

use App\Http\Requests\FormRequest;

class DestroyRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = [
            'id' => [
                'required',
                'exists:invoice_items,id,deleted_at,NULL'
            ]
        ];

        return $rules;
    }
}
