@extends('admin.dashboard')

@section('content')

<style>

    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .edu-card {
        background: #fff;
        border-radius: 15px;
        border: none;
        overflow: hidden;
    }
    .edu-header {
        background-color: #1e1e4b; 
        padding: 20px;
        color: white;
    }
    .form-label {
        color: #1e1e4b;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #ffbc06;
        box-shadow: 0 0 0 3px rgba(255, 188, 6, 0.15);
    }
    .upload-area {
        border: 2px dashed #cbd5e1;
        padding: 20px;
        border-radius: 12px;
        background: #f8fafc;
        text-align: center;
        transition: 0.3s;
    }
    .upload-area:hover {
        border-color: #ffbc06;
        background: #fff;
    }
    .bg-edu-yellow {
        background-color: #ffbc06 !important;
        color: #1e1e4b !important;
        border: none !important;
    }
    .bg-edu-yellow:hover {
        background-color: #e5a905 !important;
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid mt-5">
    <div class="form-container">

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card edu-card shadow-lg">
            <div class="edu-header d-flex align-items-center justify-content-between">
                <h4 class="mb-0 fw-bold">
                    <i class="fa fa-plus-circle me-2 text-warning"></i> Add New Course
                </h4>
                <a href="{{ url('admin/courses') }}" class="text-white opacity-75 text-decoration-none small">
                    <i class="fa fa-times"></i>
                </a>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ url('admin/courses') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold">Course Title</label>
                        <input type="text" name="title" class="form-control"
                               placeholder="e.g. Full Stack Web Development"
                               value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Course Description</label>
                        <textarea name="description" class="form-control" rows="5"
                                  placeholder="Briefly describe what this course covers..."
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Course Content (Videos)</label>
                        <div class="upload-area">
                            <i class="fa fa-cloud-upload-alt fa-2x mb-3 text-muted"></i>
                            <input type="file" name="videos[]" class="form-control"
                                   multiple accept="video/mp4,video/x-m4v,video/*">
                            <p class="small text-muted mt-2 mb-0">
                                <i class="fa fa-info-circle me-1"></i> Max 50MB per video. MP4, MOV or AVI allowed.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-5">
                        <button type="submit" class="btn bg-edu-yellow fw-bold px-5 py-2 shadow-sm flex-grow-1 flex-md-grow-0">
                            <i class="fa fa-check-circle me-2"></i> UPLOAD COURSE
                        </button>

                        <a href="{{ url('admin/courses') }}" class="btn btn-light fw-bold px-4 py-2 border flex-grow-1 flex-md-grow-0">
                            CANCEL
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <p class="text-center text-muted small mt-4">
            Educenter Dashboard &copy; 2026
        </p>
    </div>
</div>

@endsection
