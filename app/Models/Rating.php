<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected static function booted()
    {
        static::updated(function(Rating $rating){
            if($rating->count('product_id') > 0){
                $total_ratings = round($rating->sum('ratings') / $rating->count('product_id'));
                $rating->product()->update(['total_ratings' => $total_ratings]);

            }else{
                $rating->product()->update(['total_ratings' => 0]);
            }
            
        });
        static::created(function(Rating $rating){
            if($rating->count('product_id') > 0){
                $total_ratings = round($rating->sum('ratings') / $rating->count('product_id'));
                $rating->product()->update(['total_ratings' => $total_ratings]);

            }else{
                $rating->product()->update(['total_ratings' => 0]);
            }
        });
    }
}
