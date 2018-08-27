<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CategoryResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslatedAttribute('name'),
            'slug' => $this->getTranslatedAttribute('slug'),
            'link' => route('shop.category',  ['category'=>!empty($this->parent)?$this->slug:'', 'parent'=>!empty($this->parent)?$this->parent->slug:$this->slug]),
            'featured' => $this->featured,
        ];
    }
}
