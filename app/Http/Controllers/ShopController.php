<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use App\Brand;
use App\Department;
use App\Product;
use App\Category;
use Cartalyst\Stripe\Api\Products;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = config('shop.pagination');;
        $categories = Category::all();

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {
            $products = Product::where('featured', true);
            $categoryName = 'Featured';
        }

        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::with('categories')->where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        $categories = $product->categories->pluck('id')->toArray();
        $similar = Product::whereHas('categories', function($query) use ($categories){
           return $query ->whereIn('category_id', $categories);
        })->get();

        return view('shop.product')->with([
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike,
            'similar' => $similar
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, $parentSlug , $slug = null)
    {
        $pagination = config('shop.pagination');
        $category = Category::with('children')->where('slug', $parentSlug)->first();

        $brands = Brand::where('featured', 1)->paginate(10);
        $attributes = Attribute::has('values')->get();
        $department = Department::find($category->id);

        //Get product by category
        $products = null;
        if(!empty($slug)){
            $childCategory = Category::with('children')->where('slug', $slug)->first();

            $products = Product::with(['categories','attributes'])->whereHas('categories', function ($query) use ($slug) {
                return $query->where('slug', $slug)->orWhere(function($query) use ($slug){
                    return $query->whereHas('parent', function($child) use ($slug){
                        return $child->where('slug', $slug);
                    });
                });
            });
        }else{
            $childCategory = null;
            $products = Product::with(['categories','attributes'])->whereHas('categories', function ($query) use ($parentSlug) {
                return $query->where('slug', $parentSlug);
            });
        }

        //Filters
        $filter = $this->getFilters($request, $products, $attributes);

        //Sort
        $products = $this->sortProducts($products, request()->sort)->paginate($pagination);

        return view('shop.category')->with([
            'products' => $products,
            'department' => $department,
            'category' => $category,
            'categoryName' => $category->name,
            'brands' => $brands,
            'attributes' => $attributes,
            'filters' =>$filter[0],
            'currentFilters'=>$filter[1],
            'sort' => $request->input('sort'),
            'childCategory' => $childCategory
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function brand(Request $request, $slug, $categorySlug = null)
    {
        $pagination = config('shop.pagination');
        $brand = Brand::where('slug', $slug)->first();

        $categories = Category::whereHas('products', function ($products) use ($brand) {
            return $products->where('brand_id', $brand->id);
        })->orderBy('name')->get();
        $attributes = Attribute::has('values')->get();

        //Get product by category
        $products = null;
        if(!empty($categorySlug)){
            $childCategory = Category::with('children')->where('slug', $categorySlug)->first();

            $products = Product::with(['attributes'])->where('brand_id', $brand->id)->whereHas('categories', function ($query) use ($categorySlug) {
                return $query->where('slug', $categorySlug)->orWhere(function($query) use ($categorySlug){
                    return $query->whereHas('parent', function($child) use ($categorySlug){
                        return $child->where('slug', $categorySlug);
                    });
                });
            });
        }else{
            $childCategory = null;
            $products = Product::with(['categories','attributes'])->where('brand_id', $brand->id);
        }

        //Filters
        $filter = $this->getFilters($request, $products, $attributes);

        //Sort
        $products = $this->sortProducts($products, request()->sort)->paginate($pagination);

        return view('shop.brand')->with([
            'products' => $products,
            'categories'=>$categories,
            'brand' => $brand,
            'brandName' => $brand->name,
            'attributes' => $attributes,
            'filters' =>$filter[0],
            'sort' => $request->input('sort'),
            'currentFilters'=> $filter[1],
            'childCategory' => $childCategory
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function department($slug)
    {
        $pagination = config('shop.pagination');

        $department = Department::where('slug', $slug)->first();
        $categories = Category::where('department_id', $department->id)->whereNull('parent_id')->orderBy('name')->get();
        $featured_categories = Category::where('department_id', $department->id)->where('featured', true)->orderBy('name')->get();
        $brands = Brand::where('featured', 1)->paginate(10);
        $attributes = Attribute::all();

        $products = Product::with('categories')->whereHas('categories', function ($query) use ($department) {
            $query->where('department_id', $department->id);
        });

        //Sort
        $products = $this->sortProducts($products, request()->sort)->paginate($pagination);

        return view('shop.department')->with([
            'department' => $department,
            'products' => $products,
            'categories' => $categories,
            'featuredCategories' => $featured_categories,
            'brands' => $brands,
            'sort' => request()->sort,
            'attributes' => $attributes
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function sale(Request $request, $categorySlug = null)
    {
        $pagination = config('shop.pagination');

        $categories = Category::whereHas('products', function ($products) {
            return $products->where('regular_price', '>',0);
        })->orderBy('name')->get();

        $attributes = Attribute::has('values')->get();

        //Get product by category
        $products = null;
        if(!empty($categorySlug)){
            $childCategory = Category::with('children')->where('slug', $categorySlug)->first();

            $products = Product::with(['attributes'])->where('regular_price', '>',0)->whereHas('categories', function ($query) use ($categorySlug) {
                return $query->where('slug', $categorySlug)->orWhere(function($query) use ($categorySlug){
                    return $query->whereHas('parent', function($child) use ($categorySlug){
                        return $child->where('slug', $categorySlug);
                    });
                });
            });
        }else{
            $childCategory = null;
            $products = Product::with(['categories','attributes'])->where('regular_price', '>',0);
        }

        //Filters
        $filter = $this->getFilters($request, $products, $attributes);

        //Sort
        $products = $this->sortProducts($products, request()->sort)->paginate($pagination);

        return view('shop.sale')->with([
            'products' => $products,
            'categories'=>$categories,
            'attributes' => $attributes,
            'filters' =>$filter[0],
            'sort' => $request->input('sort'),
            'currentFilters'=>$filter[1],
            'childCategory' => $childCategory
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');

        // $products = Product::where('name', 'like', "%$query%")
        //                    ->orWhere('details', 'like', "%$query%")
        //                    ->orWhere('description', 'like', "%$query%")
        //                    ->paginate(10);

        $products = Product::search($query)->paginate(10);

        return view('search-results')->with('products', $products);
    }

    public function searchAlgolia(Request $request)
    {
        return view('search-results-algolia');
    }

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

    private function getFilters($request, $products, $attributes){
        $filters= [
            'category' => $request->input('category'),
            'brand' => []
        ];
        $brandFilters = $request->has('brand')? explode('~',$request->input('brand')): [];

        $currentFilters = [];
        if(!empty($brandFilters)){
            $filters['brand'] = $brandFilters;

            $products = $products->whereHas('brand', function($query) use ($brandFilters){
                return $query->whereIn('slug', $brandFilters);
            });

            //Add to current filters
            $currentFilters['brand'] = Brand::whereIn('slug', $brandFilters)->get(['name', 'slug', 'id'])->toArray();
        }

        foreach ($attributes as $attribute){
            if(!empty($request->input($attribute->slug))){
                $filterSlugs = explode('~',$request->input($attribute->slug));
                $filters[$attribute->slug] = $filterSlugs;

                //Add to filters
                $products = $products->whereHas('attributes', function($attributes) use ($filterSlugs){
                    return $attributes -> whereHas('details', function ($details) use ($filterSlugs){
                        return $details->whereHas('attributeValue', function($values) use ($filterSlugs){
                            return $values->whereIn('slug', $filterSlugs);
                        });
                    });
                });

                //Add to current filters
                $currentFilters[$attribute->slug] = AttributeValue::whereIn('slug', $filterSlugs)->get(['value', 'slug', 'id'])->toArray();
            }else{
                $filters[$attribute->slug] = [];
            }
        }

        return [$filters, $currentFilters];
    }
}
