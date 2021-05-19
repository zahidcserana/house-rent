<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(InvoiceItem::class);
    }

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
