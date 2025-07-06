<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('backend.pages.product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::with(['subcategories'])->get();
        $subcategories = Subcategory::latest()->get();

        return view('backend.pages.product.create', compact('categories', 'subcategories'));
    }


    public function store(StoreProductRequest $request)
    {
        try {
            $validatedData = $request->validated();
            product::create($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while creating the product');
        }
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
    }


    public function edit(Product $product)
    {
        $categories = Category::with(['subcategories'])->get();
        $subcategories = Subcategory::latest()->get();

        return view('backend.pages.product.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $validatedData = $request->validated();
            $product->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while updating the product');
        }

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the product');
        }
        return redirect()->route('admin.product.index')->with('success', 'product deleted successfully');
    }
}
