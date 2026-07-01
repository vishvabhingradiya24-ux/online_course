@extends('admin.dashboard')

@section('content')

<style>
    .edit-container {
        max-width: 850px;
        margin: 30px auto;
    }
    .edit-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .edit-header {
        background: #1e1e4b; /* Navy Blue */
        color: white;
        padding: 20px 30px;
    }
    .form-label {
        font-weight: 700;
        color: #1e1e4b;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
    }
    .form-control {
        border-radius: 10px;
        padding: 12px;
        border: 1px solid #e2e8f0;
    }
    .form-control:focus {
        border-color: #ffbc06;
        box-shadow: 0 0 0 3px rgba(255, 188, 6, 0.1);
    }
    .current-videos {
        background: #f8fafc;
        padding: 15px;
        border-radius: 12px;
        border: 1px solid #edf2f7;
    }
    .video-item {
        background: white;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 12px;
    }
    .bg-edu-yellow { background-color: #ffbc06; color: #1e1e4b; border: none; }
    .bg-edu-yellow:hover { background-color: #e5a905; transform: translateY(-1px); }
</style>

<div class="container-fluid">
    <div class="edit-container">
        
        <div class="card edit-card">
            <div class="edit-header">
                <h4 class="mb-0 fw-bold">
                    <i class="fa fa-edit me-2 text-warning"></i> Edit Course Details
                </h4>
                <small class="opacity-75">Update the information for course ID: #{{ $course->id }}</small>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ url('admin/courses/update/' . $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Course Title</label>
                        <input type="text" name="title" class="form-control" 
                               value="{{ old('title', $course->title) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Course Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Currently Uploaded Videos</label>
                        <div class="current-videos">
                            @php
                                $videos = is_array($course->video) ? $course->video : json_decode($course->video, true);
                            @endphp
                            @if(!empty($videos))
                                @foreach($videos as $v)
                                    <div class="video-item">
                                        <i class="fa fa-play-circle text-danger me-2"></i> {{ Str::limit($v, 20) }}
                                    </div>
                                @endforeach
                            @else
                                <span class="text-muted small">No videos found.</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Update Videos (Optional)</label>
                        <input type="file" name="videos[]" class="form-control" multiple accept="video/*">
                        <small class="text-muted d-block mt-2">
                            <i class="fa fa-info-circle me-1"></i> Selecting new videos will replace the existing ones.
                        </small>
                    </div>

                    <div class="d-flex gap-2 mt-5">
                        <button type="submit" class="btn bg-edu-yellow fw-bold px-4 py-2">
                            <i class="fa fa-save me-2"></i> UPDATE COURSE
                        </button>
                        <a href="{{ url('admin/courses') }}" class="btn btn-light fw-bold px-4 py-2 border">
                            CANCEL
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection