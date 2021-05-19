<?php

namespace App\Http\Requests\Invoice;

use App\Http\Requests\FormRequest;

class StoreRequest extends FormRequest
{
    public static function validationRules()
    {
        return [
            'customer_id' => [
                'required',
                'exists:customers,id,deleted_at,NULL'
            ],
            'total' => [
                'sometimes'
            ],
            'additional_cost' => [
                'sometimes'
            ],
            'paid_amount' => [
                'sometimes'
            ],
            'date' => [
                'sometimes',
                'date_format:Y-m-d'
            ],
            'status' => [
                'sometimes'
            ],
        ];
    }
}
