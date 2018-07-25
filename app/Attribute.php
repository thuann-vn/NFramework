<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Attribute extends Model
{
    public function values(){
        return $this->hasMany(AttributeValue::class,'attribute_id', 'id');
    }
}
