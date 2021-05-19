<?php

namespace App\Components;

use App\Models\InvoiceItem;
use App\Http\Requests\InvoiceItem\StoreRequest;
use App\Http\Requests\InvoiceItem\UpdateRequest;
use App\Http\Requests\InvoiceItem\DestroyRequest;

class InvoiceItemComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $invoiceItem = InvoiceItem::create($input);

        return $invoiceItem;
    }

    public function update(UpdateRequest $request, InvoiceItem $invoiceItem)
    {
        $input = $request->validated();

        $invoiceItem->update($input);

        $invoiceItem->refresh();

        return $invoiceItem;
    }

    public function destroy(DestroyRequest $request, InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();

        $response = ['id' => $invoiceItem->id, 'invoice' => $invoiceItem->invoice];

        return $response;
    }
}
