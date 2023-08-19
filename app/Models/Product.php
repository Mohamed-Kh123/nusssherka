<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Product extends BaseModel
{
    use HasFactory;

    protected $casts = [
        'image' => 'json'
    ];

    protected static function booted()
    {
        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });

    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault('No Category');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'product_id');
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    public function scopeQuantity(Builder $builder)
    {
        $builder->where('quantity', '>', 0);
    }


//    public function getImageUrlAttribute()
//    {
//        if ($this->image) {
//            $path = storage_path("app/public/uploads/images/$this->image");
//            $exists = File::exists($path);
//            if (!$exists) {
//                return asset('storage/null.jpg');
//            }
//
//            $image = Image::make($path);
//
//            $response = Response::make($image->encode($image->mime), 200);
//            $response->header("CF-Cache-Status", 'HIF');
//            $response->header("Cache-Control", 'max-age=604800, public');
//            $response->header("Content-Type", $image->mime);
//
//            // Generate a URL for the image
//            return asset("storage/uploads/images/$this->image");
//        }
//        return asset('storage/null.jpg');
//    }

    // public function getPriceAttribute()
    // {
    //     if($this->discount){
    //         return ($this->discount  / 100) * $this->price;
    //     }

    //     return $this->price;
    // }


    public function getLinkAttribute()
    {
        return route('single.product', $this->slug);
    }


    public function getLastPriceAttribute()
    {
        if ($this->discount != null) {
            return $this->price - (($this->discount / 100) * $this->price);
        } else {
            return $this->price;
        }
    }





    // protected $appends = [
    //     'image_url', 'link', 'cart_link', 'wishlist_link', 'last_price',

    // ];
}
