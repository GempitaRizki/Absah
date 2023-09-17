<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
        /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

        {
            $attributes = [ 
                'sku' => $this->sku,
                'type' => $this->type,
                'name' => $this->name,
                'slug' => $this->slug,
                'price' => $this->priceLabel(),
                'featured_image' => $this->getFeaturedImage(),
                'short_description' => $this->short_description,
                'description' => $this->description,                
            ];
            return $attributes;

        }
    }

    private function getFeaturedImage()
    {
        return ($this->productImages->first()) ? asset('storage/'.$this->productImages->first()->medium) : null;
    }

}
