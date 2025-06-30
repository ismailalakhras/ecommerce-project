<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('backend.pages.product.index', compact('products'));
    }


    public function create()

    {
        $subcategories = Subcategory::all();

        return view('pages.product.create', compact('subcategories'));
    }


    public function store(Request $request)
    {
        try {
            toast()->position('top');
            

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'subcategory_id' => 'required|exists:subcategories,id',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name may not be greater than 255 characters.',

                'description.string' => 'The description must be a string.',

                'price.required' => 'The price field is required.',
                'price.numeric' => 'The price must be a number.',
                'price.min' => 'The price must be at least 0.',

                'stock.required' => 'The stock field is required.',
                'stock.integer' => 'The stock must be an integer.',
                'stock.min' => 'The stock must be at least 0.',

                'subcategory_id.required' => 'The subcategory field is required.',
                'subcategory_id.exists' => 'The selected subcategory does not exist.',
            ]);

            product::create($validatedData);
            Alert::success('Success', 'Category created successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            Alert::error('Error', 'Something went wrong while creating the product')->autoClose(8000);
        }
        return redirect()->route('admin.product.index');
    }


    public function edit(Product $product)
    {
        $subcategories = Subcategory::all();

        return view('pages.product.edit', compact('product', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        toast()->position('top');

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'subcategory_id' => 'required|exists:subcategories,id'
            ], [
                'name.required' => 'Product name is required.',
                'name.string' => 'Product name must be a string.',
                'name.max' => 'Product name must not exceed 255 characters.',

                'price.required' => 'Price is required.',
                'price.numeric' => 'Price must be a number.',
                'price.min' => 'Price must be at least 0.',

                'stock.required' => 'Stock is required.',
                'stock.numeric' => 'Stock must be a number.',
                'stock.min' => 'Stock must be at least 0.',

                'subcategory_id.required' => 'Subcategory is required.',
                'subcategory_id.exists' => 'Selected subcategory does not exist.',
            ]);


            $product->update($validatedData);

            Alert::success('Success', 'Product updated successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while updating the category')->autoClose(8000);
        }

        return redirect()->route('admin.product.index');
    }



    public function destroy(Product $product)
    {
        try {
            $product->delete();
            toast()->position('top');
            Alert::success('Deleted', 'Category deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the category')->autoClose(8000);
        }

        return redirect()->route('admin.product.index');
    }
}
