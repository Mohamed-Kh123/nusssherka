<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('front.about-us', [
            'aboutUs' => $aboutUs,
        ]);
    }

   
}
