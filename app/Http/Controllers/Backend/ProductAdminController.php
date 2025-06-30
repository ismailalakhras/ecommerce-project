<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $categories = Category::with(['subcategories'])->get();

        $subcategories = Subcategory::all();


        return view('backend.pages.product.create', compact('categories', 'subcategories'));
    }


    public function store(Request $request)
    {
        try {
            toast()->position('top');


            $validatedData = $request->validate([
                'category_id'         => ['required', 'exists:categories,id'],
                'subcategory_id'      => ['required', 'exists:subcategories,id'],
                'name'                => ['required', 'string', 'max:255'],
                'slug'                => ['required', 'string', 'max:255', 'unique:products,slug'],
                'description'         => ['nullable', 'string'],
                'short_description'   => ['nullable', 'string'],
                'sku'                 => ['required', 'string', 'max:100', 'unique:products,sku'],
                'price'               => ['required', 'numeric', 'min:0'],
                'sale_price'          => ['nullable', 'numeric', 'min:0', 'lte:price'],
                'cost_price'          => ['nullable', 'numeric', 'min:0', 'lte:sale_price'],
                'stock_quantity'      => ['nullable', 'integer', 'min:0'],
                'min_quantity'        => ['nullable', 'integer', 'min:1'],
                'weight'              => ['nullable', 'numeric', 'min:0'],
                'dimensions'          => ['nullable', 'string', 'max:255'],
                'is_active'           => ['nullable', 'boolean'],
                'is_featured'         => ['nullable', 'boolean'],
                'manage_stock'        => ['nullable', 'boolean'],
                'stock_status'        => ['nullable', 'in:in_stock,out_of_stock,on_backorder'],
                'image'               => ['nullable', 'string', 'max:255'],
                'meta_title'          => ['nullable', 'string', 'max:255'],
                'meta_description'    => ['nullable', 'string'],
                'rating_average'      => ['nullable', 'numeric', 'min:0', 'max:5'],
                'rating_count'        => ['nullable', 'integer', 'min:0'],
            ], [
                'category_id.required'      => 'The category is required.',
                'category_id.exists'        => 'The selected category is invalid.',
                'subcategory_id.required'   => 'The subcategory is required.',
                'subcategory_id.exists'     => 'The selected subcategory is invalid.',
                'name.required'             => 'The product name is required.',
                'slug.required'             => 'The slug is required.',
                'slug.unique'               => 'The slug must be unique.',
                'sku.required'              => 'The SKU is required.',
                'sku.unique'                => 'The SKU must be unique.',
                'price.required'            => 'The price is required.',
                'price.numeric'             => 'The price must be a number.',
            ]);


            product::create($validatedData);
            Alert::success('Success', 'Product created successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            // dd($e);
            Alert::error('Error', 'Something went wrong while creating the product')->autoClose(8000);
            return redirect()->back()->withInput();
        }
        return redirect()->route('admin.product.index');
    }


    public function edit(Product $product)
    {
        $categories = Category::with(['subcategories'])->get();
        $subcategories = Subcategory::all();


        return view('backend.pages.product.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        toast()->position('top');

        try {

            $validatedData = $request->validate([
                'category_id'         => 'required|exists:categories,id',
                'subcategory_id'      => 'required|exists:subcategories,id',
                'name'                => 'required|string|max:255',
                'slug'                => 'required|string|max:255|unique:products,slug,' . $product->id,
                'description'         => 'nullable|string',
                'short_description'   => 'nullable|string',
                'sku'                 => 'required|string|max:100|unique:products,sku,' . $product->id,
                'price'               => 'required|numeric|min:0',
                'sale_price'          => 'nullable|numeric|min:0|lte:price',
                'cost_price'          => 'nullable|numeric|min:0|lte:sale_price',
                'stock_quantity'      => 'nullable|integer|min:0',
                'min_quantity'        => 'nullable|integer|min:1',
                'weight'              => 'nullable|numeric|min:0',
                'dimensions'          => 'nullable|string|max:255',
                'is_active'           => 'nullable|boolean',
                'is_featured'         => 'nullable|boolean',
                'manage_stock'        => 'nullable|boolean',
                'stock_status'        => 'nullable|in:in_stock,out_of_stock,on_backorder',
                'image'               => 'nullable|string|max:255',
                'meta_title'          => 'nullable|string|max:255',
                'meta_description'    => 'nullable|string',
                'rating_average'      => 'nullable|numeric|min:0|max:5',
                'rating_count'        => 'nullable|integer|min:0',
            ]);



            $product->update($validatedData);

            Alert::success('Success', 'Product updated successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while updating the product')->autoClose(8000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.product.index');
    }



    public function destroy(Product $product)
    {
        try {
            $product->delete();
            toast()->position('top');
            Alert::success('Deleted', $product->name . ' deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the product')->autoClose(8000);
        }

        return redirect()->route('admin.product.index');
    }
}
