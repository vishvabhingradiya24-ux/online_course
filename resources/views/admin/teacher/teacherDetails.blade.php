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

    .info-badge {
        background: #e0e7ff;
        color: #4338ca;
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
        display: inline-block;
    }

    /* Table Full Width Styling */
    .course-card-wrapper {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        margin-top: 25px;
        overflow: hidden;
        background: #fff;
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

    
    .col-name { width: 40%; }
    .col-category { width: 20%; }
    .col-date { width: 20%; }
    .col-action { width: 20%; text-align: center !important; }

    .btn-edit-link {
        color: #4338ca;
        font-weight: 700;
        text-decoration: none;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-edit-link:hover {
        color: #ffbc06;
        text-decoration: underline;
    }
</style>

<div class="container-fluid mt-4 px-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="profile-banner">
            <a href="{{ url('admin/teachers') }}" class="back-btn">
                <i class="fa fa-arrow-left me-2"></i> Back to Teachers
            </a>
        </div>

        <div class="profile-content">
            <div class="d-flex align-items-end mb-4">
                <div class="profile-img">{{ strtoupper(substr($teacher->name, 0, 1)) }}</div>
                <div class="ms-4 mb-2">
                    <h1 class="fw-bold text-dark mb-1">{{ $teacher->name }}</h1>
                    <p class="text-muted mb-2">
                        <i class="fa fa-envelope-o me-2"></i>{{ $teacher->email }}
                        <span class="mx-3">|</span>
                        <i class="fa fa-phone me-2"></i>{{ $teacher->mobileno ?? 'N/A' }}
                    </p>
                    <span class="info-badge">Expert Instructor</span>
                </div>
            </div>

            <hr class="my-4 opacity-10">

            <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-dark mb-0">
                        <i class="fa fa-briefcase text-warning me-2"></i> Courses Managed
                    </h4>
                    <span class="badge bg-dark px-3 py-2 rounded-pill">Total: {{ $teacher->courses->count() }}</span>
                </div>

                <div class="table-responsive course-card-wrapper">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th class="col-name">Course Name</th>
                                <th class="col-category">Category</th>
                                <th class="col-date">Created Date</th>
                                <th class="col-action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teacher->courses as $course)
                            <tr>
                                <td class="col-name fw-bold text-dark">
                                    <i class="fa fa-book me-2 text-muted"></i>{{ $course->title }}
                                </td>
                                <td class="col-category">
                                    <span class="text-muted">{{ $course->category->name ?? 'General' }}</span>
                                </td>
                                <td class="col-date">
                                    {{ date('d M, Y', strtotime($course->created_at)) }}
                                </td>
                                <td class="col-action">
                                    <form action="{{ url('admin/courses/delete', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-edit-link text-danger border-0 bg-transparent">
                                            <i class="fa fa-trash me-1"></i> Delete Course
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fa fa-folder-open-o fa-3x mb-3 opacity-25"></i>
                                        <p class="fs-5">No courses assigned to this teacher yet.</p>
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
