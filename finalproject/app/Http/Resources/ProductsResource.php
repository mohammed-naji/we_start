<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->trans_name,
            'slug' => $this->slug,
            'short' => $this->trans_small,
            'desc' => $this->trans_desc,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'featured' => $this->featured,
            'category' => [
                'name' => $this->category->trans_name,
                'slug' => $this->category->slug,
            ],
            // 'image' => new GalleryResource($this->image),
            'image' => url($this->image->path),
            'gallery' => GalleryResource::collection($this->gallery),
            'variations' => $this->variations,
            'coupons' => $this->coupons
        ];
    }
}
