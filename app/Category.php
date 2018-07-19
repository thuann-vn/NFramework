<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Category extends Model
{
    use Translatable;

    protected $table = 'category';

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function department(){
        return $this->belongsTo('App\Department','department_id','id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id','id');
    }
}
