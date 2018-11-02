<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Brand extends Model
{
    use Translatable,
        Cachable;

    protected $translatable = ['name', 'slug'];

    public  function products(){
        return $this->hasMany('App\Models\Product', 'brand_id', 'id');
    }
}
