<?php

namespace App\Http\Controllers\Api;

use App\Attribute;
use App\AttributeValue;
use App\Brand;
use App\Department;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Cartalyst\Stripe\Api\Products;
use Illuminate\Http\Request;

class LandingPageApiController extends Controller
{
    /**
     * Get home categories
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomeCategories()
    {
        $results = Category::where('home_featured',1)->get()->translate();
        return response()->json($results);
    }

    /**
     * Get featured brands
     *
     * @return \Illuminate\Http\Response
     */
    public function getFeaturedBrands()
    {
        $results = Brand::with([])->where('featured',1)->get()->translate();
        return response()->json($results);
    }

    /**
     * Get featured brands
     *
     * @return \Illuminate\Http\Response
     */
    public function getFeaturedProducts()
    {
        $results = Product::with('variants')->where('featured', true)->inRandomOrder()->take(16)->get(['id','name', 'price','slug', 'image'])->translate();
        return response()->json($results);
    }
}
