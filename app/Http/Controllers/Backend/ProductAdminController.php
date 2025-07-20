<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Http\Resources\Backend\ProductResource;
use App\Http\Resources\Backend\SubcategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductAdminController extends Controller
{

    public function index(ProductDataTable $datatable)
    {
        $categories = Category::all();

        return $datatable->render('backend.pages.product.index', compact('categories'));
    }



    public function create()
    {
        try {
            $subcategories = Subcategory::all();
            return response()->json([
                'subcategories' => SubcategoryResource::collection($subcategories),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Fetch Product Failed!',
                'message' => 'An error occurred while fetching the product data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            Product::create($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Created!',
                'message' => 'product created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Created Failed!',
                'message' => 'Something went wrong while creating the product: ',
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function edit(Product $product)
    {
        try {
            $subcategories = Subcategory::all();
            return response()->json([
                'product' => new ProductResource($product),
                'subcategories' => SubcategoryResource::collection($subcategories),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Fetch Product Failed!',
                'message' => 'An error occurred while fetching the product data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $product->update($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Updated!',
                'message' => 'product updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Update Failed',
                'message' => 'Something went wrong while updating the product',
                'error' => $e->getMessage()

            ], 500);
        }
    }


    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'success' => true,
                'title' => 'Deleted!',
                'message' => 'Product has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Failed',
                'message' => 'Something went wrong while deleting the product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
