<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;


class Slider extends Model
{
    use Cachable;
    public function slides(){
        return $this->hasMany('App\Models\SliderImage', 'slider_id', 'id');
    }
}
