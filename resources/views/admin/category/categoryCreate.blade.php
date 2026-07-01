@extends('admin.dashboard')

@section('content')

<style>
    /* Unique Styling for Add Category Page */
    .cat-container { max-width: 800px; margin: 30px auto; }
    
    .cat-card { 
        border: none; 
        border-radius: 20px; 
        overflow: hidden; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
    }

    .cat-header { 
        background: #1e1e4b; /* Navy Blue */
        color: white; 
        padding: 25px; 
        border-bottom: 4px solid #ffbc06; /* Yellow accent */
    }
    
    .form-label { 
        font-weight: 700; 
        color: #1e1e4b; 
        text-transform: uppercase; 
        font-size: 13px; 
        letter-spacing: 0.5px; 
    }

    .form-control { 
        border-radius: 12px; 
        padding: 12px 15px; 
        border: 1px solid #e2e8f0; 
        background: #f8fafc; 
        transition: 0.3s; 
    }

    .form-control:focus { 
        background: white; 
        border-color: #ffbc06; 
        box-shadow: 0 0 0 4px rgba(255, 188, 6, 0.1); 
    }
    
    /* Sub Category Wrapper Styling */
    .sub-cat-section {
        background: #f1f5f9;
        padding: 20px;
        border-radius: 15px;
        border: 1px dashed #cbd5e1;
    }

    .input-group-custom { 
        display: flex; 
        gap: 10px; 
        margin-bottom: 12px; 
        animation: fadeIn 0.4s ease; 
    }
    
    .add-more-btn { 
        background: #e0e7ff; 
        color: #4338ca; 
        border: none; 
        padding: 8px 18px; 
        border-radius: 10px; 
        font-weight: 600; 
        font-size: 13px; 
        transition: 0.3s;
    }

    .add-more-btn:hover { 
        background: #4338ca; 
        color: white; 
        transform: translateY(-2px);
    }
    
    .remove-btn-custom { 
        background: #fee2e2; 
        color: #ef4444; 
        border: none; 
        border-radius: 10px; 
        width: 45px; 
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s; 
    }

    .remove-btn-custom:hover { 
        background: #ef4444; 
        color: white; 
    }

    .submit-btn { 
        background: #ffbc06; 
        color: #1e1e4b; 
        border: none; 
        padding: 12px 35px; 
        border-radius: 12px; 
        font-weight: 800; 
        letter-spacing: 1px; 
        transition: 0.3s; 
    }

    .submit-btn:hover { 
        background: #e5a905; 
        transform: translateY(-2px); 
        box-shadow: 0 5px 15px rgba(255, 188, 6, 0.3); 
    }

    /* Animation for new fields */
    @keyframes fadeIn { 
        from { opacity: 0; transform: translateY(10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }
</style>

<div class="container-fluid">
    <div class="cat-container">
        
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card cat-card shadow-lg">
            <div class="cat-header">
                <h4 class="mb-0 fw-bold">
                    <i class="fa fa-tags me-2 text-warning"></i> Add New Category
                </h4>
                <p class="mb-0 small opacity-75">Create main categories and their sub-items for your platform.</p>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ url('admin/category/store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="title" class="form-control" 
                               placeholder="e.g. Programming Language" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0">Sub Categories</label>
                            <button type="button" class="add-more-btn" onclick="addSubCategory()">
                                <i class="fa fa-plus-circle me-1"></i> Add More
                            </button>
                        </div>
                        
                        <div class="sub-cat-section" id="subCategoryWrapper">
                            <div class="input-group-custom">
                                <input type="text" name="sub_category[]" class="form-control" 
                                       placeholder="Enter Sub Category Name (e.g. PHP, Python)" required>
                                <button type="button" class="remove-btn-custom btn-remove d-none">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <small class="text-muted mt-2 d-block">
                            <i class="fa fa-info-circle me-1"></i> You can add multiple sub-categories at once.
                        </small>
                    </div>

                    <div class="mt-5 pt-3 border-top d-flex gap-3">
                        <button type="submit" class="submit-btn shadow-sm">
                            <i class="fa fa-upload me-2"></i> UPLOAD CATEGORY
                        </button>

                        <a href="{{ url('admin/category') }}" class="btn btn-light fw-bold px-4 d-flex align-items-center" style="border-radius: 12px; border: 1px solid #ddd;">
                            CANCEL
                        </a>
                    </div>

                </form>
            </div>
        </div>
        <p class="text-center text-muted small mt-4">Educenter Dashboard &copy; 2026</p>
    </div>
</div>

<script>
function addSubCategory() {
    let wrapper = document.getElementById('subCategoryWrapper');

    let div = document.createElement('div');
    div.className = 'input-group-custom';
    div.innerHTML = `
        <input type="text" name="sub_category[]" class="form-control" placeholder="Enter Sub Category Name" required>
        <button type="button" class="remove-btn-custom btn-remove"><i class="fa fa-trash"></i></button>
    `;

    wrapper.appendChild(div);

    // Remove functionality
    div.querySelector('.btn-remove').addEventListener('click', function() {
        div.remove();
    });
}

// Initial remove button setup (if needed for the first element)
document.querySelectorAll('.btn-remove').forEach(btn => {
    btn.addEventListener('click', function() {
        if(document.querySelectorAll('.input-group-custom').length > 1) {
            this.parentElement.remove();
        }
    });
});
</script>

@endsection

<script>
function addSubCategory() {
    let wrapper = document.getElementById('subCategoryWrapper');

    let html = `
        <div class="input-group mb-2">
            <input type="text" name="sub_category[]" class="form-control" placeholder="Enter Sub Category">
            <button type="button" class="btn btn-danger removeBtn">X</button>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);
}

// Remove button
document.addEventListener('click', function(e){
    if(e.target.classList.contains('removeBtn')){
        e.target.parentElement.remove();
    }
});
</script>
