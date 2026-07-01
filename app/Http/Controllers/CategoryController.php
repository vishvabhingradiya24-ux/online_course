<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categories = Category::with('subCategories')->get();
        return view('admin.category', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.categoryCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_category.*' => 'nullable|string',
        ]);

        $category = new Category();
        $category->name = $request->title;

        $category->save();

        SubCategory::where('category_id', $category->id)->delete();

        if ($request->sub_category) 
        {
            foreach ($request->sub_category as $sub) 
            {
                if ($sub != null) 
                {
                    SubCategory::create([
                        'category_id' => $category->id,
                        'name' => $sub
                    ]);
                }
            }
        }
        return redirect('admin/category')->with('success', 'Category with multiple videos uploaded!');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.editCategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'sub_category.*' => 'nullable|string',
        ]);

        $category->name = $request->title;

        $category->save();

        SubCategory::where('category_id', $category->id)->delete();

        if ($request->sub_category) 
        {
            foreach ($request->sub_category as $sub) 
            {
                if ($sub != null) 
                {
                    SubCategory::create([
                        'category_id' => $category->id,
                        'name' => $sub
                    ]);
                }
            }
        }

        return redirect('admin/category')->with('success', 'Category updated successfully!');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        $category->delete();

        return redirect('admin/category')->with('success', 'Category and videos deleted successfully!');
    }
}
