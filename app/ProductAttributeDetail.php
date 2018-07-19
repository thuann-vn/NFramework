<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductAttributeDetail extends Model
{
    public function attributeValue(){
        return $this->belongsTo('App\AttributeValue', 'attribute_value_id', 'id');
    }
}
