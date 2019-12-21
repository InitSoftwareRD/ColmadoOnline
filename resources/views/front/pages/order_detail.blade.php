<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" type="text/css" media="print" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid">
    <h2 class="print">Order No {{ $order->id }}</h2>
    <p class="print">Fecha de la order: {{ $order->created_at->format('d/m/Y') }}</p>
    <a class="btn btn-primary" onclick="window.print();return false;">Imprimir</a>
    <table class="table print">
        <thead>
        <tr>
            <th>Articulo</th>
            <th>Descripcion</th>
            <th>Ingredientes</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->ingredients }}</td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>{{ number_format($product->pivot->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>

