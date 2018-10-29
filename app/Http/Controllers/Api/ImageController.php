<?php

namespace App\Http\Controllers\Api;

use App\File;
use App\Http\Resources\Api\ImageResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        return ImageResource::collection(File::with([])->paginate(12));
    }
}
