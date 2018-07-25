<?php

namespace App\Http\Controllers;

use App\Attribute;
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
        $pagination = 9;
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
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        return view('shop.product')->with([
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request,$parentSlug, $slug)
    {
        $pagination = 9;
        $category = Category::where('slug', $slug)->first();
        $brands = Brand::where('featured', 1)->paginate(10);
        $attributes = Attribute::all();
        $department = Department::find($category->id);

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
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

        //Filters
        $filters= [
            'category' => $request->input('category'),
            'brand' => $request->input('brand'),
        ];

        foreach ($attributes as $attribute){
            if(!empty($request->input($attribute->slug))){
                $filters[$attribute->slug] = $request->input($attribute->slug);
            }
        }


        return view('shop.category')->with([
            'products' => $products,
            'department' => $department,
            'category' => $category,
            'categoryName' => $category->name,
            'brands' => $brands,
            'attributes' => $attributes
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
        $categories = Category::where('department_id', $department->id)->whereNull('parent_id')->get();
        $featured_categories = Category::where('department_id', $department->id)->where('featured', true)->get();
        $brands = Brand::where('featured', 1)->paginate(10);
        $attributes = Attribute::all();

        $products = Product::with('categories')->whereHas('categories', function ($query) use ($department) {
            $query->where('department_id', $department->id);
        });

        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('shop.department')->with([
            'department' => $department,
            'products' => $products,
            'categories' => $categories,
            'featuredCategories' => $featured_categories,
            'brands' => $brands,
            'attributes' => $attributes
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
}
