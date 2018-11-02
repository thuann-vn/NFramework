<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Department extends Model
{
    use Translatable;
    protected $translatable = ['name', 'content', 'slug', 'meta_description', 'meta_keywords'];
}
