<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        if($this->image_path){
            return asset('storage/'.$this->image_path);
        }
    }

    protected $appends = [
        'image',
    ];
}
