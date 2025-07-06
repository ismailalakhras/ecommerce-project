<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Coupon\StoreCouponRequest;
use App\Http\Requests\Backend\Coupon\UpdateCouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();

        return view('backend.pages.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('backend.pages.coupon.create');
    }

    public function store(StoreCouponRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Coupon::create($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while creating the coupon');
        }
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon created successfully');
    }


    public function edit(Coupon $coupon)
    {
        return view('backend.pages.coupon.edit', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        try {
            $validatedData = $request->validated();
            $coupon->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while updating the coupon');
        }
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon updated successfully');
    }

    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
        } catch (\Exception $e) {
            return redirect()->with('error', 'Something went wrong while deleting the coupon');
        }
        return redirect()->route('admin.coupon.index')->with('success', 'coupon deleted successfully');
    }
}
