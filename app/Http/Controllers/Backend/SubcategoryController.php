<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Subcategory\StoreSubcategoryRequest;
use App\Http\Requests\Backend\Subcategory\UpdateSubcategoryRequest;
use App\Http\Resources\Backend\CategoryResource;
use App\Http\Resources\Backend\SubcategoryResource;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index(SubcategoryDataTable $datatable)
    {
        $subcategories = Subcategory::latest()->get();
        return $datatable->render('backend.pages.subcategory.index', compact('subcategories'));
    }


    public function create()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'categories' => CategoryResource::collection($categories),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Fetch subcategory Failed!',
                'message' => 'An error occurred while fetching the subcategory data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreSubcategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            Subcategory::create($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Created!',
                'message' => 'subcategory created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Created Failed!',
                'message' => 'Something went wrong while creating the subcategory: ',
                'error' => $e->getMessage()

            ], 500);
        }
    }



    public function edit(Subcategory $subcategory)
    {
        try {
            $categories = Category::latest()->get();
            return response()->json([
                'subcategory' => new SubcategoryResource($subcategory),
                'categories' => CategoryResource::collection($categories),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Fetch subcategory Failed!',
                'message' => 'An error occurred while fetching the subcategory data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $subcategory->update($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Updated!',
                'message' => 'subcategory updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Update Failed',
                'message' => 'Something went wrong while updating the subcategory',
                'error' => $e->getMessage()

            ], 500);
        }
    }



    public function destroy(Subcategory $subcategory)
    {
        try {
            $subcategory->delete();
            return response()->json([
                'success' => true,
                'title' => 'Deleted!',
                'message' => 'subcategory has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Failed',
                'message' => 'Something went wrong while deleting the subcategory',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
