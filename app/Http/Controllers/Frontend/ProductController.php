<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsByCategoryId($id)
    {
        try {
            $products = Product::where('category_id', $id)
                ->orderBy('price', 'asc')
                ->paginate(5);

            $productsCount = Product::where('category_id', $id)->count();
            $categories = Category::with('subcategories')->orderBy('created_at', 'DESC')->get();
            $shoppingCart = ShoppingCart::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();

            if (request()->ajax()) {

                /** @var \Illuminate\View\View $view */
                $view = view('frontend.pages.productsByCategory', compact('categories', 'shoppingCart', 'products', 'productsCount'));

                /** @var array<string, string> $sections */
                $sections = $view->renderSections();

                return response()->json([
                    'success' => true,
                    'page' => $sections['content'],
                ]);
            }

            return view('frontend.pages.productsByCategory', compact('categories', 'shoppingCart', 'products', 'productsCount'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Failed!',
                'message' => 'Something went wrong when fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }




    public function productsBySubcategoryId($id)
    {
        try {
            $products = Product::where('subcategory_id', $id)
                ->orderBy('price', 'asc')
                ->paginate(5);
            $productsCount = Product::where('subcategory_id', $id)->count();
            $categories = Category::with('subcategories')->get();
            $shoppingCart = ShoppingCart::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();

            if (request()->ajax()) {

                /** @var \Illuminate\View\View $view */
                $view = view('frontend.pages.productsBySubcategory', compact('categories', 'shoppingCart', 'products', 'productsCount'));

                /** @var array<string, string> $sections */
                $sections = $view->renderSections();

                return response()->json([
                    'success' => true,
                    'page' => $sections['content'],
                ]);
            }

            return view('frontend.pages.productsBySubcategory', compact('categories', 'shoppingCart', 'products', 'productsCount'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Failed!',
                'message' => 'Something went wrong when fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }
}
