@extends('student.overview')

@section('content')

<div class="container mt-5">
    <div class="bg-white shadow rounded p-4">

        <h2 class="text-3xl font-bold mb-4">
            {{ $course->course_name }}
        </h2>

        <p class="text-gray-600 mb-4">
            {{ $course->description }}
        </p>

        <video id="courseVideo" width="100%" height="500" controls class="rounded shadow">
            <source src="{{ asset('videos/'.$video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="mt-4">
            <p>
                Lesson {{ $currentIndex + 1 }} of {{ count($videos) }}
            </p>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$('#courseVideo').on('ended', function () {
    $.ajax({
        url: "{{ url('student/course/save-progress') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            course_id: "{{ $course->id }}",
            current_index: "{{ $currentIndex }}"
        },
        success: function(response){
            location.reload();
        }
    });
});
</script>

@endsection