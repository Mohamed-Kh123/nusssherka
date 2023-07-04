<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $products = new Product();

        $name = $request->search;

        if(!$name){
            return redirect()->back();
        }
        
        $products = $products::with('category')->where('name', 'like', '%'.$name.'%')->simplePaginate(10);            
        return view('front.results', [  
            'products' => $products,
        ]);

    }
}
