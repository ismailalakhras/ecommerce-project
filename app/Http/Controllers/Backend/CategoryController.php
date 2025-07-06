<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Models\Category;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();

        return view('backend.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.pages.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Category::create($validatedData);
            return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while creating the category');
        }
    }


    public function edit(Category $category)
    {
        return view('backend.pages.category.edit', compact('category'));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $validatedData = $request->validated();
            $category->update($validatedData);
            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while updating the category');
        }
    }


    public function destroy(Category $category)
    {
        toast()->position('top');

        try {
            $category->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the category');
        }
        return redirect()->route('admin.category.index')->with('success','category deleted successfully');
    }
}
