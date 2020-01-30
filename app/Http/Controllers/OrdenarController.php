<?php

namespace App\Http\Controllers;

use App\Products;
use App\OrderProducts;
use App\ImageProducts;
use App\Orders;
use App\User;
use App\Mail\Proceso;
use App\Mail\Finalizado;
use App\Mail\Enviado;
use App\Mail\repartidor;
use App\OrderTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Exports\HistoricoExport;
use Maatwebsite\Excel\Facades\Excel;

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


       $user = User::find($request->customer['id']);
       
        try{
            Mail::to($user->email)
               ->send(new Proceso($user));
           }catch(\Exception  $e){
              
        }




    }

    public function status()
    {
        $status=DB::SELECT(" SELECT 
        o.id as id,
        o.ping as ping,
        o.total as total,
        CONCAT( u.name,' ', u.last_name ) as nombres,
        CONCAT('(',SUBSTRING(u.phone,1,3),')','-',SUBSTRING(u.phone,4,3),'-',SUBSTRING(u.phone,7,4) ) as phone,
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
        AND o.canal = 'C'
        AND ( SELECT os.id FROM order_tracking ot ,order_status os
           WHERE
              os.id = ot.order_status
             AND ot.order_id = o.id
            ORDER by ot.created_at DESC
           LIMIT 1
         ) != 3
        ");

        return $status;

    }


    public function Onlinestatus()
    {
        $status=DB::SELECT(" SELECT 
        o.id as id,
        o.ping as ping,
        o.total as total,
        o.delivery as delivery,
        CONCAT( u.name,' ', u.last_name ) as nombres,
        CONCAT('(',SUBSTRING(u.phone,1,3),')','-',SUBSTRING(u.phone,4,3),'-',SUBSTRING(u.phone,7,4) ) as phone,
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
        AND o.canal = 'I'
        AND ( SELECT os.id FROM order_tracking ot ,order_status os
           WHERE
              os.id = ot.order_status
             AND ot.order_id = o.id
            ORDER by ot.created_at DESC
           LIMIT 1
         ) != 3
         order by o.id desc
        ");

        return $status;

    }

    public function historico()
    {
        $history=DB::SELECT("SELECT 
        o.id as id,
        o.ping as ping,
        o.total as total,
        IFNULL(o.delivery,'N/A') as delivery,
        o.canal as canal,
        IFNULL(o.paid_with,'N/A') as pagado,
        CONCAT( u.name,' ', u.last_name ) as nombres,
        CONCAT('(',SUBSTRING(u.phone,1,3),')','-',SUBSTRING(u.phone,4,3),'-',SUBSTRING(u.phone,7,4) ) as phone,
        u.email as email,
        ( SELECT os.name FROM order_tracking ot ,order_status os
           WHERE
              os.id = ot.order_status
             AND ot.order_id = o.id
            ORDER by ot.created_at DESC
           LIMIT 1
         ) as estatus,
         ( SELECT ot.created_at FROM order_tracking ot ,order_status os
           WHERE
              os.id = ot.order_status
             AND ot.order_id = o.id
            ORDER by ot.created_at DESC
           LIMIT 1
         ) as Fecha
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
         ) = 3
         order by o.created_at DESC
        ");

           return view('admin.pages.orders.historico',compact('history'));

    }


    public function DetalleHistorico($id)
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
        ",[$id]);

          return view('admin.pages.orders.detalle',compact('detalle'));

    }


    public function HistoricoExport() 
    {
        return Excel::download(new HistoricoExport, 'Historico.xlsx');
    }


    public function Imprimir($id)
    {
        $detalle=DB::SELECT("SELECT 
        orders.id as id,
        products.name as nombre,
        order_product.quantity as cantidad,
        order_product.price as precio,
        order_product.subtotal as subtotal,
        orders.total as total,
        orders.created_at
        FROM orders , order_product , products
        WHERE 
        orders.id = order_product.order_id
        AND order_product.product_id = products.id
        AND orders.id = ?
        ORDER BY  products.name DESC
        ",[$id]);

        $usuario = DB::SELECT("SELECT 
        CONCAT( u.name,' ', u.last_name ) as nombres,
        CONCAT('(',SUBSTRING(u.phone,1,3),')','-',SUBSTRING(u.phone,4,3),'-',SUBSTRING(u.phone,7,4) ) as phone,
        u.identity as indentidad,
        u.email as email
       FROM orders o , customers c , users u
       WHERE
       o.customer_id = c.id
       AND c.user_id = u.id
       AND o.id = ?",[$id]);


            $data = [
                'detalle' =>  $detalle,
                'cliente' => $usuario
            ];

      return PDF::loadView('admin.pages.orders.print', $data)
            ->stream('archivo.pdf');





    }



    
    public function ListarStatus()
    { 
        $estatus=DB::SELECT("SELECT * FROM  order_status WHERE  order_status.id != 2 ");

        return $estatus;


    }

    public function ListarStatusOnline()
    { 
        $estatus=DB::SELECT("SELECT * FROM  order_status");

        return $estatus;


    }


    public function CambiarStatus(Request $request)
    {
        $tracking = new OrderTracking;

        $tracking->order_id = $request->order_id;
        $tracking->order_status = $request->status;
        $tracking->save();

        $order=Orders::findOrFail($request->order_id);
        $customer = \App\Customers::find($order->customer_id);
        $user = User::find($customer->user_id);
        
        if(in_array($request->status, [2])){
            try{
                Mail::to($user->email)
                ->send(new Enviado($user));
            }catch(\Exception  $e){
               
            }
        }

        if(in_array($request->status, [3])){
            try{
                Mail::to($user->email)
                ->send(new Finalizado($user));
            }catch(\Exception  $e){
               
            }
        }
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

  

    public function Asignar_delivery(Request $request)
    {
        $order = Orders::findOrFail($request->order_id);

        $order->delivery = $request->delivery;
        $order->delivery_id  = $request->delivery_id;

        $order->save();

        try{
            Mail::to('cafeteria3a@gmail.com')
               ->send(new repartidor($request->delivery));
           }catch(\Exception  $e){
              
        }

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
        $clientes=DB::select("SELECT c.id as id, u.identity as identificador , u.name as name , u.last_name as last_name ,u.phone as phone FROM 
        customers c,
        users u
        WHERE
        u.id = c.user_id
        and u.rol_id = 1 
        and u.status = 'A'
        ");

        return $clientes;
    }


    public function delivery()
    {
        $delivery = User::where('status','A')->where('rol_id',2)->get();
         
        return $delivery;

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
