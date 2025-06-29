<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('backend.pages.category.index', compact('categories'));
    }



    public function create()
    {
        return view('backend.pages.category.create');
    }



    public function store(Request $request)
    {
        try {
            toast()->position('top');

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name may not be greater than 255 characters.',
            ]);

            Category::create($validatedData);
            Alert::success('Success', 'Category created successfully');
        } catch (ValidationException $e) {
            // Handle validation errors
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            Alert::error('Error', 'Something went wrong while creating the category')->autoClose(8000);
        }

        return redirect()->route('category.index');
    }






    public function edit(Category $category)
    {
        return view('backend.pages.category.edit', compact('category'));
    }



    public function update(Request $request, Category $category)
    {
        toast()->position('top');

        try {
            // Validate input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name must not exceed 255 characters.',
            ]);

            $category->update($validatedData);

            Alert::success('Success', 'Category updated successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while updating the category')->autoClose(8000);
        }

        return redirect()->route('admin.category.index');
    }



    public function destroy(Category $category)
    {
        toast()->position('top');

        try {
            $category->delete();
            toast()->position('top');

            Alert::success('Deleted', 'Category deleted successfully')->autoClose(8000);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the category')->autoClose(8000);
        }

        return redirect()->route('admin.category.index');
    }
}
