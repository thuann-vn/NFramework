<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductAttribute extends Model
{
    public function attribute(){
        return $this->belongsTo('App\Models\Attribute', 'attribute_id', 'id');
    }

    public function details(){
        return $this->hasMany('App\Models\ProductAttributeDetail','product_attribute_id', 'id');
    }
}
