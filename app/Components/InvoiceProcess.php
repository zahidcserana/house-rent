<?php

namespace App\Components;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\InvoiceItem\StoreRequest as InvoiceItemStoreRequest;
use App\Models\Invoice;

class InvoiceProcess
{
    public function generateInvoice()
    {
        Log::info('Invoice Cron: Start');

        $customers = Customer::where('status', 'ACTIVE')->get();

        foreach ($customers as $customer) {
            if (!$customer->rentedFlats->count()) {
                continue;
            }

            $exist = Invoice::whereMonth('date', date('m'))->where('customer_id', $customer->id)->first();

            if ($exist) {
                continue;
            }

            $requestData = array(
                'date' => date('Y-m-d'),
                'customer_id' => $customer->id
            );

            $storeRequest = StoreRequest::make($requestData);
            $invoice = app()->invoice->store($storeRequest);

            $totalRent = 0;

            foreach ($customer->rentedFlats as $flat) {
                $totalRent += $flat->rent;

                $itemData = [
                    'invoice_id' => $invoice->id,
                    'flat_id' => $flat->id,
                    'rent' => $flat->rent
                ];

                $storeRequest = InvoiceItemStoreRequest::make($itemData);
                app()->invoiceItem->store($storeRequest);
            }

            $directUrl = sprintf("%06d", $invoice->id);
            $invoice->total = $totalRent;
            $invoice->payable_amount = $totalRent;
            $invoice->direct_url = $directUrl;
            $invoice->update();
        }

        Log::info('Invoice Cron: Finish');
    }
}
