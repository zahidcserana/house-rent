<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CustomerAccountBalance
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $totalDue = 0;

        foreach ($event->invoice->customer->unpaidInvoices as $invoice) {
            $totalDue += $invoice->payable_amount - $invoice->paid_amount;
        }

        $event->invoice->customer->account_balance = $totalDue;
        $event->invoice->customer->update();
    }
}
