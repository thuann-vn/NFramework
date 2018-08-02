<?php

namespace App\Http\Controllers;

use TCG\Voyager\Models\Page;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function show($slug){
        $page = Page::where('slug', $slug)->first();
        return view('page.show')->with(['page' => $page]);
    }
}
