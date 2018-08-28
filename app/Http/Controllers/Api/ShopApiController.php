<?php

namespace App\Http\Controllers\Api;

use App\Attribute;
use App\AttributeValue;
use App\Brand;
use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
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
        $data =  Cache::rememberForever($url, function () use ($request){
            $isFeaturedOnly = $request->input('featured_only', false);
            $categories = $request->input('cats');
            $brands = $request->input('brands');
            $pageSize = $request->input('page_size', config('shop.pagination'));

            $products = Product::with(['variants', 'brand' => function($brandQuery){
                $brandQuery->withTranslation(getCurrentLocale());
            }, 'categories' => function($categoriesQuery){
                $categoriesQuery->withTranslation(getCurrentLocale());
            }])->withTranslation(getCurrentLocale());

            if ($isFeaturedOnly) {
                $products = $products->where('featured', true);
            }

            if(!empty($brands)){
                $products = $products->whereIn('brand_id', explode(',', $brands));
            }

            if(!empty($categories)){
                $categories = explode(',', $categories);
                $products = $products->whereHas('categories', function ($query) use ($categories) {
                    return $query->whereIn('category_id', $categories);
                });
            }

            $products = $this->sortProducts($products, request()->sort);

            return ProductsResource::collection($products->paginate($pageSize))->response();
        });

        return $data;
    }

    public function getCategoryList(Request $request){
        $url = request()->fullUrl();
        $data =  Cache::rememberForever($url, function () use ($request){
            $isFeaturedOnly = $request->input('featured_only', false);
            $isHomeFeatured = $request->input('home_featured', false);
            $categories = Category::withTranslation(getCurrentLocale());

            if ($isFeaturedOnly) {
                $categories = $categories->where('featured', true);
            }

            if ($isHomeFeatured) {
                $categories = $categories->where('home_featured', true);
            }

            return CategoryResource::collection($categories->get())->response();
        });

        return $data;
    }

    public function getBrandList(Request $request){
        $url = request()->fullUrl();
        $data =  Cache::rememberForever($url, function () use ($request){
            $isFeaturedOnly = $request->input('featured_only', false);
            $brands = Brand::withTranslation(getCurrentLocale());

            if ($isFeaturedOnly) {
                $brands = $brands->where('featured', true);
            }

            return BrandResource::collection($brands->get())->response();
        });

        return $data;
    }

    public function show(){

    }

    /**
     * @param $query \Eloquent
     * @param $sort
     * @return mixed
     */
    private function sortProducts($query, $sort){
        switch ($sort){
            case 'featured':
                $query = $query->orderBy('featured', 'desc'); break;
            case 'best_seller':
                $query = $query->withCount('orders')->orderBy('orders_count', 'desc'); break;
            case 'newest':
                $query = $query->orderBy('created_at', 'desc'); break;
            case 'low_high':
                $query = $query->orderBy('price'); break;
            case 'high_low':
                $query = $query->orderBy('price', 'desc'); break;
        }
        return $query;
    }

}
