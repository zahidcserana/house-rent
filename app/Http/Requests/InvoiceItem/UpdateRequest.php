<?php

namespace App\Http\Requests\InvoiceItem;

use App\Http\Requests\FormRequest;

class UpdateRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = StoreRequest::validationRules();

        $rules['id'] = ['sometimes', 'exists:invoice_items,id,deleted_at,NULL'];

        return $rules;
    }
}
