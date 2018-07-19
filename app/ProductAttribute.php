<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductAttribute extends Model
{
    public function attribute(){
        return $this->belongsTo('App\Attribute', 'attribute_id', 'id');
    }

    public function details(){
        return $this->hasMany('App\ProductAttributeDetail','product_attribute_id', 'id');
    }
}
