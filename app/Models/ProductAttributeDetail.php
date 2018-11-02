<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductAttributeDetail extends Model
{
    public function attributeValue(){
        return $this->belongsTo('App\Models\AttributeValue', 'attribute_value_id', 'id');
    }
}
