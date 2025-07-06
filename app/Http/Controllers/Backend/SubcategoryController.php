<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Subcategory\StoreSubcategoryRequest;
use App\Http\Requests\Backend\Subcategory\UpdateSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::latest()->get();
        return view('backend.pages.subcategory.index', compact('subcategories'));
    }


    public function create()
    {
        $categories = Category::latest()->get();
        return view('backend.pages.subcategory.create', compact('categories'));
    }

    public function store(StoreSubcategoryRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Subcategory::create($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while creating the subcategory');
        }
        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory created successfully');
    }



    public function edit(Subcategory $subcategory)
    {
        $categories = Category::latest()->get();
        return view('backend.pages.subcategory.edit', compact('subcategory', 'categories'));
    }



    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        try {
            $validatedData = $request->validated();
            $subcategory->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while updating the subcategory');
        }
        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory updated successfully');
    }



    public function destroy(Subcategory $subcategory)
    {
        try {
            $subcategory->delete();
        } catch (\Exception $e) {
            return redirect()->with('error', 'Something went wrong while deleting the subcategory');
        }
        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory deleted successfully');
    }
}
