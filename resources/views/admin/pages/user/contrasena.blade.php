@extends('admin.layout.layout')

@section('title')
    Cambiar Contraseña
@endsection

@section('content')


<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      @include('admin.fragment.error')
      @include('admin.fragment.flashmessage')

      @if (session('actual'))
      <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
      <strong>  {{ session('actual') }} </strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      @endif  
        <form method="POST" action="{{ Route('CambiarPass') }}">
          @csrf
            <div class="form-group">
              <label for="Actual">Contraseña actual</label>
              <input type="password" class="form-control" name="actual" placeholder="Contraseña actual" required>
            </div>
            <div class="form-group">
              <label for="nueva1">Nueva Contraseña</label>
              <input type="password" class="form-control" name="NuevaContrasena" placeholder="Nueva Contraseña"   minlength="8"  required>
            </div>

            <div class="form-group">
                <label for="nueva2">Repetir nueva Contraseña</label>
                <input type="password" class="form-control" name="RepetirContrasena" placeholder="Repetir Contraseña" required >
              </div>

              <input class="btn btn-primary"  type="submit" value="Cambiar">
          </form>
    </div>

    <div class="col-md-3"></div>


</div>





@endsection