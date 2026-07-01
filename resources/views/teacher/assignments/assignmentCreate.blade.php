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
        max-width: 800px;
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

    .btn-submit {
        background: #ffc107;
        color: #1e1e4b;
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 800;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .btn-submit:hover {
        background: #e5ac00;
        transform: translateY(-2px);
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

    .info-box {
        background: #f8fafc;
        padding: 12px;
        border-radius: 12px;
        border-left: 4px solid #1e1e4b;
    }
</style>

<div class="main-container">
    <div class="card form-card">
        <div class="card-header custom-header">
            <h4 class="text-white fw-bold mb-0">
                <i class="fa fa-plus-circle me-2"></i> Add New Assignment
            </h4>
            <p class="text-white-50 mb-0 small">Create a new task for your students</p>
        </div>

        <div class="card-body p-4 p-md-5">
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <ul class="mb-0 fw-bold small">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa fa-exclamation-triangle me-2"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('teacher/assignments/store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Assignment Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Mid-Term Project" value="{{ old('title') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description / Instructions</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Write detailed instructions for students..." required>{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Select Course</label>
                        <select name="course_id" class="form-control" required>
                            <option value="">-- Choose Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Submission Deadline</label>
                        <input type="date" name="deadline" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Attachment (Optional)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;">
                            <i class="fa fa-file-pdf text-muted"></i>
                        </span>
                        <input type="file" name="file" class="form-control border-start-0" style="border-radius: 0 12px 12px 0;">
                    </div>
                    <div class="info-box mt-3 small text-muted">
                        <i class="fa fa-info-circle text-primary me-1"></i> 
                        You can upload a PDF, DOCX, or Image containing the assignment questions.
                    </div>
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ url('teacher/assignments/assignmentList') }}" class="btn btn-cancel">
                        <i class="fa fa-arrow-left me-2"></i> Back to List
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fa fa-check-circle me-2"></i> Create Assignment
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection