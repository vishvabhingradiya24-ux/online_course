@extends('teacher.dashboard')

@section('content')

<style>
    .main-container {
        padding: 40px;
        background-color: #f8fafc;

    }

    .assignment-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 0;
    }


    .custom-header {
        background: #1e1e4b;
        padding: 15px 25px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 4px solid #ffbc06;
    }

    .custom-header h5 {
        font-weight: 600;
        margin: 0;
        font-size: 18px;
    }


    .btn-create {
        background: #ffbc06;
        color: #1e1e4b;
        font-weight: 700;
        padding: 8px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        border: none;
        transition: 0.3s;
    }
    .btn-create:hover { background: #e5a900; color: #1e1e4b; }


    .custom-table { width: 100%; margin-bottom: 0; border-collapse: collapse; }

    .custom-table thead th {
        background: #ffffff;
        color: #1e1e4b;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        text-align: left;
    }

    .custom-table tbody td {
        padding: 18px 20px;
        color: #475569;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        text-align: left;
    }


    .course-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        border: 1px solid #e0e7ff;
    }


    .deadline-badge {
        background: #fef2f2;
        color: #ef4444;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
    }

   
    .btn-action-custom {
        padding: 7px 15px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-right: 5px;
        border: none;
    }
    .bg-view-btn { background: #f0fdf4; color: #16a34a; }
    .bg-edit-btn { background: #eef2ff; color: #4f46e5; }
    .bg-delete-btn { background: #fee2e2; color: #ef4444; }

    .table-responsive { overflow: hidden; }
</style>

<div class="main-container">
    <div class="assignment-card">
        <div class="custom-header">
            <h5><i class="fas fa-tasks me-2"></i> Assignment Management</h5>
            <a href="{{ url('teacher/assignments/assignmentCreate') }}" class="btn-create">
                <i class="fas fa-plus-circle me-1"></i> Add Assignment
            </a>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success m-3 border-0 shadow-sm rounded-3">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Assignment Details</th>
                            <th>Related Course</th>
                            <th>Deadline</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $a)
                        <tr>
                            <td class="fw-bold text-muted"> {{ $a->id }}</td>
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 14px;">{{ $a->title }}</div>
                                <div class="text-muted small" style="font-size: 11px;">
                                    {{ Str::limit($a->description, 45) }}
                                    @if($a->file)
                                        <span class="ms-2 text-primary"><i class="fas fa-paperclip"></i> File</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="course-badge">
                                    <i class="fas fa-book me-1" style="font-size: 10px;"></i>
                                    {{ $a->course->title ?? 'General' }}
                                </span>
                            </td>
                            <td>
                                <span class="deadline-badge">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    {{ date('M d, Y', strtotime($a->deadline)) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    @if($a->file)
                                    <a href="{{ asset('assignments/'.$a->file) }}" target="_blank" class="btn-action-custom bg-view-btn">
                                        <i class="far fa-eye me-1"></i> View
                                    </a>
                                    @endif

                                    <a href="{{ url('teacher/assignments/edit', $a->id) }}" class="btn-action-custom bg-edit-btn">
                                        <i class="far fa-edit me-1"></i> Edit
                                    </a>

                                    <form action="{{ url('teacher/assignments/delete', $a->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-custom bg-delete-btn" onclick="return confirm('Delete this assignment?')">
                                            <i class="far fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No assignments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
