@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">

        <div class="page-content">


            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Subcategory</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Update Subcategory</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->



            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Update Subcategory Form</h6>
                    <hr />
                    <div class="card">
                        <form action="{{ route('admin.subcategory.update', $subcategory) }}" method="POST">
                            @CSRF
                            @method('PUT')
                            <div class="card-body">

                                <div class="card-body">
                                    <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Subcategory Name <span
                                            style="color: red ; margin-bottom:5px">*</span></label>

                                    <input class="form-control mb-3" type="text" name="name"
                                        value={{ $subcategory->name }}>



                                    <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Category Name <span
                                            style="color: red ; margin-bottom:5px">*</span></label>

                                    <select name="category_id" class="form-control mb-3">
                                        <option disabled selected>-- Choose a Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $subcategory->category->id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>




                                    <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Slug <span
                                            style="color: red ; margin-bottom:5px">*</span></label>

                                    <input class="form-control mb-3" type="text" name="slug"
                                        value={{ $subcategory->slug }}>



                                    <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Description</label>

                                    <textarea class="form-control mb-3" type="text" name="description" rows="5" cols="50">{{ $subcategory->description }}</textarea>



                                    <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Image</label>

                                    <input class="form-control mb-3" type="text" name="image"
                                        value={{ $subcategory->image }}>



                                    <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Meta Title</label>

                                    <input class="form-control mb-3" type="text" name="meta_title"
                                        value={{ $subcategory->meta_title }}>



                                    <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Meta Description</label>

                                    <textarea class="form-control mb-3" type="text" name="meta_description" rows="5" cols="50">{{ $subcategory->meta_description }}</textarea>



                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
