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
              <form class="m-4" method="POST" action="{{ route('registar-oferta') }}" >
                         @csrf
                        <div class="form-row">
                              <div class="col-md-6 mb-3">
                                    <label for="producto">Producto</label>
                                <select class="form-control  productos" name="producto" required>
                                  <option value=""></option>
                                @foreach ($productos as $producto)

                                <option value="{{ $producto->id }}"> {{ $producto->name  }}------{{ $producto->category['name']  }} </option>
                                    
                                @endforeach
                                </select> 
                              </div>

                              <div class="col-md-6 mb-3">
                                <label for="descuento">Porciento Descuento</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="descuento">%</span>
                                  </div>
                                  <input type="number" class="form-control" id="descuento" name="descuento" placeholder="Porciento Descuento"  value="{{ old('descuento') }}" 
                                  required min="1" max="100" step="1" >
                                </div>
                              </div>

                            </div>


                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="inicio">Fecha Inicio</label>
                                  <input  type="date" class="form-control" id="inicio" name="inicio" 
                                min="{{  date('Y-m-d')  }}"
                                  required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fin">Fecha Fin</label>
                                    <input  type="date" class="form-control" id="fin" name="fin"
                                    min="{{  date('Y-m-d')  }}"
                                    required>
                                  </div>

                               
                              </div>
                              
                            <div class="form-row">
                              <div class="col-md-12 mb-3">
                                <label for="promocion">Texto Promoción</label>
                              <textarea class="form-control" name="promocion" id="" cols="2" rows="2" placeholder="Promoción" required>{{ old('promocion')}}
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