<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Jobs\InvoiceProcessJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\Invoice\StoreRequest as InvoiceStoreRequest;
use App\Http\Requests\InvoiceItem\StoreRequest as InvoiceItemStoreRequest;

class InvoiceGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invoice Generator command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            InvoiceProcessJob::dispatchNow();
        } catch (\Throwable $e) {
            Log::error('Invoice cron: ' . $e->getMessage());
        }
    }
}
