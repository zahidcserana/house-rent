<?php

namespace App\Models;

use App\Events\SaveInvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const STATUS_PAID = 'paid';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_CANCEL = 'cancel';


    protected $attributes = [
        'status' => 'unpaid'
    ];

    protected $dispatchesEvents = [
        'updated' => SaveInvoice::class,
        'deleted' => SaveInvoice::class
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function calculateInvoice()
    {
        $payableAmount = 0;

        foreach ($this->invoiceItems as $invoiceItem) {
            $payableAmount += $invoiceItem->rent;
        }

        $this->payable_amount = $payableAmount + $this->additional_cost;
        $this->update();
    }
}
