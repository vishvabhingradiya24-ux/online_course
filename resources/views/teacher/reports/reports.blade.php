@extends('teacher.dashboard')

@section('content')

<style>
    .tab-btn {
        padding: 10px 20px;
        border: none;
        background: #eee;
        cursor: pointer;
        margin-right: 5px;
        border-radius: 5px;
        font-weight: 600;
    }

    .tab-btn.active {
        background: #1e1e4b;
        color: white;
    }

    .tab-content {
        display: none;
        margin-top: 20px;
    }

    .tab-content.active {
        display: block;
    }
</style>

<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-edu-navy text-white">
            <h4 class="mb-0">
                📊 Reports Dashboard
            </h4>
        </div>

        <div class="card-body">

            <!-- Tabs -->
            <div>
                <button class="tab-btn active" onclick="openTab('course')">Course Report</button>
                <button class="tab-btn" onclick="openTab('student')">Student Report</button>
                <button class="tab-btn" onclick="openTab('assignment')">Assignment Report</button>
                <button class="tab-btn" onclick="openTab('submission')">Submission Report</button>
            </div>

            <!-- Course Report -->
            <div id="course" class="tab-content active">





                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Course</th>
                                    <th>Total Students</th>
                                    <th>Total Assignments</th>
                                    <th>Total Submissions</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>

                                    <td class="fw-bold">{{ $course->title }}</td>

                                    <!-- Students Count -->
                                    <td>{{ $course->studentDetails->count() }}</td>

                                    <!-- Assignments Count -->
                                    <td>{{ $course->assignments->count() }}</td>

                                    <!-- Submissions Count -->
                                    <td>
                                        {{
                                            $course->assignments->sum(function($a){
                                                return $a->submissions->count();
                                            })
                                        }}
                                    </td>

                                    <td>{{ $course->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No data found</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>


            </div>

            <!-- Student Report -->
            <div id="student" class="tab-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Total Courses</th>
                                <th>Total Assignments</th>
                                <th>Submitted</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($students as $student)

                            @php
                                $courses = $student->studentDetails;

                                $totalAssignments = 0;

                                foreach($courses as $c){
                                    $totalAssignments += $c->course->assignments->count();
                                }

                                $submitted = $student->submissions->count();
                            @endphp

                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>

                                <td>{{ $student->studentDetails->count() }}</td>

                                <td>{{ $totalAssignments }}</td>

                                <td>{{ $submitted }}</td>

                                <td>
                                    @if($submitted >= $totalAssignments && $totalAssignments > 0)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-warning">In Progress</span>
                                    @endif
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No students found</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- Assignment Report -->
            <div id="assignment" class="tab-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course</th>
                                <th>Assignment Title</th>
                                <th>Deadline</th>
                                <th>Total Submissions</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($assignments as $assignment)
                            <tr>
                                <td>{{ $assignment->id }}</td>

                                <td>{{ $assignment->course->title ?? 'N/A' }}</td>

                                <td>{{ $assignment->title }}</td>

                                <td>
                                    {{ $assignment->deadline ? date('d M Y', strtotime($assignment->deadline)) : 'No Deadline' }}
                                </td>

                                <td>{{ $assignment->submissions->count() }}</td>

                                <td>
                                    @if($assignment->submissions->count() > 0)
                                        <span class="badge bg-success">Submitted</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No assignments found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submission Report -->
            <div id="submission" class="tab-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Assignment</th>
                                <th>Submitted File</th>
                                <th>Submitted On</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $submission->id }}</td>

                                <td>{{ $submission->student->name ?? 'N/A' }}</td>

                                <td>{{ $submission->assignment->course->title ?? 'N/A' }}</td>

                                <td>{{ $submission->assignment->title ?? 'N/A' }}</td>

                                <td>
                                    @if($submission->file)
                                        <a href="{{ asset('uploads/submissions/' . $submission->file) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-primary">
                                            View File
                                        </a>
                                    @else
                                        No File
                                    @endif
                                </td>

                                <td>{{ $submission->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No submissions found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
    function openTab(tabName) {

        // hide all
        let contents = document.querySelectorAll('.tab-content');
        contents.forEach(c => c.classList.remove('active'));

        let buttons = document.querySelectorAll('.tab-btn');
        buttons.forEach(b => b.classList.remove('active'));

        // show selected
        document.getElementById(tabName).classList.add('active');

        event.target.classList.add('active');
    }
</script>

@endsection
