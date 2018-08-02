<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Brand extends Model
{
    use Translatable;

    protected $translatable = ['name', 'slug'];

    public  function products(){
        return $this->hasMany('App\Product', 'brand_id', 'id');
    }
}
