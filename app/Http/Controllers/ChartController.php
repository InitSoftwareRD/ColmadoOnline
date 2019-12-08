<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
	public function index ()
	{
		return view('admin.pages.charts.index', [
			'delivery' => $this->getOrderCountDelivery(),
			'customer' => $this->getOrderCountCustomer(),
			'product' => $this->getCountSoldProducts(),
			'revenue' => $this->getSalesRevenue(),
			'category' => $this->getCountProductCategory(),
			'years' => $this->getYears(),
			'channel' => $this->getCountOrderChannel(),
			'estatus' => $this->getCountOrderStatus()
		]);
	}

	// obtiene una lista con los años en que se ha efectuado un pedido
    public function getYears () : ?array
    {
    	// ejecuto la consulta de lugar
    	$result = DB::select("
			SELECT DISTINCT
				YEAR(o.created_at) AS yyear
			FROM
				orders AS o
			;
		");

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [];

	    	foreach ($result as $value)
	    	{
	    		$data[] = $value->yyear;
	    	}
    	}

    	return $data ?? null;
    }

    // para la peticion AJAX
	public function getRevenue (Request $request)
	{
		return response()->json([
			'data' => $this->getSalesRevenue($request->year) ?? null
		]);
	}

	// obtiene los ingresos por venta, mes y año
    public function getSalesRevenue (int $year = null) : ?array
    {
    	if(is_null($year))
    		$year = date('Y');

    	// ejecuto la consulta de lugar
    	$result = DB::select("
    		SELECT
	    		MONTH(o.created_at) AS mes,
	    		SUM(o.total) AS total
    		FROM
    			orders AS o
    		WHERE
    			YEAR(o.created_at) = ?
    		GROUP BY
    			MONTH(o.created_at)
		", array($year));

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [
	    		'labels' => ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
	    		'values' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
	    	];

	    	foreach ($result as $value)
	    	{
	    		$data['values'][$value->mes - 1] = $value->total;
	    	}
    	}

    	return $data ?? null;
    }

	// obtiene a los delivery por cantidad de ordenes entregadas
    public function getOrderCountDelivery () : ?array
    {
    	// ejecuto la consulta de lugar
    	$result = DB::select("
			SELECT
				CONCAT(u.`name`, ' ', u.last_name) AS delivery,
				COUNT(1) AS cantidad
			FROM
				orders AS o
			 		INNER JOIN
			 	users AS u ON o.delivery_id = u.id
			GROUP BY
				CONCAT(u.`name`, ' ', u.last_name)
		");

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [
	    		'labels' => [],
	    		'values' => []
	    	];

	    	foreach ($result as $value)
	    	{
	    		$data['labels'][] = $value->delivery;
	    		$data['values'][] = $value->cantidad;
	    	}
    	}

    	return $data ?? null;
    }

    // obtiene a los clientes que más compras han realizado
    public function getOrderCountCustomer () : ?array
    {
    	// ejecuto la consulta de lugar
    	$result = DB::select("
			SELECT
				CONCAT(u.`name`, ' ', u.last_name) AS cliente,
				COUNT(1) AS total
			FROM
				orders AS o
					INNER JOIN
				users AS u ON o.user_id = u.id
			GROUP BY
				CONCAT(u.`name`, ' ', u.last_name)
		");

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [
	    		'labels' => [],
	    		'values' => []
	    	];

	    	foreach ($result as $value)
	    	{
	    		$data['labels'][] = $value->cliente;
	    		$data['values'][] = $value->total;
	    	}
    	}

    	return $data ?? null;
    }

    // obtiene los productos que más se han vendido
    public function getCountSoldProducts () : ?array
    {
    	// ejecuto la consulta de lugar
    	$result = DB::select("
			SELECT
				p.`name` AS producto,
				SUM(op.quantity) AS cantidad
				
			FROM
				order_product AS op
					INNER JOIN
				products AS p ON op.product_id = p.id
			GROUP BY
				p.`name`
			;
		");

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [
	    		'labels' => [],
	    		'values' => []
	    	];

	    	foreach ($result as $value)
	    	{
	    		$data['labels'][] = $value->producto;
	    		$data['values'][] = $value->cantidad;
	    	}
    	}

    	return $data ?? null;
    }

    // obtiene los productos que más se han vendido por categoría
    public function getCountProductCategory () : ?array
    {
    	// ejecuto la consulta de lugar
    	$result = DB::select("
			SELECT
				c.`name` AS categoria,
				SUM(op.quantity) AS cantidad
			FROM
				order_product AS op
					INNER JOIN
				products AS p ON op.product_id = p.id
					INNER JOIN
				category AS c ON p.category_id = c.id
			GROUP BY
				c.`name`
			;
		");

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [
	    		'labels' => [],
	    		'values' => []
	    	];

	    	foreach ($result as $value)
	    	{
	    		$data['labels'][] = $value->categoria;
	    		$data['values'][] = $value->cantidad;
	    	}
    	}

    	return $data ?? null;
    }

    // obtiene la cantidad de ordenes por canales
    public function getCountOrderChannel () : ?array
    {
    	// ejecuto la consulta de lugar
    	$result = DB::select("
			SELECT
				CASE o.canal
					WHEN 'I' THEN 'Online'
					WHEN 'C' THEN 'Local'
					ELSE 'Otro'
				END AS canal,
				COUNT(1) AS cantidad
			FROM
				orders AS o
			GROUP BY
				o.canal
			;
		");

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [
	    		'labels' => [],
	    		'values' => []
	    	];

	    	foreach ($result as $value)
	    	{
	    		$data['labels'][] = $value->canal;
	    		$data['values'][] = $value->cantidad;
	    	}
    	}

    	return $data ?? null;
    }

    // obtiene la cantidad de ordenes por estados
    public function getCountOrderStatus () : ?array
    {
    	// ejecuto la consulta de lugar
    	$result = DB::select("
			SELECT
				`status`,
				COUNT(1) AS cantidad
			FROM
				(
					SELECT
						ot_1.order_id,
						ot_1.`order_status`,
						os.`name` AS `status`,
						COUNT(1) AS row_number
					FROM
						order_tracking AS ot_1
							INNER JOIN
						order_tracking ot_2 ON ot_1.order_id = ot_2.order_id AND ot_1.order_status <= ot_2.order_status
							INNER JOIN
						order_status AS os ON ot_1.`order_status` = os.id
					GROUP BY
						ot_1.order_id,
						ot_1.order_status,
						os.`name`
				) AS orders
			WHERE
				row_number = 1
			GROUP BY
				`status`
			;
		");

    	// me aseguro que exista data resultante del query
    	if(count($result))
    	{
    		$data = [
	    		'labels' => [],
	    		'values' => []
	    	];

	    	foreach ($result as $value)
	    	{
	    		$data['labels'][] = $value->status;
	    		$data['values'][] = $value->cantidad;
	    	}
    	}

    	return $data ?? null;
    }
}