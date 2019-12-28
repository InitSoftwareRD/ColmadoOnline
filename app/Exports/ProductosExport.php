<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Products;


class ProductosExport implements FromView
{
    
    public function view(): View
    {
        return view('exports.productos', [
            'productos' => Products::all()
        ]);
    }
}
