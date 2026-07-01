{{-- @extends('Main_Pages.headerpage')

@section('content')

      <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <section class="bg-[#1a1c3d] py-16 text-center" style="padding-top: 220px">
        <h1 class="text-white text-4xl font-black">EXPLORE OUR <span class="text-yellow-500">COURSES</span></h1>
        <p class="text-gray-400 mt-2 text-sm uppercase tracking-widest">Master the skills of the future</p>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-6">

            <div class="filters text-center mb-4">
                <button class="btn btn-primary">All</button>

                @foreach($categories as $category)
                    <button class="btn btn-light">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <div class="row">
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 h-100">

                            <img src="{{ asset('uploads/course_images/' . $course->image) }}"
                                class="card-img-top"
                                style="height:220px; object-fit:cover;">

                            <div class="card-body">
                                <small class="text-muted">
                                    {{ $course->category->name ?? 'No Category' }}
                                </small>

                                <h5 class="fw-bold mt-2">{{ $course->title }}</h5>

                                <p class="text-muted">
                                    {{ Str::limit($course->description, 80) }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold text-dark">
                                        ₹ {{ $course->price ?? '0' }}
                                    </span>

                                    <a href="#" class="text-warning fw-bold text-decoration-none">
                                        JOIN NOW →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @endsection --}}



@extends('Main_Pages.headerpage')

@section('content')

<section class="page-title-section overlay" data-background="{{ asset('assets/images/backgrounds/page-title.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="#">Courses</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">Our Courses</li>
                </ul>
                <p class="text-lighten">
                    Explore our latest courses and enhance your skills with industry-relevant content.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">

        <!-- Category Buttons -->
        <div class="row mb-5">
            <div class="col-12 text-center">

                <a href="{{ url('course') }}"
                   class="btn btn-sm mx-1 {{ request()->segment(2) == null ? 'btn-primary' : 'btn-outline-primary' }}">
                    ALL
                </a>

                @foreach($categories as $category)
                    <a href="{{ url('course/'.$category->id) }}"
                       class="btn btn-sm mx-1 {{ request()->segment(2) == $category->id ? 'btn-primary' : 'btn-outline-primary' }}">
                        {{ strtoupper($category->name) }}
                    </a>
                @endforeach

            </div>
        </div>

        <!-- Course Cards -->
        <div class="row">



            @forelse($courses as $course)
                <div class="col-lg-4 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">

                       @php
                            $videos = json_decode($course->video, true);
                        @endphp

                        @if(!empty($videos[0]))
                            <video width="100%" height="220" controls>
                                <source src="{{ asset('videos/'.$videos[0]) }}" type="video/mp4">
                            </video>
                        @else
                            <h3>No Video Available  </h3>
                            {{-- <img src="{{ asset('uploads/course_images/'.$course->image) }}" width="100%"> --}}
                        @endif 
                        {{-- <!-- Course Image -->
                        @if($course->video)
                            <video class="card-img-top rounded-0" controls style="height:220px; object-fit:cover;">
                                <source src="{{ asset('uploads/course_videos/'.$course->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <img class="card-img-top rounded-0"
                                src="{{ asset('uploads/course_images/'.$course->image) }}"
                                alt="{{ $course->title }}"
                                style="height:220px; object-fit:cover;">
                        @endif --}}

                        <div class="card-body">

                            <!-- Category -->
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item">
                                    <span class="text-color">
                                        {{ $course->category->name ?? 'No Category' }}
                                    </span>
                                </li>
                            </ul>

                            <!-- Title -->
                            <a href="#">
                                <h4 class="card-title">{{ $course->title }}</h4>
                            </a>

                            <!-- Description -->
                            <p class="card-text mb-4">
                                {{ Str::limit($course->description, 80) }}
                            </p>

                            <!-- Footer -->
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold text-dark">
                                    ₹ {{ $course->price ?? '0' }}
                                </span>

                                <a href="{{ url('course/details/'.$course->id) }}" class="btn btn-primary btn-sm">
                                    Join Now
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <h5>No courses found in this category.</h5>
                </div>
            @endforelse

        </div>
    </div>
</section>

@endsection

