@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Coupons Overview</h5>
                        </div>
                        <div class="font-22 ms-auto">
                            <a href="{{ route('admin.coupon.create') }}" class="btn btn-warning text-white">
                                <i class="bx bx-layer-plus"></i> Insert
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive" style="max-height: calc(100vh - 14.5rem); overflow-y: auto;">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="position: sticky; top:0"></th>
                                    <th style="position: sticky; top:0">id</th>
                                    <th style="position: sticky; top:0">Code</th>
                                    <th style="position: sticky; top:0">Type</th>
                                    <th style="position: sticky; top:0">Value</th>
                                    <th style="position: sticky; top:0">Min Amount</th>
                                    <th style="position: sticky; top:0">Usage Limit</th>
                                    <th style="position: sticky; top:0">Used Count</th>
                                    <th style="position: sticky; top:0">Is Active</th>
                                    <th style="position: sticky; top:0">Starts At</th>
                                    <th style="position: sticky; top:0">Expires At</th>
                                    <th style="position: sticky; top:0">Created At</th>
                                    <th style="position: sticky; top:0">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td style="background: #0000000a !important; padding:0">
                                            <div class="d-flex order-actions">
                                                <form action="{{ route('admin.coupon.delete', $coupon->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn btn btn-sm mb-0 px-2 py-1" title="Delete">
                                                        <i class="far fa-trash-alt text-danger" style="font-size: 1.1rem"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="ms-3 update-btn btn btn-sm mb-0 px-2 py-1">
                                                    <i class="fas fa-edit text-success" style="font-size: 1.1rem"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->type }}</td>
                                        <td>{{ $coupon->value }}</td>
                                        <td>{{ $coupon->minimum_amount ?? '-' }}</td>
                                        <td>{{ $coupon->usage_limit ?? '-' }}</td>
                                        <td>{{ $coupon->used_count }}</td>
                                        <td>
                                            <span class="badge {{ $coupon->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $coupon->starts_at }}</td>
                                        <td>{{ $coupon->expires_at }}</td>
                                        <td>{{ $coupon->created_at }}</td>
                                        <td>{{ $coupon->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
