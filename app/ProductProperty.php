<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;


class ProductProperty extends Model
{
    use Cachable;
    protected $table = 'product_properties';

    public function property(){
        return $this->belongsTo('App\Property','property_id','id');
    }
}
