@extends('admin.layout.layout')

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    
@endsection

@section('content')

<div class="row">
       
    <div class="col-md-4">
            @include('admin.fragment.flashmessage');
            @include('admin.fragment.error');

    <form class="form-inline" method="post" action="{{ route('create_category') }}">
                    @csrf
                    <label class="sr-only" for="inlineFormInputGroupUsername2">Categoria</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">C</div>
                      </div>
                      <input type="text" class="form-control" id="category" name="categoria" placeholder="Categoria"
                      onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    </div>
                      
                    <button type="submit" class="btn btn-success mb-2">Agregar</button>
                  </form>


    </div>

    <div class="col-md-8">
            <table id="clientes" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            
                       
                       <tr>
                       <td>{{ $category->name }}</td>
                       <td>{{ $category->status }}</td>
                       <td>
                            @if ($category->status=='A')

                            <a href="{{ route('categorystatus',[$category->id,$category->status]) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-power-off"></i>
                            </a>
                                
                            @else

                            <a  href="{{ route('categorystatus',[$category->id,$category->status]) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-power-off"></i>
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
    $('#clientes').DataTable();
} );

</script>
    
@endsection
