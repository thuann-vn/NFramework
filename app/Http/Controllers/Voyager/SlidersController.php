<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class SlidersController extends VoyagerBaseController
{
    use BreadRelationshipParser;
}
