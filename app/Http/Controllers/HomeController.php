<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Review;
use App\Models\Statistic;
use App\Repositories\Register\Register;
use App\Repositories\Users\AdminUser;
use App\Repositories\Users\Auth as UsersAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    public function index()
    {

        $categories = Category::with('products')->get()->map(function ($category) {
            return [
                'name' => $category->name,
                'slug' => $category->slug,
                'image' => $category->image,
                'products_count' => $category->products->count(),
                'price' => $category->price,
            ];
        });

//        dd($categories);


        return view('front.home', [
            'categories' => $categories
        ]);
    }
}
