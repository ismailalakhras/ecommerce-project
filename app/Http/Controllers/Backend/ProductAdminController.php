<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['category', 'subcategory'])->latest();

            return DataTables::of($products)
                ->addColumn('actions', 'backend.pages.product.partials.actions')
                ->addColumn('category_name', function ($product) {
                    return $product->category ? $product->category->name : '';
                })
                ->addColumn('subcategory_name', function ($product) {
                    return $product->subcategory ? $product->subcategory->name : '';
                })
                ->editColumn('image', 'backend.pages.product.partials.image')
                ->rawColumns(['actions', 'image'])
                ->make(true);
        }
        $categories = Category::all();
        $subcategories = subcategory::all();

        return view('backend.pages.product.index', compact('categories', 'subcategories'));
    }


    public function store(StoreProductRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Product::create($validatedData);

            return response()->json([
                'success' => 'Created!',
                'message' => 'product created successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the product: ' . $e->getMessage(),

            ], 500);
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $validatedData = $request->validated();
            $product->update($validatedData);

            return response()->json([
                'success' => 'Updated!',
                'message' => 'product updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating the product',
            ], 500);
        }
    }


    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'success' => 'Deleted!',
                'message' => 'Product has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating the product',
            ], 500);
        }
    }
}
