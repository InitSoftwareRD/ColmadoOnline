<?php

namespace App\Http\Controllers;

use App\Customers;
use App\OrderProducts;
use App\Orders;
use App\OrderTracking;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Proceso;

class ClientOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (! auth()->user()->isClient()) {
                abort(403, 'Solo los clientes puedes realizar ordenes por este canal.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        return view('front.pages.order', [
            'orders' => Orders::where('customer_id', Customers::firstOrCreate([
                'user_id' => auth()->id()
            ])->id)
                ->addSelect(['last_status' => OrderTracking::select('order_status')
                    ->whereColumn('order_id', 'orders.id')
                    ->orderBy('id', 'desc')
                    ->limit(1)
                ])
                ->with('products')
                ->orderByDesc('id')
                ->paginate()
        ]);
    }
    public function store()
    {
        DB::transaction(function () {

            $customer = Customers::firstOrCreate([
                'user_id' => auth()->id()
            ], [
                'location' => request('lat') .','. request('lng')
            ]);

            $order = Orders::create([
                'user_id' => auth()->id(),
                'customer_id' => $customer->id,
                'total' => Cart::session(auth()->id())->getTotal(),
                'ping' => rand (100000, 999999),
                'canal' => 'I',
                'paid_with' => request('paid_with'),
                'location' => $newLocation = request()->location_store  ? request('lat') .','. request('lng') : $customer->location
            ]);

            $customer->update(['location' => $newLocation]);

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


            try{
                Mail::to(auth()->user()->email)
                ->send(new Proceso(auth()->user()));
            }catch(\Exception  $e){

            }

        });
        return redirect()->route('order')->with(['success' => 'Orden completada correctamente']);
    }

    public function show(Orders $orders)
    {
        return view('front.pages.order_detail', [
            'order' => Orders::query()
                ->where('id', $orders->id)
                ->addSelect(['last_status' => OrderTracking::select('order_status')
                    ->whereColumn('order_id', 'orders.id')
                    ->orderBy('id', 'desc')
                    ->limit(1)
                ])
                ->with(['products'])
                ->firstOrFail()
        ]);
    }
}
