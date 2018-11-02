<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AttributeValue extends Model
{
    public $timestamps = false;

    public function attribute(){
        return $this->belongsTo('App\Models\Attribute', 'attribute_id', 'id');
    }
}
