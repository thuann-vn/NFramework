<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    public function index()
    {
        return view('favorites')->with(['items' => Cart::instance('saveForLater')->content()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'Item has been removed!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('saveForLater.index')->with('success_message', 'Item is already in your wish list!');
        }

        Cart::instance('saveForLater')->add($product->id, $product->name, 1, $product->price)
            ->associate('App\Product');

        return redirect()->route('saveForLater.index')->with('success_message', 'Item was added to your wish list!');
    }

    /**
     * Switch item from Saved for Later  to Cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your Cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        return redirect()->route('cart.index')->with('success_message', 'Item has been moved to Cart!');
    }
}
