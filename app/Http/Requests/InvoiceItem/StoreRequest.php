<?php

namespace App\Http\Requests\InvoiceItem;

use App\Http\Requests\FormRequest;

class StoreRequest extends FormRequest
{
    public static function validationRules()
    {
        return [
            'invoice_id' => [
                'required',
                'exists:invoices,id,deleted_at,NULL'
            ],
            'flat_id' => [
                'required',
                'exists:flats,id,deleted_at,NULL'
            ],
            'rent' => [
                'sometimes'
            ]
        ];
    }
}
