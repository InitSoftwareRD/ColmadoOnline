<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\User;

class EmpleadosExport implements FromView
{
    
    public function view(): View
    {
        return view('exports.empleados', [
            'users' => User::whereIn('rol_id', [2, 3, 4])->get()
        ]);
    }
}
