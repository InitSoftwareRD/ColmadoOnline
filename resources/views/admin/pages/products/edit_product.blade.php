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

                       <a href="{{ route('productostatus',[$producto->id, $producto->status ]) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-power-off"></i>
                            </a>

                        <a href="{{ route('formulario-fragment',$producto->id) }}" class="btn btn-info btn-sm text-white">
                                    <i class="fas fa-edit"></i>
                            </a>
                                
                            @else

                            <a href="{{ route('productostatus',[$producto->id, $producto->status ]) }}"  class="btn btn-success btn-sm">
                                    <i class="fas fa-power-off"></i>
                            </a>

                            <a  href="{{ route('formulario-fragment',$producto->id) }}" class="btn btn-info btn-sm text-white">
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
    $('#productos').DataTable();
} );

</script>


@endsection
