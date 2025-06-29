@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Orders Summary</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Category id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Is_active</th>
                                    <th>Sort_order</th>
                                    <th>Meta_title</th>
                                    <th>Meta_description</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }} </td>
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


                                        <td>
                                            <div class="d-flex order-actions">
                                                <form action="category-delete/{{ $category->id }}" method="POST"
                                                    class="d-inline">
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


                                                <form method="GET" action="admin/category-edit/{{ $category->id }}">
                                                    @csrf

                                                    <button type="submit"class="update-btn btn btn-sm  mb-0 px-2 py-1 ">
                                                        <a href="javascript:;" class="ms-4">
                                                            <i class="fas fa-edit text-success" style="font-size: 1.1rem">
                                                            </i>
                                                        </a>
                                                    </button>
                                                </form>




                                            </div>
                                        </td>
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
