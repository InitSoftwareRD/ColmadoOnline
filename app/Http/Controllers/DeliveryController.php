<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\OrderProducts;
use App\ImageProducts;
use App\Orders;
use App\OrderTracking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeliveryController extends Controller
{

    public function __construct()
    {
          $this->middleware('delivery');
    }
    
    public function DeliveryPage()
    {
        return view('admin.pages.orders.delivery');

    }


    public function OrdenesEntregar()
    {
        $ordenes=DB::SELECT(" SELECT 
        o.id as id,
        o.ping as ping,
        o.total as total,
        o.paid_with as pagado,
        o.location as ubicacion,
        o.delivery as delivery,
        CONCAT( u.name,' ', u.last_name ) as nombres,
        CONCAT('(',SUBSTRING(u.phone,1,3),')','-',SUBSTRING(u.phone,4,3),'-',SUBSTRING(u.phone,7,4) ) as phone
        FROM orders o, customers c , users u
        WHERE 
        o.customer_id =c.id 
        AND c.user_id = u.id
        AND o.canal = 'I'
        AND o.delivery  IS NOT NULL
        AND ( SELECT os.id FROM order_tracking ot ,order_status os
           WHERE
              os.id = ot.order_status
             AND ot.order_id = o.id
            ORDER by ot.created_at DESC
           LIMIT 1
         ) != 3
        ");

        return $ordenes;

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


    public function CambiarStatus(Request $request)
    {
        $tracking = new OrderTracking;

        $tracking->order_id = $request->order_id;
        $tracking->order_status = $request->status;

        $tracking->save();
         
    }



}
