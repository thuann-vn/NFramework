<?php

function priceFormat($price)
{
    return number_format($price, 0 , '',',') .' ₫';
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function productImage($path, $size='')
{
    if(!empty($size)){
        $newPath = pathinfo($path, PATHINFO_DIRNAME).'/'. pathinfo($path, PATHINFO_FILENAME) . '-'.$size.'.'.pathinfo($path, PATHINFO_EXTENSION);
        if(file_exists('storage/'.$newPath)){
            $newPath = str_replace(' ', '%20',$newPath);
            return asset('storage/'.$newPath);
        }
    }

    if($path && file_exists('storage/'.$path)){
        return asset('storage/'.str_replace(' ', '%20',$path));
    }

    return asset('img/not-found.jpg');
}

function isInCart($id){
    $existed = Cart::search(function ($cartItem) use ($id) {
        return $cartItem->id == $id;
    });
    return count($existed) > 0;
}

function isInWishlist($id){
    $existed = Cart::instance('saveForLater')->search(function ($cartItem) use ($id) {
        return $cartItem->id == $id;
    });
    return count($existed) > 0;
}

function getNumbers()
{
    $tax = config('cart.tax');
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (Cart::subtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}

function getRelatedProducts($slug){
    return \App\Product::where('slug', '!=', $slug)->relatedProduct()->get();
}

function getCurrentLocale(){
    return Session::get('applocale');
}

function isVietnamese(){
    return getCurrentLocale()=='vi';
}

function getMenuData($menuName)
{
    $items = Cache::rememberForever('menu_'.$menuName. '_'.getCurrentLocale(), function() use ($menuName) {
        return TCG\Voyager\Facades\Voyager::model('MenuItem')->whereHas('menu', function($query) use ($menuName){
            return $query->where('name', $menuName);
        })->whereNull('parent_id')->orderBy('order')->get()->translate();
    });
    return $items;
}

function getChildMenuItems($menuId)
{
    $items = Cache::rememberForever('child_menus' . $menuId. '_'.getCurrentLocale(), function() use ($menuId) {
        return TCG\Voyager\Facades\Voyager::model('MenuItem')->where('parent_id', $menuId)->orderBy('order')->get()->translate();
    });
    return $items;
}
