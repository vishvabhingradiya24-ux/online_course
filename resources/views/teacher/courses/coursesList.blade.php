@extends(Auth::user()->user_type == 'admin' ? 'admin.dashboard' : 'teacher.dashboard')

@section('content')

<style>
    .main-container { padding: 20px; background-color: #f8fafc; }
    .course-card { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; overflow: hidden; }
    .custom-header { background: #1e1e4b; padding: 12px 25px; color: white; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid #ffbc06; }
    .custom-header h5 { font-weight: 600; margin: 0; font-size: 17px; }
    .btn-create { background: #ffbc06; color: #1e1e4b; font-weight: 700; padding: 6px 18px; border-radius: 6px; text-decoration: none; font-size: 13px; border: none; }
    .custom-table { width: 100%; margin-bottom: 0; border-collapse: collapse; }
    .custom-table thead th { background: #ffffff; color: #1e1e4b; font-size: 12px; font-weight: 800; text-transform: uppercase; padding: 15px 20px; border-bottom: 1px solid #f1f5f9; }
    .custom-table tbody td { padding: 12px 20px; color: #475569; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

    /* Video Link Style */
    .video-link {
        background: #eef2ff;
        color: #4f46e5;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        margin-right: 5px;
        border: 1px solid #4f46e5;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: 0.3s;
    }
    .video-link:hover { background: #4f46e5; color: white; }

    .btn-edit-custom { background: #eef2ff; color: #4f46e5; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 12px; text-decoration: none; margin-right: 5px; }
    .btn-delete-custom { background: #fee2e2; color: #ef4444; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 12px; border: none; cursor: pointer; }

    /* Status Button Styling */
    .status-pill { font-size: 10px; font-weight: 900; padding: 5px 12px; border-radius: 5px; border: none; cursor: pointer; transition: 0.2s; }
    .status-active { background: #ecfdf5; color: #10b981; border: 1px solid #10b981; }
    .status-deactive { background: #fef2f2; color: #ef4444; border: 1px solid #ef4444; }
    .status-pill:hover { opacity: 0.8; transform: translateY(-1px); }

    .instructor-badge { background: #f1f5f9; color: #1e293b; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; }
</style>

<div class="main-container">
    <div class="course-card">
        <div class="custom-header">
            <h5><i class="fas fa-list-ul me-2"></i> Course Management</h5>
            @if(Auth::user()->user_type == 'teacher')
            <a href="{{ url('teacher/courses/courseCreate') }}" class="btn-create">
                <i class="fas fa-plus-circle me-1"></i> Add Course
            </a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">No.</th>
                        <th>Course Name</th>
                        @if(Auth::user()->user_type == 'admin')
                            <th>Instructor</th>
                        @endif
                        <th>Watch Videos</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td class="fw-bold text-muted">
                            
                            {{ $loop->iteration }}
                        </td>
                        <td><div class="fw-bold text-dark">{{ $course->title }}</div></td>

                        @if(Auth::user()->user_type == 'admin')
                        <td>
                            <span class="instructor-badge">
                                <i class="fas fa-user-tie me-1"></i> {{ $course->teacher->name ?? 'Unknown' }}
                            </span>
                        </td>
                        @endif

                        <td>
                            @php
                                $videos = is_array($course->video) ? $course->video : json_decode($course->video, true);
                            @endphp
                            @if(!empty($videos))
                                @foreach($videos as $v)
                                    <a href="{{ asset('uploads/videos/' . $v) }}" target="_blank" class="video-link">
                                        <i class="fas fa-play-circle me-1"></i> Part {{ $loop->iteration }}
                                    </a>
                                @endforeach
                            @else
                                <span class="text-muted small">No Video</span>
                            @endif
                        </td>

                        <td>
                            @php
                                $statusBaseUrl = (Auth::user()->user_type == 'admin') ? 'admin/courses/status' : 'teacher/courses/status';
                            @endphp

                            <form action="{{ url($statusBaseUrl . '/' . $course->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="status-pill {{ $course->status == 1 ? 'status-active' : 'status-deactive' }}" onclick="return confirm('Change course status?')">
                                    {{ $course->status == 1 ? 'Active' : 'Deactive' }}
                                </button>
                            </form>
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                @php
                                    $editUrl = Auth::user()->user_type == 'admin' ? 'admin/courses/edit' : 'teacher/courses/edit';
                                    $deleteUrl = Auth::user()->user_type == 'admin' ? 'admin/courses/delete' : 'teacher/courses/delete';
                                @endphp

                                <a href="{{ url($editUrl . '/' . $course->id) }}" class="btn-edit-custom">Edit</a>

                                <form action="{{ url($deleteUrl . '/' . $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-custom" onclick="return confirm('Delete this course?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->user_type == 'admin' ? '6' : '5' }}" class="text-center py-4 text-muted">No courses found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
