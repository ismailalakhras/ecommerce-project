@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Categories Overview</h5>
                        </div>
                        <div class="font-22 ms-auto">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-warning text-white">
                                <i class="bx bx-layer-plus"></i> insert
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive" style="max-height: calc(100vh - 14.5rem); overflow-y: auto;">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="position: sticky ; top:0"></th>
                                    <th style="position: sticky ; top:0">Category id</th>
                                    <th style="position: sticky ; top:0">Name</th>
                                    <th style="position: sticky ; top:0">Slug</th>
                                    <th style="position: sticky ; top:0">Description</th>
                                    <th style="position: sticky ; top:0">Is_active</th>
                                    <th style="position: sticky ; top:0">Sort_order</th>
                                    <th style="position: sticky ; top:0">Meta_title</th>
                                    <th style="position: sticky ; top:0">Meta_description</th>
                                    <th style="position: sticky ; top:0">Created_at</th>
                                    <th style="position: sticky ; top:0">Updated_at</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($categories as $category)
                                    <tr>

                                        <td style="background: #0000000a  !important ; padding:0">
                                            <div class="d-flex order-actions">
                                                <form action="{{ route('admin.category.delete', $category->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn btn btn-sm mb-0 px-2 py-1"
                                                        title="Delete">
                                                        <a href="">
                                                            <i class="far fa-trash-alt text-danger"
                                                                style="font-size: 1.1rem">
                                                            </i>
                                                        </a>
                                                    </button>
                                                </form>


                                                <form method="GET"
                                                    action="{{ route('admin.category.edit', $category->id) }}">
                                                    @csrf

                                                    <button type="submit"class="update-btn btn btn-sm  mb-0 px-2 py-1 ">
                                                        <a href="javascript:;" class="ms-4" style="margin: 0 !important">
                                                            <i class="fas fa-edit text-success" style="font-size: 1.1rem">
                                                            </i>
                                                        </a>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td style="text-align: center">{{ $category->id }} </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ asset($category->image) }}" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ $category->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <div class="badge rounded-pill bg-light-info text-info w-100">
                                                {{ $category->is_active }}
                                            </div>
                                        </td>
                                        <td>{{ $category->sort_order }}</td>
                                        <td>{{ $category->meta_title }}</td>
                                        <td>{{ $category->meta_description }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>



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
