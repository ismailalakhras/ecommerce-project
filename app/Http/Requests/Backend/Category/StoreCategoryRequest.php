<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class StoreCategoryRequest extends FormRequest
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
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return  [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'slug.unique' => 'The slug must be unique.',
        ];
    }


    protected function prepareForValidation()
    {
        if (!$this->filled('slug') && $this->filled('name')) {
            $this->merge([
                'slug' => Str::slug($this->name) . '-' . uniqid(),
            ]);
        }
    }
}
