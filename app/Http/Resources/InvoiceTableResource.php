<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

class InvoiceTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        unset($resource);

        $resource['id'] = $this->id;
        $resource['date'] = $this->date;
        $resource['invoice_no'] = $this->direct_url;
        $resource['total'] = $this->total;
        $resource['additional_cost'] = $this->additional_cost;
        $resource['payable_amount'] = $this->payable_amount;
        $resource['paid_amount'] = $this->paid_amount;
        $resource['due_amount'] = $this->payable_amount - $this->paid_amount;
        $resource['status'] = $this->status;
        $resource['customer'] = ['url' => route('customer.edit', ['customer' => $this->customer]), 'name' => $this->customer->name];
        $resource['direct_url'] = ['url' => route('invoice.direct_url', ['direct_url' => $this->direct_url]), 'name' => $this->direct_url];
        $resource['link_edit'] = route('invoice.edit', ['invoice' => $this]);
        $resource['link_delete'] = ['token' => csrf_token(), 'url' => route('invoice.destroy', ['id' => $this->id, 'invoice' => $this])];

        return $resource;
    }
}
