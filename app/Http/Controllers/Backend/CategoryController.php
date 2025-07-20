<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Http\Resources\Backend\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $datatable)
    {
        $categories = Category::latest()->get();

        return $datatable->render('backend.pages.category.index', compact('categories'));
    }

    public function create()
    {
        try {
            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Failed!',
                'message' => 'An error occurred .',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            Category::create($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Created!',
                'message' => 'category created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Created Failed!',
                'message' => 'Something went wrong while creating the category: ',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function edit(Category $category)
    {
        try {
            return response()->json([
                'category' => new CategoryResource($category),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Fetch Category Failed!',
                'message' => 'An error occurred while fetching the category data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $category->update($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Updated!',
                'message' => 'category updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Update Failed',
                'message' => 'Something went wrong while updating the category',
                'error' => $e->getMessage()

            ], 500);
        }
    }




    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'success' => true,
                'title' => 'Deleted!',
                'message' => 'Category has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Failed',
                'message' => 'Something went wrong while deleting the category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
    