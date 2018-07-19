<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Department extends Model
{
    use Translatable;
    protected $translatable = ['name', 'description', 'content', 'slug', 'meta_description', 'meta_keywords'];
}
