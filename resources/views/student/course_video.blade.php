@extends('student.overview')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">{{ $course->title }}</h2>

    <div class="card shadow p-4">
        <video width="100%" height="500" controls>
            <source src="{{ asset('videos/'.$video) }}" type="video/mp4">
        </video>
    </div>
</div>

@endsection