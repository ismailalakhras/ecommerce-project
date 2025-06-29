<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


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
                'slug' => 'nullable|string|max:255|unique:categories,slug',
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'sort_order' => 'nullable|integer',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name must not exceed 255 characters.',

                'slug.unique' => 'The slug must be unique.',
            ]);



            if (empty($validatedData['slug'])) {
                $validatedData['slug'] = Str::slug($validatedData['name']) . '-' . uniqid();
            }


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
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.category.index');
    }


    public function edit(Category $category)
    {
        return view('backend.pages.category.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        toast()->position('top');

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name must not exceed 255 characters.',

                'slug.unique' => 'The slug must be unique.',
            ]);

            $category->update($validatedData);

            Alert::success('Success', 'Category updated successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while updating the category')->autoClose(8000);
            return redirect()->back()->withInput();
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
