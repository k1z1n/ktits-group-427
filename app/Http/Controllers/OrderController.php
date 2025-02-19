<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(){

        $cartItems = Cart::where('user_id', auth()->id())->get();

        $total = 0;

        foreach ($cartItems as $item){
            $total += $item->product->price * $item->count;
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total
        ]);

        foreach ($cartItems as $item){
            OrderItem::create([
               'product_id' => $item->product_id,
               'order_id' => $order->id,
               'count' => $item->count
            ]);
            $item->delete();
        }

        return redirect()->route('view.profile');
    }


    public function showProfile()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('pages.profile', compact('orders'));
    }
}
