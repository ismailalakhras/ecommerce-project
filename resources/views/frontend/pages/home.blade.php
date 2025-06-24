@extends('frontend.layout.master')
@section('home')

    {{-- @include('frontend.pages.homePartials.quickView') --}}

    {{-- @include('frontend.pages.homePartials.slider') --}}

    {{-- @include('frontend.pages.homePartials.categorySlider') --}}

    {{-- @include('frontend.pages.homePartials.banners') --}}

    {{-- @include('frontend.pages.homePartials.newProducts') --}}

    @include('frontend.pages.homePartials.featuredProducts')

    {{-- @include('frontend.pages.homePartials.hotDeals') --}}
@endsection
