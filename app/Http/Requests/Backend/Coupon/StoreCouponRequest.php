<?php

namespace App\Http\Requests\Backend\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'used_count' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The coupon code is required.',
            'code.string' => 'The coupon code must be a string.',
            'code.max' => 'The coupon code must not exceed 50 characters.',
            'code.unique' => 'This coupon code is already in use.',

            'type.required' => 'The discount type is required.',
            'type.in' => 'The discount type must be either fixed or percentage.',

            'value.required' => 'The discount value is required.',
            'value.numeric' => 'The discount value must be a number.',
            'value.min' => 'The discount value must be at least 0.',

            'minimum_amount.numeric' => 'The minimum amount must be a number.',
            'minimum_amount.min' => 'The minimum amount must be at least 0.',

            'usage_limit.integer' => 'The usage limit must be an integer.',
            'usage_limit.min' => 'The usage limit must be at least 1.',

            'used_count.integer' => 'The used count must be an integer.',
            'used_count.min' => 'The used count must be at least 0.',

            'is_active.required' => 'The active status is required.',
            'is_active.boolean' => 'The active status must be true or false.',

            'starts_at.date' => 'The start date must be a valid date.',
            'expires_at.date' => 'The expiry date must be a valid date.',
            'expires_at.after_or_equal' => 'The expiry date must be after or equal to the start date.',
        ];
    }
}
