<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('payment.view-any');
        $payments = Payment::with('order')->orderBy('status', 'ASC')->paginate();
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('payment.view');

        $payment = Payment::findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }
}
