<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Brand extends Model
{
    use Translatable,
        Cachable;

    protected $translatable = ['name', 'slug'];

    public  function products(){
        return $this->hasMany('App\Product', 'brand_id', 'id');
    }
}
