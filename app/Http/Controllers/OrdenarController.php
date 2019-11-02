<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Orders;
use App\OrderTracking;
use App\OrderProducts;
use Illuminate\Support\Facades\DB;

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
       
    $productos=DB::select("
       SELECT p.id as id, p.name as name, ca.name as category, img.ruta as ruta, p.price as price  FROM image_product img, products as p, category ca
        WHERE
        p.id = img.product_id
        AND p.category_id = ca.id
        AND img.tipo = 'P'
        AND p.status != 'I'
       ");

       return $productos;
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
