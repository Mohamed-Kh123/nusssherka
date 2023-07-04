<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $pay = new Statistic();
        $pay->setValue('total_payments', Payment::sum('amount'));
        
        foreach(Statistic::all() as $static){
            config()->set($static->name, $static->value);
        }

        return view('admin.statistics');
    }
}
