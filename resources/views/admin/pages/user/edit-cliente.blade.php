@extends('admin.layout.layout')

@section('title')
  Actualizar Cliente
@endsection

@section('content')


<div class="row">
        <div class="col-md-12">

                @include('admin.fragment.flashmessage')
            
                   @include('admin.fragment.error')


                   <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header text-white bg-primary">Actualizar Cliente</div>
                
                                <div class="card-body">
                                    <form method="POST" action="{{ route('actualizarCliente') }}">
                                        @csrf
                
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombres</label>
                
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus required>
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Apellidos</label>
                
                                            <div class="col-md-6">
                                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">Telefono</label>
                
                                            <div class="col-md-6">
                                                <input id="phone" type="text" class="form-control" minlength="10" minlength="13" name="phone" value="{{ $user->phone }}" required>
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="sex" class="col-md-4 col-form-label text-md-right">Sexo</label>
                
                                            <div class="col-md-6">
                                                <select name="sex" class="form-control" required>

                                                   @switch($user->sex)
                                                       @case('M')
                                                            <option value="M" selected>Masculino</option>
                                                            <option value="F">Femenino</option>
                                                            <option value="O">Otros</option>
                                                           @break
                                                       @case('F')

                                                       <option value="M">Masculino</option>
                                                       <option value="F" selected>Femenino</option>
                                                       <option value="O">Otros</option>
                                                           
                                                        @break
                                                      @case('O')
                                                      <option value="M">Masculino</option>
                                                      <option value="F">Femenino</option>
                                                      <option value="O" selected>Otros</option>
                                                      @break
                                                           
                                                   @endswitch
                                                </select>
                                            </div>
                                        </div>

                                    <input type="hidden" name="id" value="{{ $user->id }}" >
                
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                   Actualizar Cliente
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        
        </div>

        </div>

</div>





@endsection