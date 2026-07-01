@extends('admin.dashboard')

@section('content')

<style>
    .page-wrapper {
        padding: 30px;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    .student-card {
        width: 100%;
        margin: 0 auto;
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        background: #fff;
        overflow: hidden;
    }
    
    .card-header-custom {
        background-color: #1e1e4b;
        color: white;
        padding: 18px 25px;
        border-bottom: 4px solid #ffbc06;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed; 
    }

    .custom-table thead th {
        background-color: #f1f5f9;
        color: #1e1e4b;
        text-align: left; 
        padding: 15px 20px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
    }

    .custom-table tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    /* આ સેક્શન સુધાર્યો છે જેથી નામ બાજુમાં આવે */
    .student-info-flex {
        display: flex;
        align-items: center;
        gap: 15px; /* સિમ્બોલ અને નામ વચ્ચે જગ્યા માટે */
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        background: #ffbc06;
        color: #1e1e4b;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }

    .col-no { width: 8%; text-align: center !important; }
    .col-info { width: 32%; }
    .col-email { width: 25%; }
    .col-role { width: 15%; }
    .col-action { width: 20%; text-align: center !important; }

    .badge-student {
        background-color: #e0f2fe;
        color: #0369a1;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 13px;
        display: inline-block;
    }

    .btn-view {
        background-color: #1e1e4b;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-view:hover {
        background-color: #ffbc06;
        color: #1e1e4b;
    }
</style>

<div class="page-wrapper">
    <div class="card student-card">
        <div class="card-header-custom">
            <div class="header-left">
                <i class="fa fa-users"></i>
                <h5 class="mb-0 fw-bold">Student Management</h5>
            </div>
            <div class="header-right">
                <span class="fw-bold">Total Students: {{ $students->count() }}</span>
            </div>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="col-no">ID</th>
                        <th class="col-info">Student Information</th>
                        <th class="col-email">Contact Email</th>
                        <th class="col-role">Account Role</th>
                        <th class="col-action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td class="col-no text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td class="col-info">
                            <div class="student-info-flex">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <div class="fw-bold text-dark">
                                    {{ $student->name }}
                                </div>
                            </div>
                        </td>
                        <td class="col-email text-muted">
                            {{ $student->email }}
                        </td>
                        <td class="col-role">
                            <span class="badge-student">{{ ucfirst($student->user_type) }}</span>
                        </td>
                        <td class="col-action">
                            <a href="{{ url('admin/student/studentDetails', $student->id) }}" class="btn-view">
                                View Profile <i class="fa fa-arrow-right ms-1" style="font-size: 10px;"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No students found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection