@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Coupon</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Coupon</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Update Coupon Form</h6>
                    <hr />
                    <div class="card">
                        <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Code <span style="color: red">*</span></label>
                                <input class="form-control mb-3" type="text" name="code" value="{{ $coupon->code }}" >

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Type <span style="color: red">*</span></label>
                                <select class="form-control mb-3" name="type" >
                                    <option value="">Select Type</option>
                                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                </select>

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Value <span style="color: red">*</span></label>
                                <input class="form-control mb-3" type="number" name="value" step="0.01" min="0" value="{{ $coupon->value }}" >

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Minimum Amount</label>
                                <input class="form-control mb-3" type="number" name="minimum_amount" step="0.01" min="0" value="{{ $coupon->minimum_amount }}">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Usage Limit</label>
                                <input class="form-control mb-3" type="number" name="usage_limit" min="1" value="{{ $coupon->usage_limit }}">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Used Count</label>
                                <input class="form-control mb-3" type="number" name="used_count" min="0" value="{{ $coupon->used_count }}">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Is Active <span style="color: red">*</span></label>
                                <select class="form-control mb-3" name="is_active" >
                                    <option value="1" {{ $coupon->is_active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$coupon->is_active ? 'selected' : '' }}>Inactive</option>
                                </select>

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Starts At</label>
                                <input class="form-control mb-3" type="datetime-local" name="starts_at"
                                       value="{{ $coupon->starts_at ? \Carbon\Carbon::parse($coupon->starts_at)->format('Y-m-d\TH:i') : '' }}">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Expires At</label>
                                <input class="form-control mb-3" type="datetime-local" name="expires_at"
                                       value="{{ $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d\TH:i') : '' }}">

                                <button type="submit" class="btn btn-primary">Update Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
