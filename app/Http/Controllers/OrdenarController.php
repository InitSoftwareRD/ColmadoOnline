<?php

namespace App\Http\Controllers;

use App\Products;
use App\ImageProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdenarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.orders.ordenar');
    }

    public function ListarProducto()
    {
        return Products::query()
            ->with('category')
            ->addSelect(['imagen_portada' => ImageProducts::select('ruta')
                ->whereColumn('image_product.product_id', 'products.id')
                ->where('tipo', 'p')
                ->limit(1)
            ])
            ->get()
            ->transform(function ($item) {
                return [
                    'name' => $item->name,
                    'category' => $item->category->name,
                    'ruta' => url($item->imagen_portada),
                    'price' => $item->price
                ];
            });
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordenar(Request $request)
    {
       
      $order = new Orders;
      $tracking = new OrderTracking;

      $order->user_id = 1;
      $order->customer_id= $request->customer['id'];
      $order->total=$request->total;
      $order->ping = rand ( 100000, 999999 );
      $order->canal = 'C';

      $order->save();

       foreach( $request->carrito as $item )
       {
            OrderProducts::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity'=>$item['cantidad'],
                'price' => $item['price'],
                'subtotal' => $item['suma'],
            ]);
       }

       $tracking->order_id= $order->id;
       $tracking->order_status= 1;

       $tracking->save();




    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function listarClientes()
    {
        $clientes=DB::select("SELECT u.id as id, u.name as name , u.last_name as last_name ,u.phone as phone FROM 
        customers c,
        users u
        WHERE
        u.id = c.user_id ");

        return $clientes;
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
