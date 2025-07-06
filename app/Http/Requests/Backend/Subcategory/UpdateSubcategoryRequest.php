<?php

namespace App\Http\Requests\Backend\Subcategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'nullable|string|max:255|unique:subcategories,slug,' . $this->route('subcategory')->id,
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return  [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'slug.unique' => 'The slug must be unique.',
        ];
    }
}
