@extends('admin.layout.layout')

@section('title')
    Clientes
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

            @include('admin.fragment.flashmessage')

            <table id="clientes" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Sexo</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                       @foreach ($users as $user)

                       <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td class="celular">{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->sex }}</td>
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

                                <a href="{{ route('Clientestatus',[$user->id,$user->status]) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-power-off"></i>
                                </a>
                                    
                                @else

                                <a  href="{{ route('Clientestatus',[$user->id,$user->status]) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-power-off"></i>
                                </a>
                                    
                                @endif
                             
                            <a href="{{ route('editar-cliente',$user->id) }}" class="btn btn-warning btn-sm text-white">
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
    $('#clientes').DataTable();
   

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