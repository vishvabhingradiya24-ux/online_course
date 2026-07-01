@extends('admin.dashboard')

@section('content')

<style>
    /* આખા પેજ માટે વ્યવસ્થિત સ્ક્રોલિંગ */
    body, html {
        height: auto;
        overflow-y: auto;
    }
    
    .page-wrapper {
        padding: 30px 20px;
        background-color: #f8fafc;
        min-height: 100vh;
        width: 100%;
        overflow-x: hidden;
    }

    .main-card {
        width: 100%;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 25px rgba(0,0,0,0.07);
        background: #fff;
        margin-bottom: 30px;
    }

    .card-header-custom {
        background-color: #1e1e4b; 
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 4px solid #ffbc06;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
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
        font-size: 12px;
        letter-spacing: 0.5px;
        padding: 15px 25px;
        border: none;
        text-align: left;
    }

    .custom-table tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        color: #4a5568;
        border-bottom: 1px solid #f1f5f9;
        text-align: left;
        word-wrap: break-word;
    }

    .col-id { width: 10%; text-align: center !important; }
    .col-name { width: 25%; }
    .col-sub { width: 45%; }
    .col-action { width: 20%; text-align: center !important; }

    .sub-badge {
        background: #eef2ff;
        color: #4338ca;
        border: 1px solid #e0e7ff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        margin: 3px;
        transition: 0.3s;
    }
    
    .sub-badge:hover {
        background: #4338ca;
        color: #fff;
    }

    .btn-action {
        border-radius: 8px;
        padding: 8px 15px;
        font-weight: 600;
        transition: 0.3s;
        border: none !important;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        white-space: nowrap;
    }
    
    .btn-edit { background: #e0e7ff; color: #4338ca; }
    .btn-edit:hover { background: #4338ca; color: white; }
    
    .btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-delete:hover { background: #b91c1c; color: white; }

    .bg-edu-yellow { background-color: #ffbc06 !important; color: #1e1e4b !important; }
    
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>

<div class="page-wrapper">
    <div class="card main-card">
        <div class="card-header-custom">
            <h4 class="mb-0 fw-bold text-white">
                <i class="fa fa-list-alt me-2 text-warning"></i> Category Management
            </h4>
            <a href="{{ url('admin/category/create') }}" class="btn bg-edu-yellow fw-bold px-4 rounded-pill shadow-sm">
                <i class="fa fa-plus-circle me-1"></i> Add Category
            </a>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div id="successAlert" class="alert alert-success border-0 shadow-sm m-3 rounded-3" role="alert">
                    <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th class="col-id">No.</th>
                            <th class="col-name">Category Name</th>
                            <th class="col-sub">Sub Categories</th>
                            <th class="col-action">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($categories as $category)
                        <tr>
                            <td class="col-id text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                            
                            <td class="col-name">
                                <div class="fw-bold text-dark" style="font-size: 16px;">{{ $category->name }}</div>
                            </td>

                            <td class="col-sub">
                                @if($category->subCategories && $category->subCategories->count())
                                    <div class="d-flex flex-wrap">
                                        @foreach($category->subCategories as $sub)
                                            <span class="sub-badge">
                                                <i class="fa fa-tag me-1 small opacity-50"></i> {{ $sub->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted small italic">No sub-categories found</span>
                                @endif
                            </td>

                            <td class="col-action">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ url('admin/category/edit', $category->id) }}" class="btn-action btn-edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ url('admin/category/delete', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fa fa-folder-open-o fa-4x mb-3 opacity-20"></i>
                                    <p class="fs-5">No categories found.</p>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function () {
            let alert = document.getElementById('successAlert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    });
</script>

@endsection