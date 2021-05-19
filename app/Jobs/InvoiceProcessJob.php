<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Components\InvoiceProcess;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class InvoiceProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invoiceProcess = new InvoiceProcess();

        $invoiceProcess->generateInvoice();
    }

    public function failed(Exception $e)
    {
        Log::error('Invoice cron failed: ' . $e->getMessage());
    }
}
