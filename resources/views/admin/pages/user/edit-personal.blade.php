@extends('admin.layout.layout')

@section('title')
  Actualizar Empleado
@endsection

@section('content')


<div class="row">
        <div class="col-md-12">

                @include('admin.fragment.flashmessage')
            
                <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title text-center">Actualizar Empleado</h3>
                    </div>

                   @include('admin.fragment.error')

                        <!-- /.card-header -->
                        <!-- form start -->
                <form class="m-4" method="POST" action="{{ route('actualizarEmpleado') }}" >
                             @csrf
                            <div class="form-row">
                                  <div class="col-md-4 mb-3">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres"  
                                    value="{{ $user->name }}"
                                    required>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos"  
                                    value="{{ $user->last_name }}"
                                    required>
                                  </div>

                                  <div class="col-md-4 mb-3">
                                    <label for="correo">Correo</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="correo">@</span>
                                      </div>
                                      <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo"  aria-describedby="Correo" 
                                      onkeyup="javascript:this.value=this.value.toLowerCase();"
                                      value="{{ $user->email }}"
                                      required>
                                    </div>
                                  </div>

                                </div>
                                <div class="form-row">
                                  <div class="col-md-4 mb-3">
                                    <label for="Celular">Celular</label>
                                    <input type="phone" class="form-control" id="celular" name="celular" placeholder="Celular" 
                                    value="{{ $user->phone }}"
                                    required>
                                  </div>

                                  <div class="col-md-2 mb-3">
                                    <label for="rol">Rol</label>
                                    <select class="custom-select mr-sm-2" id="rol" name="rol" required>

                                            @if($user->rol_id==2)

                                            <option value="2" selected>Delivery</option>
                                            <option value="3">Cajero</option>

                                            @else

                                            <option value="2" >Delivery</option>
                                            <option value="3" selected>Cajero</option>
                                             
                                            @endif
                                           
                                    </select>
                                  </div>

                                  <div class="col-md-4 mb-3">
                                        <label for="pass">Contraseña</label>
                                         <input type="text" class="form-control"  name="contrasena" placeholder="Contraseña">
                                    </div>

                                <input type="hidden" name="id" value="{{ $user->id }}" >

                                </div>
                             

                                <button class="btn btn-primary" type="submit">Actualizar Empleado</button>
                              </form>
                </div>

        </div>

</div>





@endsection