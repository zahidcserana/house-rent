<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = parent::toArray($request);

        $resource['customer'] = new CustomerResource($this->customer);

        $resource['invoice_items'] = new InvoiceItemCollection($this->invoiceItems);

        return $resource;
    }
}
