@extends('admin.dashboard')

@section('content')

<style>
    :root {
        --edu-navy: #1e1e4b;
        --edu-yellow: #ffbc06;
    }

    .page-wrapper {
        padding: 30px 20px;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    .main-card {
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        background: #fff;
    }

    .card-header-custom {
        background-color: var(--edu-navy);
        padding: 22px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 5px solid var(--edu-yellow);
    }

    /* Table Styling */
    .custom-table {
        width: 100% !important;
        margin-bottom: 0;
        table-layout: fixed;
        border-collapse: collapse;
    }

    .custom-table thead th {
        background-color: #f1f5f9;
        color: var(--edu-navy);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        padding: 18px 25px;
        border: none;
        text-align: left;
    }

    .custom-table tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        word-wrap: break-word;
    }

    /* Column Widths */
    .col-id { width: 7%; text-align: center !important; }
    .col-info { width: 25%; }
    .col-desc { width: 30%; }
    .col-status { width: 13%; text-align: center !important; }
    .col-video { width: 25%; }

    /* Badge Styling */
    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        display: inline-block;
    }
    .badge-active {
        background-color: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }
    .badge-deactive {
        background-color: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .video-badge {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #1e293b;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin: 2px;
        transition: all 0.3s ease;
    }

    .video-badge:hover {
        background: white;
        border-color: var(--edu-yellow);
        transform: translateY(-2px);
    }

    .course-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--edu-navy);
        margin-bottom: 4px;
    }
</style>

<div class="page-wrapper">
    <div class="card main-card">
        <div class="card-header-custom">
            <span class="text-white fw-bold fs-5">
                <i class="fa fa-book-reader me-2 text-edu-yellow"></i> 
                Course Directory <span class="text-white-50 fs-6 fw-normal ms-2">| View Mode</span>
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th class="col-id">No.</th>
                            <th class="col-info">Course & Date</th>
                            <th class="col-desc">Brief Description</th>
                            <th class="col-status">Status</th>
                            <th class="col-video">Available Lectures</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td class="col-id text-center fw-bold text-muted">
                                {{-- અહીં iteration મેન્યુઅલી નંબર આપશે --}}
                                {{ $loop->iteration }}
                            </td>
                            <td class="col-info">
                                <div class="course-title">{{ $course->title }}</div>
                                <div class="text-muted d-flex align-items-center" style="font-size: 10px; font-weight: 600;">
                                    <i class="fa fa-calendar-alt me-1 text-edu-yellow"></i> 
                                    {{ $course->created_at->format('M d, Y') }}
                                </div>
                            </td>
                            <td class="col-desc">
                                <p class="mb-0 text-secondary" style="font-size: 12px; line-height: 1.5;">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                            </td>
                            
                            <td class="col-status text-center">
                                @if($course->status == 'active' || $course->status == 1)
                                    <span class="status-badge badge-active">
                                        <i class="fa fa-check-circle me-1"></i> Active
                                    </span>
                                @else
                                    <span class="status-badge badge-deactive">
                                        <i class="fa fa-times-circle me-1"></i> Deactive
                                    </span>
                                @endif
                            </td>

                            <td class="col-video">
                                @php
                                    $videos = is_array($course->video) ? $course->video : json_decode($course->video, true);
                                @endphp

                                @if(!empty($videos))
                                    <div class="d-flex flex-wrap">
                                        @foreach($videos as $v)
                                            <a href="{{ asset('uploads/videos/'.$v) }}" target="_blank" class="video-badge">
                                                <i class="fa fa-play-circle text-danger me-1"></i> P-{{ $loop->iteration }}
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted italic" style="font-size: 11px;">No videos</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <p class="text-muted">No courses available in the directory.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection