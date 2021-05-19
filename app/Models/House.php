<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class House extends Model
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
}
