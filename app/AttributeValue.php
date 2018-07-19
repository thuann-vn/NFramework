<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AttributeValue extends Model
{
    public $timestamps = false;

    public function attribute(){
        return $this->belongsTo('App\Attribute', 'attribute_id', 'id');
    }
}
