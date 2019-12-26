@extends('admin.layout.layout')

@section('title')
   Editar Oferta
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">

            @include('admin.fragment.flashmessage');

            <table id="ofertas" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>%Descuento</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                       @foreach ($ofertas as $oferta)

                       <tr>
                            <td>{{ $oferta->Producto }}</td>
                            <td>{{ $oferta->Inicio }}</td>
                            <td>{{ $oferta->Final }}</td>
                            <td>{{ $oferta->Descuento }}</td>
                            @if ($oferta->status=='A')
                            <td> 
                            <strong class="badge badge-success text-center">{{ $oferta->status }}</strong>
                            </td>                                 
                            @else
                            <td>
                              <strong class="badge badge-danger text-center"> {{ $oferta->status }}</strong>
                            </td>  
                            @endif
                            <td>
                              
                               @if ($oferta->status=='A')
                            <a href="{{ route('ofertastatus',[$oferta->id,$oferta->status]) }}" class="btn btn-danger btn-sm" title="Desactivar">
                                        <i class="fas fa-power-off"></i>
                                </a>                    
                               @else

                               <a  href="{{ route('ofertastatus',[$oferta->id,$oferta->status]) }}" class="btn btn-success btn-sm" title="Activar">
                                    <i class="fas fa-power-off"></i>
                               </a>
                                  
                               @endif

                            <a href="{{ route('oferta-fragment',$oferta->id) }}" class="btn btn-warning btn-sm text-white" title="Editar">
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
        
    $('#ofertas').DataTable({
      "language":idioma_espanol
    });
} );

</script>
    
@endsection