@extends('frontend.layouts.app')

@section('title', 'TechnoTech Engineering Ltd.')

@section('content')
    @include('frontend.welcome_page.header')
    @include('frontend.welcome_page.banner')
    @include('frontend.welcome_page.about')
    @include('frontend.welcome_page.services')
    @include('frontend.welcome_page.project')
    @include('frontend.welcome_page.activities')
    @include('frontend.welcome_page.skill')
    @include('frontend.welcome_page.contact-cta')
    @include('frontend.welcome_page.latest_news')
    @include('frontend.welcome_page.footer')
@endsection
