@extends('teacher.dashboard')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-edu-navy text-white">
            <h4><i class="fa fa-play"></i> Playing Video</h4>
        </div>
        <div class="card-body text-center bg-dark">
            <video width="80%" controls autoplay>
                <source src="{{ asset('videos/' . $video_name) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="card-footer">
            <a href="{{ url('teacher/courses/coursesList') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection