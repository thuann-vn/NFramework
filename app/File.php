<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    use Cachable;

    protected $fillable = [
        'name', 'file_name', 'extension', 'mime_type'
    ];
}
