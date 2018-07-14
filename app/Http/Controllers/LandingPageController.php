<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get();
        $homeSlider = Slider::where('name', 'Home Slider')->first();
        $featuredCategories = Category::where('featured',1)->get();
        return view('landing-page')
            ->with('featuredCategories', $featuredCategories)
            ->with('products', $products)
            ->with('slider', $homeSlider);
    }
}
