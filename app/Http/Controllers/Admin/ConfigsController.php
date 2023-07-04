<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Languages;

class ConfigsController extends Controller
{
    public function create()
    {
        Gate::authorize('config.create');
        return view('admin.config', [
            'currencies' => Currencies::getNames(),
            'locales' => Languages::getNames(),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('config.create');

        foreach($request->input('config') as $key => $value){
            Config::setValue($key, $value);
        }

        Cache::forget('app-settings');
        return redirect()->route('settings')->with('success', 'Settings Updated!');
    }
}
