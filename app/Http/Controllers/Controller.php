<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getCookieId($name)
    {
        $id = Cookie::get($name);
        if (!$id) {
            $id = Str::uuid();
            Cookie::queue($name, $id, 60 * 24 * 30);
        }

        return $id;
    }

    public function getUserId()
    {
        
        $accessToken = Auth::user()->tokens()->latest()->first();

        $token = PersonalAccessToken::findToken($accessToken);

        if($token){
            return $token->tokenable_id;
        }

        return Auth::id() ?? null;

    }

}
