<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required',
            'ratings' => 'required|in:1,2,3,4,5',
            'product_id' => 'required|exists:products,id',
        ]);

        $prod_ratings = Rating::where('product_id', '=', $request->product_id)->Where('user_id', '=', Auth::user()->id)->first();

        if($prod_ratings){
            $prod_ratings->ratings = $request->ratings;
            $prod_ratings->review = $request->review;
            $prod_ratings->update();
            // $product_id = request('product_id');
            // $product = Product::find($product_id);
            // $product->total_ratings = $request->ratings;
            // $product->update();
        }else{
            Rating::create([
                'review' => $request->review,
                'ratings' => $request->ratings,
                'product_id' => $request->product_id,
                'user_id' => Auth::user()->id,
            ]);
        }
        if($request->expectsJson()){
            return $prod_ratings;
        }
        return redirect()->back()->with('success', 'Thank you for rating this product');
    }
}
