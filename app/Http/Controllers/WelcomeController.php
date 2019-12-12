<?php

namespace App\Http\Controllers;

use App\Offers;
use App\Products;
use App\Categories;
use App\ImageProducts;

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
                ->addSelect(['oferta' => Offers::select('porciento')
                    ->whereColumn('offers.product_id', 'products.id')
                    ->whereStatus('A')
                    ->whereDate('begin_at', '<=', now())
                    ->whereDate('end_at', '>=', now())
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
                ->transform(function ($item) {
                    return array_merge($item->toArray(), [
                        'original_price' => $item->price,
                        'price' => $item->oferta ? $this->calculateNewPrice($item->price, $item->oferta) : number_format($item->price)
                    ]);
                })
        ]);
    }

    private function calculateNewPrice($price, $discount)
    {
        return $price - ($price *  $discount / 100);
    }
}
