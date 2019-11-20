@extends('admin.layout.layout')

@section('title')
    Editar Productos
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    
@endsection

@section('content')

<div class="row">
            @include('admin.fragment.flashmessage');
            @include('admin.fragment.error');

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
                           <img src=" {{  asset($producto->images->first()->ruta) }} "  width="50" height="50">   
                       </th>    
                       <td>{{ $producto->id }}</td>
                       <td>{{ $producto->name }}</td>
                       <td>{{ $producto->category['name'] }}</td>
                       <td>{{ $producto->price }}</td>
                       <td>
                            
                            @if ($producto->status=='A')

                            <a href="" class="btn btn-danger btn-sm">
                                    <i class="fas fa-power-off"></i>
                            </a>

                        <button class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#producto{{ $producto->id }}">
                                    <i class="fas fa-edit"></i>
                            </button>
                                
                            @else

                            <a  href="" class="btn btn-success btn-sm">
                                    <i class="fas fa-power-off"></i>
                            </a>

                            <button class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#producto{{ $producto->id }}">
                                    <i class="fas fa-edit"></i>
                            </button>
                                
                            @endif
                         
                        </td>
                       </tr>      
                              @include('admin.pages.products.edit_product_modal');
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
