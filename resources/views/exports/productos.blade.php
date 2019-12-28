<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Precio</th>
        <th>Estatus</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->name }}</td>
            <td>{{ $producto->category['name'] }}</td>
            <td>{{ $producto->price }}</td>
            <th>{{ $producto->status }}</th>
        </tr>
    @endforeach
    </tbody>
</table>