@extends('admin.dashboard')

@section('content')

<div class="container mt-4">

    <!-- Teacher Info -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h5>Teacher Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $teacher->name }}</p>
            <p><strong>Email:</strong> {{ $teacher->email }}</p>
        </div>
    </div>

    <!-- Courses -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Uploaded Courses</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Upload Date</th>
                        <th>Total Students</th>
                        <th>Students List</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($teacher->courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>

                        <td>{{ $course->created_at->format('d M Y') }}</td>

                        <td>
                            <span class="badge bg-info">
                                {{ $course->studentdetails->count() }} Students
                            </span>
                        </td>

                        <td>
                            @if($course->studentdetails->count())
                                <ul class="mb-0">
                                    @foreach($course->studentdetails as $enroll)
                                        <li>{{ $enroll->student->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No Students</span>
                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            No courses uploaded
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
