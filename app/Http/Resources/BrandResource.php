<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'logo' => $this->logo,
            'name' => $this->getTranslatedAttribute('name'),
            'slug' => $this->getTranslatedAttribute('slug'),
            'link' => route('shop.brand', $this->slug),
            'featured' => $this->featured,
        ];
    }
}
