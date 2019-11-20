@extends('admin.layout.layout')

@section('title')
   Ofertas
@endsection



@section('content')

<div class="row">
    <div class="col-md-12">

            @include('admin.fragment.flashmessage')
        
            <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title text-center">Ofertas</h3>
                </div>

               @include('admin.fragment.error')

                    <!-- /.card-header -->
                    <!-- form start -->
            <form class="m-4" method="POST" action="" >
                         @csrf
                        <div class="form-row">
                              <div class="col-md-4 mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                placeholder="Nombre Oferta" value="{{ old('nombre') }}" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();"
                                required>
                              </div>
                              <div class="col-md-4 mb-3">
                                    <label for="nombre">Producto</label>
                                <select class="form-control" name="productos">
                                <option>Seleccione una categoria....</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">2</option>
                                <option value="">6</option>
                                <option value="">8</option>
                                </select> 
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="precio">Porciento Descuento</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="precio">%</span>
                                  </div>
                                  <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio"  value="{{ old('precio') }}" 
                                  required min="1" max="100" step="1" >
                                </div>
                              </div>

                            </div>


                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="nombre">Fecha Inicio</label>
                                  <input  type="datetime-local" class="form-control" id="nombre" name="nombre">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nombre">Fecha Fin</label>
                                    <input  type="datetime-local" class="form-control" id="nombre" name="nombre">
                                  </div>

                               
                              </div>
                              
                            <div class="form-row">
                              <div class="col-md-12 mb-3">
                                <label for="Descripcion">Texto Promoción</label>
                              <textarea class="form-control" name="descripcion" id="" cols="2" rows="2" placeholder="Descripción"required>{{ old('descripcion')}}
                            </textarea>
                              </div>
                        

                            </div>      
                               <br><br>
                            <button class="btn btn-primary btn-block" type="submit">Crear</button>
                          </form>
            </div>

    </div>

</div>

    
@endsection


@section('script')

<script>
$(document).ready(function() {
    $('.productos').select2();
});

</script>

@endsection