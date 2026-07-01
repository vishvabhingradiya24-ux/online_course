@extends('admin.dashboard')

@section('content')

<style>
    .page-wrapper {
        padding: 30px 20px;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    .teacher-card {
        width: 100%;
        max-width: 100%; 
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        background: #fff;
    }
    
    .card-header-custom {
        background-color: #1e1e4b; 
        color: white;
        padding: 20px 25px;
        border-bottom: 4px solid #ffbc06; 
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .custom-table {
        width: 100% !important;
        margin-bottom: 0;
        table-layout: fixed; 
        border-collapse: collapse;
    }

    .custom-table thead th {
        background-color: #f1f5f9;
        color: #1e1e4b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        padding: 15px 20px;
        border: none;
        text-align: left;
    }

    .custom-table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        font-size: 15px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        text-align: left;
    }

    /* આ સેક્શન સુધાર્યો છે જેથી નામ બાજુમાં આવે */
    .teacher-info-flex {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .col-no { width: 8%; text-align: center !important; }
    .col-info { width: 32%; }
    .col-email { width: 25%; }
    .col-role { width: 15%; }
    .col-action { width: 20%; text-align: center !important; }

    .avatar-circle-teacher {
        width: 40px;
        height: 40px;
        background: #fef3c7;
        color: #92400e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }

    .badge-teacher {
        background-color: #f0fdf4;
        color: #15803d;
        border: 1px solid #dcfce7;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
    }

    .btn-view-teacher {
        background-color: #1e1e4b;
        color: white !important;
        border-radius: 8px;
        padding: 8px 18px;
        font-weight: 600;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-view-teacher:hover {
        background-color: #ffbc06;
        color: #1e1e4b !important;
        transform: translateY(-2px);
    }
</style>

<div class="page-wrapper">
    <div class="card teacher-card">
        <div class="card-header-custom">
            <h5 class="fw-bold mb-0">
                <i class="fa fa-chalkboard-teacher me-2"></i> Teacher Management
            </h5>
            <div class="header-right">
                <span class="fw-bold">Total Teachers: {{ $teachers->count() }}</span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th class="col-no">No.</th>
                            <th class="col-info">Teacher Details</th>
                            <th class="col-email">Email Address</th>
                            <th class="col-role">Role</th>
                            <th class="col-action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                        <tr>
                            <td class="col-no text-muted fw-bold">{{ $loop->iteration }}</td>
                            <td class="col-info">
                                <div class="teacher-info-flex">
                                    <div class="avatar-circle-teacher">
                                        {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                    </div>
                                    <div class="fw-bold text-dark">
                                        {{ $teacher->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="col-email text-muted">
                                <i class="fa fa-envelope-o me-2"></i>{{ $teacher->email }}
                            </td>
                            <td class="col-role">
                                <span class="badge-teacher">
                                    <i class="fa fa-briefcase me-1"></i> {{ ucfirst($teacher->user_type) }}
                                </span>
                            </td>
                            <td class="col-action">
                                <a href="{{ url('admin/teacher/teacherDetails', $teacher->id) }}" class="btn-view-teacher">
                                    View Details <i class="fa fa-chevron-right ms-1 small"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fa fa-user-circle-o fa-3x mb-3 opacity-20"></i>
                                    <p>No teachers registered yet.</p>
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

@endsection