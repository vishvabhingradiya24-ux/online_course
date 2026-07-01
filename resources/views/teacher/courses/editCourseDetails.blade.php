@extends('teacher.dashboard')

@section('content')

<style>
    .main-container {
        padding: 30px;
        background-color: #f4f7fe;
        min-height: 100vh;
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

    .video-badge {
        background: #eef2ff;
        color: #4f46e5;
        border: 1px solid #e0e7ff;
        padding: 8px 15px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
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

    .video-info-box {
        background: #fffdf5;
        padding: 15px;
        border-radius: 12px;
        border: 1px dashed #ffc107;
    }
</style>

<div class="main-container">
    <div class="card form-card">
        <div class="card-header custom-header">
            <h4 class="text-white fw-bold mb-0">
                <i class="fa fa-edit me-2"></i> Edit Course Details
            </h4>
            <p class="text-white-50 mb-0 small">Update your course content and information</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <form action="{{ url('teacher/courses/update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label">Course Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $course->title }}" placeholder="Enter course title" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Course Description</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Update description..." required>{{ trim($course->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label d-block text-muted">Current Course Videos</label>
                    <div class="video-info-box">
                        <div class="d-flex flex-wrap gap-2">
                            @php $videos = json_decode($course->video, true) ?: []; @endphp
                            @forelse($videos as $v)
                                <span class="video-badge">
                                    <i class="fa fa-play-circle me-2 text-danger"></i> {{ $v }}
                                </span>
                            @empty
                                <span class="text-muted small italic">No videos uploaded yet.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-primary">Upload New Videos</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;">
                            <i class="fa fa-cloud-upload-alt text-muted"></i>
                        </span>
                        <input type="file" name="videos[]" class="form-control border-start-0" style="border-radius: 0 12px 12px 0;" multiple accept="video/*">
                    </div>
                    <p class="text-muted mt-2 small">
                        <i class="fa fa-lightbulb text-warning me-1"></i> 
                        Note: You can select multiple new files. They will be added to the existing list.
                    </p>
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ url('teacher/courses/coursesList') }}" class="btn btn-cancel">
                        <i class="fa fa-times me-2"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-update">
                        <i class="fa fa-sync-alt me-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection