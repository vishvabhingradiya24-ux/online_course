@extends('Main_Pages.headerpage')

@section('content')

<!-- page title -->
<section class="page-title-section overlay" data-background="{{ asset('images/backgrounds/page-title.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="{{ url('course') }}">Courses</a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">
                        Course Details
                    </li>
                </ul>
                <p class="text-lighten">
                    Explore detailed information about this course.
                </p>
            </div>
        </div>
    </div>
</section>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- course details -->
<section class="section">
    <div class="container">
        <div class="row">

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

            <!-- course content -->
            <div class="col-lg-6">
                <h2 class="mb-3">{{ $course->title }}</h2>

                <p class="mb-2">
                    <strong>Category:</strong>
                    <span class="text-primary">
                        {{ $course->category->name ?? 'No Category' }}
                    </span>
                </p>

                <p class="mb-3">
                    <strong>Price:</strong>
                    <span class="text-success font-weight-bold">
                        ₹ {{ $course->price ?? '0' }}
                    </span>
                </p>

                <p class="mb-4">
                    {{ $course->description }}
                </p>

                <form action="{{ url('course/enroll/'.$course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        Join Now
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection
