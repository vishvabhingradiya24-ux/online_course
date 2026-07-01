@extends('teacher.dashboard')

@section('content')

<style>
    .main-container {
        padding: 30px;
        background-color: #f4f7fe;
    }

    .form-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background: #ffffff;
        max-width: 850px;
        margin: auto;
    }

    .custom-header {
        background: linear-gradient(135deg, #1e1e4b 0%, #3a3a8e 100%);
        padding: 25px;
        border-radius: 20px 20px 0 0 !important;
        text-align: center;
    }

    .form-label {
        color: #4a5568;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .file-preview-box {
        background: #f8fafc;
        padding: 12px 18px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        margin-top: 10px;
    }

    .btn-update {
        background: #ffc107;
        color: #1e1e4b;
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 800;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .btn-update:hover {
        background: #e5ac00;
        transform: translateY(-2px);
        color: #1e1e4b;
    }

    .btn-cancel {
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        background: #edf2f7;
        color: #4a5568;
        border: none;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
    }
</style>

<div class="main-container">
    <div class="card form-card">
        <div class="card-header custom-header">
            <h4 class="text-white fw-bold mb-0">
                <i class="fa fa-edit me-2"></i> Edit Assignment
            </h4>
            <p class="text-white-50 mb-0 small">Modify the assignment details and update deadlines</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <form action="{{ url('teacher/assignments/update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label">Assignment Title</label>
                    <input type="text" name="title" value="{{ $assignment->title }}" class="form-control" placeholder="Update title" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description / Instructions</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Update instructions...">{{ $assignment->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Related Course</label>
                        <select name="course_id" class="form-control" required>
                            <option value="">-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $assignment->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">New Deadline</label>
                        <input type="date" name="deadline" value="{{ $assignment->deadline }}" class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Update Attachment</label>
                    <input type="file" name="file" class="form-control">
                    
                    @if($assignment->file)
                        <div class="file-preview-box mt-3">
                            <i class="fa fa-file-pdf text-danger me-2 fa-lg"></i>
                            <span class="small fw-bold text-muted me-3">Current: {{ Str::limit($assignment->file, 25) }}</span>
                            <a href="{{ asset('assignments/'.$assignment->file) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fa fa-eye"></i> View File
                            </a>
                        </div>
                    @endif
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ url('teacher/assignments/assignmentList') }}" class="btn btn-cancel">
                        <i class="fa fa-times me-2"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-update">
                        <i class="fa fa-sync-alt me-2"></i> Update Assignment
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection