<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'categories' => Category::where('featured',1)->get(),
            'brands' => Brand::where('featured',1)->get(),
            'posts' => Post::orderBy('id','desc')->get()
        ];
        return view('post.index')->with($data);
    }
}
