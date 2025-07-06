<?php

namespace App\Http\Requests\Backend\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'         => 'required|exists:categories,id',
            'subcategory_id'      => 'required|exists:subcategories,id',
            'name'                => 'required|string|max:255',
            'slug'                => 'required|string|max:255|unique:products,slug',
            'description'         => 'nullable|string',
            'short_description'   => 'nullable|string',
            'sku'                 => 'required|string|max:100|unique:products,sku',
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
        ];
    }

    public function messages(): array
    {
        return [
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
        ];
    }
}
