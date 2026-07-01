@extends('admin.dashboard')

@section('content')

<style>
    /* Edit Page Unique Styling */
    .cat-container { max-width: 800px; margin: 30px auto; }
    
    .cat-card { 
        border: none; 
        border-radius: 20px; 
        overflow: hidden; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
    }

    .cat-header { 
        background: #1e1e4b; 
        color: white; 
        padding: 25px; 
        border-bottom: 4px solid #ffbc06; 
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
    
    /* Sub Category Section */
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
    .add-more-btn:hover { background: #4338ca; color: white; transform: translateY(-2px); }
    
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
    .remove-btn-custom:hover { background: #ef4444; color: white; }

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

    @keyframes fadeIn { 
        from { opacity: 0; transform: translateY(10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }
</style>

<div class="container-fluid">
    <div class="cat-container">
        
        <div class="card cat-card shadow-lg">
            <div class="cat-header">
                <h4 class="mb-0 fw-bold">
                    <i class="fa fa-edit me-2 text-warning"></i> Edit Category
                </h4>
                <p class="mb-0 small opacity-75">Update category name and manage its sub-categories.</p>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ url('admin/category/update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Category Title</label>
                        <input type="text" name="title" class="form-control" 
                               value="{{ $category->name }}" required>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0">Sub Categories</label>
                            <button type="button" class="add-more-btn" onclick="addSubCategory()">
                                <i class="fa fa-plus-circle me-1"></i> Add More
                            </button>
                        </div>
                        
                        <div class="sub-cat-section" id="subCategoryWrapper">
                            @if($category->subCategories->count())
                                @foreach($category->subCategories as $sub)
                                    <div class="input-group-custom">
                                        <input type="text" name="sub_category[]" value="{{ $sub->name }}" class="form-control" required>
                                        <button type="button" class="remove-btn-custom removeBtn"><i class="fa fa-trash"></i></button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group-custom">
                                    <input type="text" name="sub_category[]" class="form-control" placeholder="Enter Sub Category">
                                    <button type="button" class="remove-btn-custom removeBtn d-none"><i class="fa fa-trash"></i></button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top d-flex gap-3">
                        <button type="submit" class="submit-btn shadow-sm">
                            <i class="fa fa-save me-2"></i> UPDATE CATEGORY
                        </button>

                        <a href="{{ url('admin/category') }}" class="btn btn-light fw-bold px-4 d-flex align-items-center" style="border-radius: 12px; border: 1px solid #ddd;">
                            CANCEL
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function addSubCategory() {
        let wrapper = document.getElementById('subCategoryWrapper');

        let div = document.createElement('div');
        div.className = 'input-group-custom';
        div.innerHTML = `
            <input type="text" name="sub_category[]" class="form-control" placeholder="Enter Sub Category" required>
            <button type="button" class="remove-btn-custom removeBtn"><i class="fa fa-trash"></i></button>
        `;

        wrapper.appendChild(div);
    }

    // Handle Remove Button click for existing and new elements
    document.addEventListener('click', function(e){
        // Check if the clicked element is the button or the icon inside it
        if(e.target.classList.contains('removeBtn') || e.target.parentElement.classList.contains('removeBtn')){
            const targetBtn = e.target.classList.contains('removeBtn') ? e.target : e.target.parentElement;
            targetBtn.closest('.input-group-custom').remove();
        }
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

    document.addEventListener('click', function(e){
        if(e.target.classList.contains('removeBtn')){
            e.target.parentElement.remove();
        }
    });


</script>
