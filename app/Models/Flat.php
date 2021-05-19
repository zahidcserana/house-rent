<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flat extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const STATUS_AVAILABLE = 'available';
    const STATUS_RENTED = 'rented';
    const STATUS_UNAVAILABLE = 'unavailable';

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);

            return true;
        });
    }

    public function house()
    {
        return $this->belongsTo(House::class)->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }
}
