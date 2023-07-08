<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{

    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('front.about-us', [
            'aboutUs' => $aboutUs,
        ]);
    }


}
