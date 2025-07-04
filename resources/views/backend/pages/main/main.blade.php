@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body"
                    style="height: calc(100vh - 9rem) ; display:flex !important;align-items:center ; justify-content:center">
                    @if (auth()->check())
                        <div class="container text-center mt-5">
                            <h1 class="animate__animated animate__fadeInDown text-secondary fw-bold">
                                👋 Welcome back, {{ auth()->user()->name }}!
                            </h1>
                            <p class="animate__animated animate__fadeInUp text-muted">
                                We're happy to see you again 😊
                            </p>
                        </div>

                        </h1>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
