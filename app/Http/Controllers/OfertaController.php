<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Offers;
use App\Http\Requests\OfertaRequest;
use Illuminate\Support\Facades\DB;


class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      $this->middleware(['auth','admin']);
    }

    

    public function index()
    {
        $productos=Products::where('status','A')->get();
        return view('admin.pages.products.ofertas', compact('productos'));
        
    }

    public function editarPage()
    {
       $ofertas=DB::SELECT("SELECT 
        O.ID as id, 
        O.begin_at as Inicio,
        O.end_at as Final,
        O.status as status,
        O.porciento as Descuento,
        P.name as Producto
        FROM offers O, products P
        WHERE
        O.product_id = P.id
        ORDER by o.status");

        return view('admin.pages.products.edit_oferta',compact('ofertas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function OfertaEstatus($id, $status)
    {
        $oferta = Offers::find($id);

        $mensaje="";

        if($status=='A')
        {
            $oferta->status='I';

            $mensaje = "Oferta desactivada Correctamente";

                 
        }else
        {
            $oferta->status='A';

            $mensaje = "Oferta activada Correctamente";

        }

        $oferta->save();

        return redirect()->route('editar-oferta')->with('status', $mensaje);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfertaRequest $request)
    {
        $oferta = new Offers;

        $oferta->product_id = $request->producto;
        $oferta->begin_at = $request->inicio;
        $oferta->end_at= $request->fin;
        $oferta->status = 'A';
        $oferta->promotion_text = $request->promocion;
        $oferta->porciento = $request->descuento;

        $oferta->save();

        return redirect()->route('crear-oferta')->with('status', 'Oferta creada de manera correcta!');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
