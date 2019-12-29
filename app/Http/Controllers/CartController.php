<?php

namespace App\Http\Controllers;

use App\Offers;
use App\Products;
use Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('front.pages.card_single', [
            'carts' => Cart::session(auth()->id())->getContent()
        ]);
    }

    public function store()
    {
        $product = Products::findOrFail(request('product_id'));

        $product = $product->addSelect(['oferta' => Offers::select('porciento')
            ->whereColumn('offers.product_id', 'products.id')
            ->whereStatus('A')
            ->whereDate('begin_at', '<=', now())
            ->whereDate('end_at', '>=', now())
            ->limit(1)
        ])
            ->where('id', request('product_id'))
            ->first();

        Cart::session(auth()->id())->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->oferta ? $this->calculateNewPrice($product->price, $product->oferta) : $product->price,
            'quantity' => request('quantity')
        ]);

        return response()
            ->json(['message' => 'Producto A;adido correctamente.'], 200);
    }

    public function update(Products $products)
    {
        $products = $products->addSelect(['oferta' => Offers::select('porciento')
            ->whereColumn('offers.product_id', 'products.id')
            ->whereStatus('A')
            ->whereDate('begin_at', '<=', now())
            ->whereDate('end_at', '>=', now())
            ->limit(1)
        ])
            ->where('id', $products->id )
            ->first();

        Cart::session(auth()->id())->update($products->id, [
            'id' => $products->id,
            'name' => $products->name,
            'price' => $products->oferta ? $this->calculateNewPrice($products->price, $products->oferta) : $products->price,
            'quantity' => [
                'relative' => false,
                'value' => request('quantity')
            ]
        ]);

        return back()
            ->with(['message' => 'Producto actualizado correctamente.']);
    }

    public function delete(Products $products)
    {
        Cart::session(auth()->id())->remove($products->id);

        return response()
            ->json(['message' => 'Producto eliminado correctamente.'], 200);
    }

    public function deleteHTTP(Products $products)
    {
        Cart::session(auth()->id())->remove($products->id);

        return back()->with(['message' => 'Producto eliminado correctamente.']);
    }

    public function deleteAll()
    {
        Cart::session(auth()->id())->clear();

        return back()
            ->with(['message' => 'Carito vaciado correctamente.']);
    }

    public function verification()
    {
        $clientLocation = explode(',', optional(auth()->user()->customer)->location);

        return view('front.pages.checkout', [
            'carts' => Cart::session(auth()->id())->getContent(),
            'total' => Cart::session(auth()->id())->getTotal(),
            'hasLocation' => optional(auth()->user()->customer)->location ? 1 : 0,
            'lat' =>  array_filter($clientLocation, 'strlen') != [] ? $clientLocation[0] : '19.22456794056483',
            'lng' =>  array_filter($clientLocation, 'strlen') != [] ? $clientLocation[1] : '-70.5187199628906',
        ]);
    }

    public function cartCount()
    {
        return Cart::session(auth()->id())->getContent()->count();
    }

    private function calculateNewPrice($price, $discount)
    {
        return $price - ($price *  $discount / 100);
    }
}
