<?php

function priceFormat($price)
{
    return number_format($price, 0 , '',',') .' ₫';
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function productImage($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
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
