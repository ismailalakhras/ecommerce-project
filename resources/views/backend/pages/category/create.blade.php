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
                    <h6 class="mb-0 text-uppercase">Text Inputs</h6>
                    <hr />
                    <div class="card">
                        <form action="{{ route('admin.category.store') }}" method="POST">
                            @CSRF
                            <div class="card-body">

                                <input class="form-control mb-3" type="text" placeholder="Name" name="name"
                                    aria-label="default input example">

                                <input class="form-control mb-3" type="text" placeholder="Slug" name="slug"
                                    aria-label="default input example">

                                <input class="form-control mb-3" type="text" placeholder="Description" name="description"
                                    aria-label="default input example">

                                <input class="form-control mb-3" type="text" placeholder="Image" name="image"
                                    aria-label="default input example">

                                <input class="form-control mb-3" type="text" placeholder="Meta Title" name="meta_title"
                                    aria-label="default input example">

                                <input class="form-control mb-3" type="text" placeholder="Meta Description"
                                    name="meta_description" aria-label="default input example">

                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
