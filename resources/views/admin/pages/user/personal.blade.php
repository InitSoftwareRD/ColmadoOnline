@extends('admin.layout.layout')

@section('title')
    Personal
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('expotarEmpleados') }}" target="_blank" class="btn btn-success btn-lg" title="Exportar a excel"><i class="fas fa-file-excel"></i></a>
   
            @include('admin.fragment.flashmessage')

            <table id="empleados" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Puesto</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                       @foreach ($users as $user)

                       <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->rol['name'] }}</td>
                            @if ($user->status=='A')
                            <td> 
                             <strong class="badge badge-success text-center">{{ $user->status }}</strong>
                            </td>                                 
                            @else
                            <td>
                              <strong class="badge badge-danger text-center"> {{ $user->status }}</strong>
                            </td>  
                            @endif

                            <td>
                                @if ($user->status=='A')

                                       <a href="{{ route('Personalstatus',[$user->id,$user->status]) }}" class="btn btn-danger btn-sm" title="Desactivar">
                                        <i class="fas fa-power-off"></i>
                                </a>
                                    
                                @else

                                <a  href="{{ route('Personalstatus',[$user->id,$user->status]) }}"  class="btn btn-success btn-sm" title="Activar">
                                        <i class="fas fa-power-off"></i>
                                </a>
                                    
                                @endif
                             
                            <a href="{{ route('editar-empleado',$user->id) }}" class="btn btn-warning btn-sm text-white" title="Editar">
                                    <i class="fas fa-user-edit"></i>
                               </a>

                            </td>
                           
                        </tr>
                           
                       @endforeach 
                   
                    </tbody>
            </table>
        

    </div>

</div>




    
@endsection


@section('script')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        var idioma_espanol = {
            "sProcessing": "Procesando..."
            , "sLengthMenu": "Mostrar _MENU_ registros"
            , "sZeroRecords": "No se encontraron resultados"
            , "sEmptyTable": "Ningún dato disponible en esta tabla"
            , "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros"
            , "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros"
            , "sInfoFiltered": "(filtrado de un total de _MAX_ registros)"
            , "sInfoPostFix": ""
            , "sSearch": "Buscar:"
            , "sUrl": ""
            , "sInfoThousands": ","
            , "sLoadingRecords": "Cargando..."
            , "oPaginate": {
                "sFirst": "Primero"
                , "sLast": "Último"
                , "sNext": "Siguiente"
                , "sPrevious": "Anterior"
            }
            , "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

        $('#empleados').DataTable({
            "language":idioma_espanol
        });
    } );

</script>
    
@endsection