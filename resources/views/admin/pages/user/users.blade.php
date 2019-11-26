@extends('admin.layout.layout')

@section('title')
    Crear Usuarios
@endsection

@section('content')


<div class="row">
        <div class="col-md-12">

                @include('admin.fragment.flashmessage')
            
                <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title text-center">Crear Usuario</h3>
                    </div>

                   @include('admin.fragment.error')

                        <!-- /.card-header -->
                        <!-- form start -->
                <form class="m-4" method="POST" action="{{ Route('crear_usuario') }}" >
                             @csrf
                            <div class="form-row">
                                  <div class="col-md-4 mb-3">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" value="{{ old('nombre') }}" required>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" value="{{ old('apellido') }}" required>
                                  </div>

                                  <div class="col-md-4 mb-3">
                                    <label for="correo">Correo</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="correo">@</span>
                                      </div>
                                      <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo"  value="{{ old('correo') }}" aria-describedby="Correo" 
                                      onkeyup="javascript:this.value=this.value.toLowerCase();"
                                      required>
                                    </div>
                                  </div>

                                </div>
                                <div class="form-row">
                                  <div class="col-md-4 mb-3">
                                    <label for="Celular">Celular</label>
                                    <input type="phone" class="form-control" id="celular" name="celular" value="{{ old('celular') }}" placeholder="Celular" required>
                                  </div>
                                  <div class="col-md-2 mb-3">
                                    <label for="Sexo">Sexo</label>
                                    <select class="custom-select mr-sm-2" id="sexo" name="sexo" value="{{ old('sexo') }}">
                                            <option selected>Elegir Sexo</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                            <option value="O">Otros</option>
                                    </select>
                                  </div>
                                  <div class="col-md-2 mb-3">
                                    <label for="rol">Rol</label>
                                    <select class="custom-select mr-sm-2" id="rol" name="rol" value="{{ old('rol') }}">
                                            <option selected>Elegir Role</option>
                                            <option value="2">Delivery</option>
                                            <option value="3">Cajero</option>
                                    </select>
                                  </div>

                                  <div class="col-md-4 mb-3">
                                        <label for="pass">Contraseña</label>
                                      <input type="text" class="form-control" value="cafeteriaaa123" id="contrasena" name="contrasena" placeholder="Contraseña" readonly>   
                                         <span class="bg-warning">Favor cambiar contraseña predeterminada una vez inicada la session</span>
                                    </div>

                                </div>
                             

                                <button class="btn btn-primary" type="submit">Crear Usuario</button>
                              </form>
                </div>

        </div>

</div>





@endsection