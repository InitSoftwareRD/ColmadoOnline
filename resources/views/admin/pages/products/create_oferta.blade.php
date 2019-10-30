@extends('admin.layout.layout')

@section('title')
    Crear Ofertas
@endsection

@section('css')

<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

@endsection


@section('content')

<div class="row">
    <div class="col-md-12">

            @include('admin.fragment.flashmessage')
        
            <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title text-center">Producto</h3>
                </div>

               @include('admin.fragment.error')

                    <!-- /.card-header -->
                    <!-- form start -->
            <form class="m-4" method="POST" action="{{ route('crear_producto') }}"  enctype="multipart/form-data" >
                         @csrf
                        <div class="form-row">
                              <div class="col-md-4 mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                placeholder="Nombre Producto" value="{{ old('nombre') }}" 
                                onkeyup="javascript:this.value=this.value.toLowerCase();"
                                required>
                              </div>
                              <div class="col-md-4 mb-3">
                                    <label for="nombre">Categoria</label>
                                <select class="categoria form-control" name="categoria">
                                <option>Seleccione una categoria....</option>
                                    @foreach ($categories as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    @endforeach
                                </select> 
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="precio">Precio</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="precio">$</span>
                                  </div>
                                  <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio"  value="{{ old('precio') }}" 
                                  required min="1" max="99999999" step="0.1" value="50.80" >
                                </div>
                              </div>

                            </div>
                            <div class="form-row">
                              <div class="col-md-6 mb-3">
                                <label for="ingredientes">Ingredientes</label>
                              <textarea class="form-control" name="ingredientes" id="ingredientes" cols="30" rows="10" placeholder="Ingredientes" required>{{ old('ingredientes') }}
                            Los mismos de siempre
                            </textarea>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label for="Descripcion">Descripción</label>
                              <textarea class="form-control" name="descripcion" id="" cols="30" rows="10" placeholder="Descripción"required>{{ old('descripcion')}}
                              Los mismo de siempre
                            </textarea>
                              </div>
                        

                            </div>

                            <div class="form-row">
                               <div class="col-md-6">
                                  <label for="portada">Portada</label>
                                  <input type="file" class="form-control" name="portada"  accept="image/png, image/jpeg" required>
                               </div>

                               {{-- <div class="col-md-6">
                                    <label for="secundareas">Imagen Secundarias</label>
                                    <input type="file" class="form-control" name="imagen_segundareas"  accept="image/png, image/jpeg">
                                </div> --}}

                            </div>
                         
                               <br><br>
                            <button class="btn btn-primary btn-block" type="submit">Crear</button>
                          </form>
            </div>

    </div>

</div>

    
@endsection


@section('script')

<script src="{{ asset('plugins/select2/js/select2.min.js')}}"></script>

<script>
$(document).ready(function() {
    $('.categoria').select2();
});

</script>
@endsection