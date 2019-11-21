<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Offers;
use App\Http\Requests\OfertaRequest;


class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos=Products::where('status','A')->get();
        return view('admin.pages.products.ofertas', compact('productos'));
        
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
