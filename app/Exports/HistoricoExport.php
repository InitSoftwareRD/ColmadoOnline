<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use App\User;

class HistoricoExport implements FromView
{
    
    public function view(): View
    {
        return view('exports.historico', [
            'history' => DB::SELECT("SELECT 
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
            ")
        ]);
    }
}
