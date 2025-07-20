<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Coupon\StoreCouponRequest;
use App\Http\Requests\Backend\Coupon\UpdateCouponRequest;
use App\Http\Resources\Backend\CouponResource;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index(CouponDataTable $datatable)
    {
        $coupons = Coupon::latest()->get();

        return $datatable->render('backend.pages.coupon.index', compact('coupons'));
    }

    public function create()
    {
        try {
            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Failed!',
                'message' => 'An error occurred .',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreCouponRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            Coupon::create($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Created!',
                'message' => 'coupon created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Created Failed!',
                'message' => 'Something went wrong while creating the coupon: ',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function edit(Coupon $coupon)
    {
        try {
            return response()->json([
                'coupon' => new CouponResource($coupon),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Fetch Coupon Failed!',
                'message' => 'An error occurred while fetching the coupon data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $coupon->update($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Updated!',
                'message' => 'coupon updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Update Failed',
                'message' => 'Something went wrong while updating the coupon',
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function destroy(Coupon $coupon)
    {
       try {
            $coupon->delete();
            return response()->json([
                'success' => true,
                'title' => 'Deleted!',
                'message' => 'Coupon has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Failed',
                'message' => 'Something went wrong while deleting the coupon',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
