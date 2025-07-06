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
                            <li class="breadcrumb-item active" aria-current="page">Create New Coupon</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Create Coupon Form</h6>
                    <hr />
                    <div class="card">
                        <form action="{{ route('admin.coupon.store') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Code <span style="color: red">*</span></label>
                                <input class="form-control mb-3" type="text" name="code" >

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Type <span style="color: red">*</span></label>
                                <select class="form-control mb-3" name="type" >
                                    <option value="">Select Type</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percentage">Percentage</option>
                                </select>

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Value <span style="color: red">*</span></label>
                                <input class="form-control mb-3" type="number" name="value" step="0.01" min="0" >

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Minimum Amount</label>
                                <input class="form-control mb-3" type="number" name="minimum_amount" step="0.01" min="0">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Usage Limit</label>
                                <input class="form-control mb-3" type="number" name="usage_limit" min="1">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Used Count</label>
                                <input class="form-control mb-3" type="number" name="used_count" min="0" value="0">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Is Active <span style="color: red">*</span></label>
                                <select class="form-control mb-3" name="is_active" >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Starts At</label>
                                <input class="form-control mb-3" type="datetime-local" name="starts_at">

                                <label style="color: rgb(0, 60, 255); margin-bottom:5px">Expires At</label>
                                <input class="form-control mb-3" type="datetime-local" name="expires_at">

                                <button type="submit" class="btn btn-primary">Create Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
