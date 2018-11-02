<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ProductResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        Log::info('PARSING PRODUCT DATA', [$this->name]);
        $translations = [];
        foreach ($this->getTranslatableAttributes() as $field){
            $translations[$field] = $this->getTranslationsOf($field);
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'details' => $this->details,
            'description' => $this->description,
            'slug' => $this->slug,
            'price' => $this->price,
            'stock' => $this->stock,
            'regular_price' => $this->regular_price,
            'image' => $this->image,
            'images' => !empty($this->images)?json_decode($this->images):[],
            'brand_id' => $this->brand_id,
            'categories' => $this->categories->pluck('id'),
            'variants' => $this->variants,
            'properties' => $this->properties,
            'link' => route('shop.show', $this->slug),
            'status' => $this->status,
            'translation'=> $translations
        ];
    }
}

class ProductCollectionResource extends Resource
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
            'stock' => $this->stock,
            'regular_price' => $this->regular_price,
            'image' => $this->image,
            'images' => $this->images,
            'brand' => new ProductBrandResource($this->brand),
            'variant_count' => $this->variants->count(),
            'link' => route('shop.show', $this->slug)
        ];
    }
}
