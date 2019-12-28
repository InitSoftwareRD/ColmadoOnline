<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\User;

class ClientesExport implements FromView
{
    
    public function view(): View
    {
        return view('exports.clientes', [
            'users' => User::whereIn('rol_id', [1])->get()
        ]);
    }
}
