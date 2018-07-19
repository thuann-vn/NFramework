<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductProperty extends Model
{
    protected $table = 'product_properties';

    public function property(){
        return $this->belongsTo('App\Property','property_id','id');
    }
}
