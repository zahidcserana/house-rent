<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'status'];

    const ROLE_ADMINISTRATOR = 1;
    const ROLE_MEMBER = 2;

    const ROLE_DEFAULT = self::ROLE_MEMBER;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);

            return true;
        });
    }
}
