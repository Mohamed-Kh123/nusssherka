<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{

    public function index(Request $request)
    {
        Gate::authorize('order.view-any');
        $orders = Order::query();
        if ($request->sortBy)
            $orders->where('status', $request->sortBy);


        $orders = $orders->latest()->paginate();
        return view('admin.orders.index', compact('orders'));
    }


    public function show($id)
    {
        Gate::authorize('order.view');
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }


    public function edit($id)
    {
        Gate::authorize('order.update');

        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('order.update');

        $request->validate([
            'status' => 'required|in:pending,cancelled,processing,shipped,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('Order #'.$order->number.' updated!');
    }

}
