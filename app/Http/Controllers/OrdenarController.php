<?php

namespace App\Http\Controllers;

use App\Products;
use App\OrderProducts;
use App\ImageProducts;
use App\Orders;
use App\OrderTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdenarController extends Controller
{


    public function __construct()
   {
         $this->middleware('cajero');
   }

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
                    'id'=> $item->id,
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

      $order->user_id = auth()->id();
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

    public function status()
    {
        $status=DB::SELECT(" SELECT 
        o.id as id,
        o.ping as ping,
        o.total as total,
        CONCAT( u.name,' ', u.last_name ) as nombres,
        u.phone as phone,
        u.email as email,
        ( SELECT os.name FROM order_tracking ot ,order_status os
           WHERE
              os.id = ot.order_status
             AND ot.order_id = o.id
            ORDER by ot.created_at DESC
           LIMIT 1
         ) as estatus
        FROM orders o, customers c , users u
        WHERE 
        o.customer_id =c.id 
        AND c.user_id = u.id
        AND ( SELECT os.id FROM order_tracking ot ,order_status os
           WHERE
              os.id = ot.order_status
             AND ot.order_id = o.id
            ORDER by ot.created_at DESC
           LIMIT 1
         ) != 5
        ");

        return $status;

    }


    public function ListarStatus()
    { 
        $estatus=DB::SELECT("SELECT * FROM  order_status
                     WHERE
                     order_status.id != 4 
        ");

        return $estatus;


    }


    public function CambiarStatus(Request $request)
    {
        $tracking = new OrderTracking;

        $tracking->order_id = $request->order_id;
        $tracking->order_status = $request->status;

        $tracking->save();
         
    }

    public function DetallePedido(Request $request)
    {
        $detalle=DB::SELECT("SELECT 
                orders.id as id,
                products.name as nombre,
                order_product.quantity as cantidad,
                order_product.price as precio,
                order_product.subtotal as subtotal,
                orders.total as total
                FROM orders , order_product , products
                WHERE 
                orders.id = order_product.order_id
                AND order_product.product_id = products.id
                AND orders.id = ?
                ORDER BY  products.name DESC
        ",[$request->id]);

        return $detalle;

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
    public function ordenStatus()
    {
        return view('admin.pages.orders.orderstatus');
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
