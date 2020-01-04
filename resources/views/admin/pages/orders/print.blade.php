<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $cliente[0]->nombres }}</title>
</head>
<body>

    <style>
        table, th, td {
        border: 0.2px dotted black;
        }

        h1, h2, h3, h5{
            text-align: center;
        }

        h2{
            color: yellowgreen
        }


    </style>

    <h1>Orden # {{$detalle[0]->id }}</h1>
    <h2>Cafeteria AAA</h2>
    <h5>809-000-0000</h5>
 
        <h3>Cliente</h3>
    <table style="width:100%">
        <tr>
            <th>Nombres</th>
            <td>Teléfono</th>
            <th>Email</th>
        </tr>

        <tr>
            <td>{{ $cliente[0]->nombres }}</td>
            <td>{{  $cliente[0]->phone }}</td>
            <td>{{  $cliente[0]->email }}</td>
        </tr>
      </table>    

      <hr><br>

       <h3>Detalle Orden</h3>
    <table style="width:100%">
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>SubTotal</th>
        </tr>

        @foreach ($detalle as $item)

        <tr>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->cantidad  }}</td>
            <td>{{ $item->precio  }}</td>
            <td>{{ $item->subtotal  }}</td>
        </tr>  
        @endforeach

        <tr>
            <td></td>
            <td></td>
            <td style="color: red">Total</td>
            <td style="color: red" >{{$detalle[0]->total}}</td>
        </tr>

      
      </table>    
</body>
</html>