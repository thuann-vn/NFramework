<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Services\FbBot;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cache::remember('landing_page_data_' .getCurrentLocale(), config('cache.cache_time'), function(){
            $products = Product::with('variants')->where('featured', true)->take(16)->inRandomOrder()->get(['id','name', 'price','slug', 'image'])->translate();
            $homeSlider = Slider::with('slides')->where('name', 'Home Slider')->first();
            $featuredCategories = Category::where('home_featured',1)->get()->translate();
            $featuredBrands = Brand::with([])->where('featured',1)->get();

            return [
                'featuredCategories' => $featuredCategories,
                'brands' => $featuredBrands,
                'products' => $products,
                'slider' => $homeSlider,
                'cache_time' => now()
            ];
        });
        return view('landing-page', $data);
    }
}
