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
                            <a href="{{ route('ofertastatus',[$oferta->id,$oferta->status]) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-power-off"></i>
                                </a>                    
                               @else

                               <a  href="{{ route('ofertastatus',[$oferta->id,$oferta->status]) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-power-off"></i>
                               </a>
                                  
                               @endif

                               <a href="" class="btn btn-warning btn-sm text-white">
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
    $('#ofertas').DataTable();
} );

</script>
    
@endsection