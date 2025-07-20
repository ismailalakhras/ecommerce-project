<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'category_id'      => $this->category_id,
            'subcategory_id'   => $this->subcategory_id,
            'slug'             => $this->slug,
            'description'      => $this->description,
            'short_description' => $this->short_description,
            'sku'              => $this->sku,
            'price'            => $this->price,
            'sale_price'       => $this->sale_price,
            'cost_price'       => $this->cost_price,
            'stock_quantity'   => $this->stock_quantity,
            'min_quantity'     => $this->min_quantity,
            'weight'           => $this->weight,
            'dimensions'       => $this->dimensions,
            'is_active'        => $this->is_active,
            'is_featured'      => $this->is_featured,
            'manage_stock'     => $this->manage_stock,
            'stock_status'     => $this->stock_status,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'rating_average'   => $this->rating_average,
            'rating_count'     => $this->rating_count,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
