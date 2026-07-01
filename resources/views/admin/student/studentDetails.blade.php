@extends('admin.dashboard')

@section('content')
<style>
    /* Banner and Profile Styling */
    .profile-banner {
        background: #1e1e4b;
        height: 140px;
        border-radius: 12px 12px 0 0;
        display: flex;
        align-items: center;
        padding: 0 30px;
    }

    .profile-content {
        padding: 0 40px 40px;
        margin-top: -60px;
    }

    .profile-img {
        width: 120px;
        height: 120px;
        background: #ffbc06;
        border: 6px solid #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        font-weight: bold;
        color: #1e1e4b;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }

    .back-btn {
        background: #fff;
        color: #1e1e4b;
        border-radius: 8px;
        padding: 10px 22px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .back-btn:hover {
        background: #f1f5f9;
        transform: translateX(-5px);
    }

    /* Table Full Width Styling */
    .course-card-container {
        width: 100%;
        margin-top: 30px;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .custom-table {
        width: 100% !important;
        border-collapse: collapse;
        table-layout: fixed; 
    }

    .custom-table thead th {
        background-color: #f8fafc;
        color: #1e1e4b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        padding: 18px 25px;
        border-bottom: 2px solid #edf2f7;
        text-align: left;
    }

    .custom-table tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        font-size: 15px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        text-align: left;
    }

    /* Column Widths */
    .col-title { width: 35%; }
    .col-instructor { width: 25%; }
    .col-date { width: 20%; }
    .col-status { width: 20%; }

    .status-badge {
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .bg-processing { background: #fef3c7; color: #92400e; }
    .bg-completed { background: #dcfce7; color: #166534; }
</style>

<div class="container-fluid mt-4 px-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="profile-banner">
            <a href="{{ url('admin/students') }}" class="back-btn">
                <i class="fa fa-arrow-left me-2"></i> Back to List
            </a>
        </div>

        <div class="profile-content">
            <div class="d-flex align-items-end mb-4">
                <div class="profile-img">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                <div class="ms-4 mb-2">
                    <h1 class="fw-bold text-dark mb-1">{{ $student->name }}</h1>
                    <p class="text-muted mb-0 fs-5">
                        <i class="fa fa-envelope-o me-2"></i>{{ $student->email }}
                        <span class="mx-3 text-light">|</span>
                        <i class="fa fa-id-badge me-2"></i>Student ID :: <strong> {{ $student->id }}</strong>
                    </p>
                </div>
            </div>

            <hr class="my-4 opacity-10">

            <div class="mt-2">
                <h4 class="fw-bold text-dark mb-4">
                    <i class="fa fa-book text-warning me-2"></i> Enrolled Courses
                </h4>

                <div class="table-responsive course-card-container">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th class="col-title">Course Title</th>
                                <th class="col-instructor">Instructor</th>
                                <th class="col-date">Enroll Date</th>
                                <th class="col-status">Progress Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student->studentdetails as $enroll)
                            <tr>
                                <td class="col-title fw-bold text-dark">
                                    <i class="fa fa-graduation-cap me-2 text-muted"></i>
                                    {{ $enroll->course->title ?? 'N/A' }}
                                </td>
                                <td class="col-instructor">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-user-circle-o me-2 text-muted"></i>
                                        {{ $enroll->course->teacher->name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="col-date">
                                    {{ date('d M, Y', strtotime($enroll->enroll_date)) }}
                                </td>
                                <td class="col-status">
                                    @if($enroll->complete_date)
                                        <span class="status-badge bg-completed">
                                            <i class="fa fa-check-circle me-1"></i> Completed
                                        </span>
                                    @else
                                        <span class="status-badge bg-processing">
                                            <i class="fa fa-clock-o me-1"></i> Processing
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fa fa-folder-open-o fa-3x mb-3 opacity-25"></i>
                                        <p class="fs-5">No courses enrolled yet.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
