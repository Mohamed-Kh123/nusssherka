<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponsController extends Controller
{
    private function save(CouponRequest $request, Coupon $coupon)
    {
        $validated = $request->validated();

        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->expire_date = $request->expire_date;
        $coupon->description = $request->description;
        $coupon->limit = $request->limit;
        $coupon->status = $request->status;
        $coupon->save();
    }

    public function index()
    {
        Gate::authorize('coupon.view-any');
        $coupons = Coupon::paginate();
        return view('admin.coupons.index', compact('coupons'));
    }


    public function create()
    {
        Gate::authorize('coupon.create');
        $coupon = new Coupon();
        return view('admin.coupons.create', compact('coupon'));
    }


    public function store(CouponRequest $request)
    {
        Gate::authorize('coupon.create');

        $coupon = new Coupon();

        $this->save($request, $coupon);

        return redirect()->route('coupons.index')->with('success', 'Coupon added successfully!');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.edit', compact('coupon'));
    }



    public function update(CouponRequest $request, $id)
    {
        Gate::authorize('coupon.update');

        $coupon = Coupon::findOrFail($id);

        $this->save($request, $coupon);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
    }


    public function destroy($id)
    {
        Gate::authorize('coupon.delete');
        Coupon::destroy($id);
        return redirect()->back()->with('success', 'Coupon deleted!');
    }
}
