<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ProductsResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslatedAttribute('name'),
            'details' => $this->getTranslatedAttribute('details'),
            'slug' => $this->getTranslatedAttribute('slug'),
            'price' => $this->price,
            'regular_price' => $this->regular_price,
            'image' => $this->image,
            'images' => $this->images,
            'brand' => new BrandResource($this->brand),
            'categories' => CategoriesResource::collection($this->categories),
            'variant_count' => $this->variants->count()
        ];
    }
}
