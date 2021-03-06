<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Sexo</th>
        <th>Celular</th>
        <th>Rol</th>
        <th>Estatus</th>
        <th>Creado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <th>{{ $user->last_name }}</th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->sex }}</td>
            <td>{{ $user->phone }}</td>
            @if ( $user->rol_id == 2 )
                <th>Delivery</th>
            @elseif ($user->rol_id == 3)
                  <th>Cajero</th>
            @else
                <th>Administrador</th>
            @endif
            <td>{{ $user->status }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>