<?php

namespace App\Components;

use App\Models\Invoice;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\Invoice\UpdateRequest;
use App\Http\Requests\Invoice\DestroyRequest;

class InvoiceComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $invoice = Invoice::create($input);

        return $invoice;
    }

    public function update(UpdateRequest $request, Invoice $invoice)
    {
        $input = $request->validated();

        if ($invoice->status == $input['status'] && ($input['total'] + $input['additional_cost'] <= $input['paid_amount'])) {
            $input['status'] = 'paid';
        }

        $invoice->update($input);

        $invoice->refresh();

        $invoice->calculateInvoice();

        return $invoice;
    }

    public function destroy(DestroyRequest $request, Invoice $invoice)
    {
        $invoice->invoiceItems()->delete();

        $invoice->delete();

        $response = ['id' => $invoice->id, 'flats' => $invoice->flats, 'customer_id' => $invoice->customer_id];

        return $response;
    }
}
