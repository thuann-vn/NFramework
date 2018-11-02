<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Category extends Model
{
    use Translatable,
        Cachable;

    protected $translatable = ['name', 'slug'];

    protected $table = 'category';

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id','id');
    }
}
