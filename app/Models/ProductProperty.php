<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;


class ProductProperty extends Model
{
    use Cachable;
    protected $table = 'product_properties';

    public function property(){
        return $this->belongsTo('App\Models\Property','property_id','id');
    }
}
