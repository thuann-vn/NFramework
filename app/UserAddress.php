<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'province','address','user_id','city'
    ];

}
