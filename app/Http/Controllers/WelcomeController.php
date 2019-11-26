<?php

namespace App\Http\Controllers;

use App\Products;
use App\Categories;
use App\ImageProducts;
use Cart;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('front.pages.home', [
            'categorias' => Categories::all('id', 'name'),
            'productos' => Products::query()
                ->with('category')
                ->addSelect(['imagen_portada' => ImageProducts::select('ruta')
                    ->whereColumn('image_product.product_id', 'products.id')
                    ->where('tipo', 'p')
                    ->limit(1)
                ])
                ->when(request('search') ?? null, function ($query, $search) {
                    return $query->where('name', 'like', "%{$search}%");
                })
                ->when(request('categories') ?? null, function ($query, $category) {
                    return $query->whereHas('category', function ($query) use ($category) {
                        $query->whereIn('id', $category);
                    });
                })
                ->paginate()
        ]);
    }

    public function cart()
    {
        return view('front.pages.card_single', [
            'carts' => Cart::session(auth()->id())->getContent()
        ]);
    }
}
