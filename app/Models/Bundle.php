<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Bundle extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function (Bundle $bundle) {
            $bundle->slug = Str::slug($bundle->name);
        });

        static::updating(function (Bundle $bundle) {
            $bundle->slug = Str::slug($bundle->name);
        });

    }


}
