@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">

        <div class="page-content">


            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Category</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Create New Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->



            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Update Category Form</h6>
                    <hr />
                    <div class="card">
                        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                            @CSRF
                            @method('PUT')
                            <div class="card-body">
                                <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Category Name <span
                                        style="color: red ; margin-bottom:5px">*</span></label>

                                <input class="form-control mb-3" type="text" name="name" value={{ $category->name }}>


                                <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Slug</label>

                                <input class="form-control mb-3" type="text" name="slug" value={{ $category->slug }}>



                                <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Description</label>

                                <textarea class="form-control mb-3" type="text" name="description" rows="5" cols="50">{{ $category->description }}</textarea>


                                <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Image</label>

                                <input class="form-control mb-3" type="text" name="image" value={{ $category->image }}>


                                <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Meta Title</label>

                                <input class="form-control mb-3" type="text"
                                    name="meta_title"value={{ $category->meta_title }}>


                                <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Meta Description</label>

                                <textarea class="form-control mb-3" type="text" name="meta_description" rows="5" cols="50">{{ $category->meta_description }}</textarea>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
