@extends('frontend.layout.master')
@section('content')


    @include('frontend.pages.homePartials.slider')

    @include('frontend.pages.homePartials.subcategorySlider')

    {{-- @include('frontend.pages.homePartials.banners') --}}

    {{-- @include('frontend.pages.homePartials.newProducts') --}}

    @include('frontend.pages.homePartials.featuredProducts')

    @include('frontend.pages.homePartials.hotDeals')
@endsection
