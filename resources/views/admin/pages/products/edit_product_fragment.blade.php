@extends('admin.layout.layout')

@section('title')
    Editar Productos
@endsection


@section('content')
    <form class="m-4" method="POST" action="{{ route('actualizar-producto') }}" enctype="multipart/form-data">
                            @csrf
                           <div class="form-row">

                                 <div class="col-md-4 mb-3">
                                   <label for="nombre">Nombre</label>
                                   <input type="text" class="form-control" id="nombre" name="nombre"
                                 placeholder="Nombre Producto" value="{{ $producto->name }}"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"
                                   required>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                   <label for="nombre">Categoria</label>
                                   <select class="categoria form-control" name="categoria">
                                       @foreach($categorias as $categoria)

                                       @if( $categoria->name == $producto->category['name'] )

                                       <option  selected value="{{ $categoria->id }}">{{ $categoria->name }}</option>

                                       @else

                                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                       @endif

                                       @endforeach
                                   </select>
                                 </div>

                                 <div class="col-md-4 mb-3">
                                   <label for="precio">Precio</label>
                                   <div class="input-group">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" >$</span>
                                     </div>
                                     <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio"  value="{{ $producto->price }}"
                                     required min="1" max="99999999" step="0.1" >
                                   </div>
                                 </div>

                               </div>

                               <div class="form-row">
                                 <div class="col-md-6 mb-3">
                                   <label for="ingredientes">Ingredientes</label>
                                 <textarea class="form-control"  name="ingredientes" id="ingredientes" cols="5" rows="5" placeholder="Ingredientes" required>
                                        {{ $producto->ingredients }}
                               </textarea>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                   <label for="Descripcion">Descripción</label>
                                 <textarea class="form-control" name="descripcion" id="" cols="5" rows="5" placeholder="Descripción" required>
                                        {{ $producto->description }}
                               </textarea>
                                 </div>


                               </div>


                               <div class="form-row">
                                  <div class="col-md-6">
                                     <label for="portada">Portada</label>
                                      <br>
                                      <img src=" {{  asset($producto->images->first()->ruta) }} "  class="img-fluid"/>
                                      <input type="file" class="form-control" name="portada"  accept="image/png, image/jpeg">
                                  </div>

                               </div>

                              <input type="hidden" name="id" value="{{ $producto->id }}" >
                              <input type="hidden" name="imagen" value="{{ $producto->images->first()->id }}" >

                               <br>
                               <br>
                              <button class="btn btn-primary btn-block" type="submit">Actualizar</button>

  </form>

@endsection

