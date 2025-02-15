<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $total = 0;
        if ($cartItems) {
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->count;
            }
        }
        return view('pages.cart', compact('cartItems', 'total'));
    }

    public function removeCount($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);

//        dd(gettype($cartItem->count));
        if ($cartItem->count > 1) {
            $cartItem->count--;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }

        return redirect()->route('view.cart');
    }

    public function addCount($cartId){
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->count++;
        $cartItem->save();
        return redirect()->route('view.cart');
    }
}
