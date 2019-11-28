<?php

namespace App\Http\Controllers;

use App\Customers;
use App\OrderProducts;
use App\Orders;
use App\OrderTracking;
use Cart;

class ClientOrderController extends Controller
{
    public function index()
    {
        return view('front.pages.order', [
            'orders' => Orders::where('customer_id', Customers::firstOrCreate([
                'user_id' => auth()->id()
            ])->id)
                ->orderByDesc('id')
                ->paginate()
        ]);
    }
    public function store()
    {
        $order = Orders::create([
            'user_id' => auth()->id(),
            'customer_id' => Customers::firstOrCreate([
                'user_id' => auth()->id()
            ])->id,
            'total' => Cart::session(auth()->id())->getTotal(),
            'ping' => rand (100000, 999999),
            'canal' => 'C',
            'paid_with' => request('paid_with'),
            'location' => request('lat') .','. request('lng')
        ]);

        foreach(Cart::session(auth()->id())->getContent() as $item )
        {
            OrderProducts::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        OrderTracking::create([
            'order_id' => $order->id,
            'order_status' => 1
        ]);

        Cart::session(auth()->id())->clear();

        return redirect()->route('order');
    }
}
