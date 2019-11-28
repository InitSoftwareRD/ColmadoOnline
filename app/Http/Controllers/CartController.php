<?php

namespace App\Http\Controllers;

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

        Cart::session(auth()->id())->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => request('quantity')
        ]);

        return response()
            ->json(['message' => 'Producto A;adido correctamente.'], 200);
    }

    public function update(Products $products)
    {
        Cart::session(auth()->id())->update($products->id, [
            'id' => $products->id,
            'name' => $products->name,
            'price' => $products->price,
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
        return view('front.pages.checkout', [
            'carts' => Cart::session(auth()->id())->getContent(),
            'total' => number_format(Cart::session(auth()->id())->getTotal()),
        ]);
    }
}
