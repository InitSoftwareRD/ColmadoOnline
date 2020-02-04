@extends('admin.layout.layout')

@section('title')
    Histórico de Ordenes
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
        
      <a href="{{ route('exportarHistorico') }}" target="_blank" class="btn btn-success btn-lg" title="Exportar a excel"><i class="fas fa-file-excel"></i></a>

      <form action="{{ route('HistoricoOrdenes') }}" method="GET" class="row mt-3">
        <div class="form-group col-md-2">
          <label for="fecha_inicio">Fecha inicio:</label>
          <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" value="{{ request('fecha_inicio') }}">
        </div>

        <div class="form-group col-md-2">
          <label for="fecha_fin">Fecha fin:</label>
          <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" value="{{ request('fecha_fin') }}">
        </div>

        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-success" style="margin-top: 30px;">Consultar</button>
        </div>
      </form>

            <table id="historico" class="table table-sm table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th># Orden</th>
                            <th>Canal</th>
                            <th>Nombres</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Total</th>
                            <th >Pagado</th>
                            <th>Delivery</th>
                            <th>Ping</th>
                            <th>Estatus</th>
                            <th>Fecha</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>

                       @foreach ($history as $ht)
                       <tr>
                       <th>{{ $ht->id }}</th>
                       <th>{{ $ht->canal  }}</th>    
                       <th>{{ $ht->nombres }}</th>
                       <th>{{ $ht->phone }}</th>
                       <th>{{ $ht->email }}</th>
                       <th>{{ $ht->total }}</th>
                       <th>{{ $ht->pagado }}</th>
                       <th>{{ $ht->delivery }}</th>
                       <th>{{ $ht->ping }}</th>
                       <th>{{ $ht->estatus }}</th>
                       <th>{{ $ht->Fecha }}</th>

                       <th>
                       <a href="{{ route('DetalleHistorico',$ht->id) }}" class="btn btn-success btn-info btn-sm"title="Mostrar detalle orden"><i class="fas fa-list-ol"></i></a>
                        </th> 
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
        
    $('#historico').DataTable({
            "language":idioma_espanol
        });
   

} );

</script>
    
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" ></script>

<script>
$(document).ready(function() {
    $('.celular').mask('(000) 000-0000');
   

} );

</script>


    
@endsection