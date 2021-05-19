<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function rentedFlats()
    {
        return $this->flats()->where('status', Flat::STATUS_RENTED);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function unpaidInvoices()
    {
        return $this->invoices()->where('status', Invoice::STATUS_UNPAID);
    }
}
