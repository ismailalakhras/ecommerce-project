<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        try {
            toast()->position('top');

            $validatedData = $request->validate([
                'code' => 'required|string|max:50|unique:coupons,code',
                'type' => 'required|in:fixed,percentage',
                'value' => 'required|numeric|min:0',
                'minimum_amount' => 'nullable|numeric|min:0',
                'usage_limit' => 'nullable|integer|min:1',
                'used_count' => 'nullable|integer|min:0',
                'is_active' => 'required|boolean',
                'starts_at' => 'nullable|date',
                'expires_at' => 'nullable|date|after_or_equal:starts_at',
            ], [
                'code.required' => 'The coupon code is required.',
                'code.string' => 'The coupon code must be a string.',
                'code.max' => 'The coupon code must not exceed 50 characters.',
                'code.unique' => 'This coupon code is already in use.',

                'type.required' => 'The discount type is required.',
                'type.in' => 'The discount type must be either fixed or percentage.',

                'value.required' => 'The discount value is required.',
                'value.numeric' => 'The discount value must be a number.',
                'value.min' => 'The discount value must be at least 0.',

                'minimum_amount.numeric' => 'The minimum amount must be a number.',
                'minimum_amount.min' => 'The minimum amount must be at least 0.',

                'usage_limit.integer' => 'The usage limit must be an integer.',
                'usage_limit.min' => 'The usage limit must be at least 1.',

                'used_count.integer' => 'The used count must be an integer.',
                'used_count.min' => 'The used count must be at least 0.',

                'is_active.required' => 'The active status is required.',
                'is_active.boolean' => 'The active status must be true or false.',

                'starts_at.date' => 'The start date must be a valid date.',
                'expires_at.date' => 'The expiry date must be a valid date.',
                'expires_at.after_or_equal' => 'The expiry date must be after or equal to the start date.',
            ]);


            Coupon::create($validatedData);
            Alert::success('Success', 'Coupon created successfully');
        } catch (ValidationException $e) {
            // Handle validation errors
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            Alert::error('Error', 'Something went wrong while creating the coupon')->autoClose(8000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.coupon.index');
    }


    public function edit(Coupon $coupon)
    {
        return view('backend.pages.coupon.edit', compact('coupon'));
    }


    public function update(Request $request, Coupon $coupon)
    {
        toast()->position('top');

        try {
            $validatedData = $request->validate([
                'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
                'type' => 'required|in:fixed,percentage',
                'value' => 'required|numeric|min:0',
                'minimum_amount' => 'nullable|numeric|min:0',
                'usage_limit' => 'nullable|integer|min:1',
                'used_count' => 'nullable|integer|min:0',
                'is_active' => 'required|boolean',
                'starts_at' => 'nullable|date',
                'expires_at' => 'nullable|date|after_or_equal:starts_at',
            ], [
                'code.required' => 'The coupon code is required.',
                'code.string' => 'The coupon code must be a string.',
                'code.max' => 'The coupon code must not exceed 50 characters.',
                'code.unique' => 'This coupon code is already in use.',

                'type.required' => 'The discount type is required.',
                'type.in' => 'The discount type must be either fixed or percentage.',

                'value.required' => 'The discount value is required.',
                'value.numeric' => 'The discount value must be a number.',
                'value.min' => 'The discount value must be at least 0.',

                'minimum_amount.numeric' => 'The minimum amount must be a number.',
                'minimum_amount.min' => 'The minimum amount must be at least 0.',

                'usage_limit.integer' => 'The usage limit must be an integer.',
                'usage_limit.min' => 'The usage limit must be at least 1.',

                'used_count.integer' => 'The used count must be an integer.',
                'used_count.min' => 'The used count must be at least 0.',

                'is_active.required' => 'The active status is required.',
                'is_active.boolean' => 'The active status must be true or false.',

                'starts_at.date' => 'The start date must be a valid date.',
                'expires_at.date' => 'The expiry date must be a valid date.',
                'expires_at.after_or_equal' => 'The expiry date must be after or equal to the start date.',
            ]);

            $coupon->update($validatedData);

            Alert::success('Success', 'Coupon updated successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while updating the coupon')->autoClose(8000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.coupon.index');
    }


    public function destroy(Coupon $coupon)
    {
        toast()->position('top');

        try {
            $coupon->delete();
            toast()->position('top');

            Alert::success('Deleted', $coupon->name . ' deleted successfully')->autoClose(8000);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the coupon')->autoClose(8000);
        }

        return redirect()->route('admin.coupon.index');
    }
}
