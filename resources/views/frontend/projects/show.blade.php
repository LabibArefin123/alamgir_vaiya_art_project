@extends('frontend.layouts.app')

@section('title', $project->title . ' | Projects')

@section('content')

    @include('frontend.welcome_page.header')

    <link rel="stylesheet" href="{{ asset('css/frontend/custom_project.css') }}">

    <section class="py-5 bg-white">

        <div class="container">

            {{-- HEADER --}}
            <div class="text-center mb-5">
                <h2 class="projects-title">{{ $project->title }}</h2>
                <p class="projects-subtitle">
                    {{ $project->category }}
                </p>
            </div>

            {{-- COVER IMAGE --}}
            <div class="mb-5 text-center">
                <img src="{{ asset($project->image) }}" class="img-fluid rounded shadow"
                    style="max-height:400px; object-fit:cover;">
            </div>

            {{-- SUB PROJECT GALLERY --}}
            <div class="row g-4">

                @if ($project->subProjects->count())
                    @foreach ($project->subProjects as $sub)
                        <div class="col-lg-4 col-md-6">
                            <div class="sub-project-card">

                                <img src="{{ asset($sub->image) }}" alt="{{ $sub->title ?? 'image' }}">

                                @if ($sub->title)
                                    <div class="sub-overlay">
                                        <h6>{{ $sub->title }}</h6>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted">
                       
                    </div>
                @endif

            </div>

        </div>

    </section>

    @include('frontend.welcome_page.footer')

@endsection
