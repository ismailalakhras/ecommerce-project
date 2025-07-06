<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function update(Request $request)
    {
        try {
            $coupon = Coupon::where('code', $request->code)
                ->where('is_active', true)
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->first();


            $couponValue = 0;


            if (isset($coupon)) {
                $couponValue = $coupon->value;

                $coupon->update([
                    'used_count' => $coupon->used_count +1,
                ]);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Coupon applied successfully.')
            ->with('discount', $couponValue);
    }
}
