<?php

namespace App\Http\Controllers\Api;

use App\Attribute;
use App\AttributeValue;
use App\Brand;
use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Product;
use App\Category;
use Cartalyst\Stripe\Api\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ShopApiController extends Controller
{
    public function getFeaturedProducts(Request $request){

        return new ProductsResource(Product::with('variants')->where('featured', true)->inRandomOrder()->take(16)->get());
    }

    public function getProductList(Request $request){
        $url = request()->fullUrl();
        $data=  Cache::rememberForever($url, function () use ($request){
            Log::info('Created cache', [request()->fullUrl()]);
            $isFeaturedOnly = $request->input('featured_only');
            $categories = $request->input('cats');
            $brands = $request->input('brands');
            $pageSize = $request->input('page_size', config('shop.pagination'));

            $products = Product::with(['variants', 'brand' => function($brandQuery){
                $brandQuery->withTranslation(getCurrentLocale());
            }, 'categories' => function($categoriesQuery){
                $categoriesQuery->withTranslation(getCurrentLocale());
            }])->withTranslation(getCurrentLocale());

            if(!empty($brands)){
                $products = $products->whereIn('brand_id', explode(',', $brands));
            }

            if(!empty($categories)){
                $categories = explode(',', $categories);
                $products = $products->whereHas('categories', function ($query) use ($categories) {
                    return $query->whereIn('category_id', $categories);
                });
            }

            return ProductsResource::collection($products->paginate($pageSize))->response();
        });

        return $data;
    }

    public function show(){

    }
}
