<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'address',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'image', 'image_type', 'image_id', 'id');
    }

}
