<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::all();
        return view('backend.pages.subcategory.index', compact('subcategories'));
    }



    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.subcategory.create', compact('categories'));
    }



    public function store(Request $request)
    {
        try {
            toast()->position('top');

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'slug' => 'nullable|string|max:255|unique:subcategories,slug',
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'sort_order' => 'nullable|integer',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name may not be greater than 255 characters.',

                'category_id.required' => 'The category is required.',
                'category_id.exists' => 'The selected category is invalid.',

                'slug.unique' => 'The slug must be unique.',
            ]);


            Subcategory::create($validatedData);
            Alert::success('Success', 'Subcategory created successfully');
        } catch (ValidationException $e) {
            // Handle validation errors
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            Alert::error('Error', 'Something went wrong while creating the subcategory')->autoClose(8000);
        }

        return redirect()->route('admin.subcategory.index');
    }






    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('backend.pages.subcategory.edit', compact('subcategory', 'categories'));
    }



    public function update(Request $request, Subcategory $subcategory)
    {
        toast()->position('top');

        try {
            // Validate input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'slug' => 'nullable|string|max:255|unique:subcategories,slug,' . $subcategory->id,
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'sort_order' => 'nullable|integer',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name may not be greater than 255 characters.',

                'category_id.required' => 'The category is required.',
                'category_id.exists' => 'The selected category is invalid.',

                'slug.unique' => 'The slug must be unique.',
            ]);

            $subcategory->update($validatedData);

            Alert::success('Success', 'Subcategory updated successfully');
        } catch (ValidationException $e) {

            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {

            Alert::error('Error', 'Something went wrong while updating the subcategory')->autoClose(8000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.subcategory.index');
    }



    public function destroy(Subcategory $subcategory)
    {
        toast()->position('top');

        try {
            $subcategory->delete();
            toast()->position('top');

            Alert::success('Deleted', 'Subcategory deleted successfully')->autoClose(8000);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the subcategory')->autoClose(8000);
        }

        return redirect()->route('admin.subcategory.index');
    }
}
