@extends('frontend.layouts.app')

@section('title', 'Alamgir Hai Art Gallery')

@section('content')
    @include('frontend.welcome_page.header')
    @include('frontend.welcome_page.banner')
    @include('frontend.welcome_page.about')
    @include('frontend.welcome_page.family_moments')
    @include('frontend.welcome_page.testimonials')
    @include('frontend.welcome_page.footer')
@endsection
