@extends('admin.layout.layout')

@section('title')
    Editar Productos
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    
@endsection

@section('content')

@include('admin.fragment.flashmessage')
@include('admin.fragment.error')

<div class="row">
    <div class="col-md-12">
            <table id="productos" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            
                       
                       <tr>

                       <th> 
                           <img src=" {{  asset($producto->images->first()->ruta) }} "  width="50" height="50"/>   
                       </th>    
                       <td>{{ $producto->id }}</td>
                       <td>{{ $producto->name }}</td>
                       <td>{{ $producto->category['name'] }}</td>
                       <td>{{ $producto->price }}</td>
                       <td>
                            
                            @if ($producto->status=='A')

                       <a href="{{ route('productostatus',[$producto->id, $producto->status ]) }}" class="btn btn-danger btn-sm" title="Desactivar">
                                    <i class="fas fa-power-off"></i>
                            </a>

                        <a href="{{ route('formulario-fragment',$producto->id) }}" class="btn btn-info btn-sm text-white" title="Editar">
                                    <i class="fas fa-edit"></i>
                            </a title="Activar">
                                
                            @else

                            <a href="{{ route('productostatus',[$producto->id, $producto->status ]) }}"  class="btn btn-success btn-sm" title="Desactivar">
                                    <i class="fas fa-power-off"></i>
                            </a>

                            <a  href="{{ route('formulario-fragment',$producto->id) }}" class="btn btn-info btn-sm text-white" title="Editar">
                                    <i class="fas fa-edit"></i>
                            </a>
                                
                            @endif
                         
                        </td>

                       </tr>    
                                                                                 
                       @endforeach

                    </tbody>
            </table>
        

    </div>

    

</div>





    
@endsection


@section('script')

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
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
        
    $('#productos').DataTable({
      "language":idioma_espanol
    });
} );

</script>


@endsection
