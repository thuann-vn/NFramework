<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Slider extends Model
{
    public function slides(){
        return $this->hasMany('App\SliderImage', 'slider_id', 'id');
    }
}
