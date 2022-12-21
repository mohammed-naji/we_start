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
            'final_price' => $this->final_price,
            'quantity' => $this->quantity,
            'featured' => $this->featured,
            'category_id' => $this->category_id,
            'category' => [
                'name' => $this->category->trans_name,
                'slug' => $this->category->slug,
            ],
            // 'image' => new GalleryResource($this->image),
            'image' => url($this->image->path),
            'gallery' => GalleryResource::collection($this->gallery),
            'variations' => [
                // 'colors' => $this->variations()->where('type', 'colors')->get()->pluck('value'),
                'colors' => $this->variations()->where('type', 'colors')->select('id', 'value', 'extraprice')->get(),
                'sizes' => $this->variations()->where('type', 'sizes')->select('id', 'value', 'extraprice')->get(),
            ],
            'coupons' => $this->coupons,
            'reviews' => [
                'count' => $this->reviews->count(),
                'rate' => round($this->reviews->avg('star'), 2)
            ]
        ];
    }
}
