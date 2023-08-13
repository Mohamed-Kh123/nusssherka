<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'parent_id',
        'status',
        'price',
    ];




    protected static function booted()
    {
        static::creating(function(Category $category){
            $category->slug  = Str::slug($category->name);
        });

        static::updating(function(Category $category){
            $category->slug  = Str::slug($category->name);
        });
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')->withDefault('No Parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function getImageAttribute()
    {
        if ($this->image_path) {
            $path = storage_path("app/public/uploads/images/$this->image_path");
            $exists = File::exists($path);
            if (!$exists) {
                return asset('storage/null.jpg');
            }

            $image = Image::make($path);

            $response = Response::make($image->encode($image->mime), 200);
            $response->header("CF-Cache-Status", 'HIF');
            $response->header("Cache-Control", 'max-age=604800, public');
            $response->header("Content-Type", $image->mime);

            // Generate a URL for the image
            return asset("storage/uploads/images/$this->image_path");
        }
        return asset('storage/null.jpg');
    }

}
