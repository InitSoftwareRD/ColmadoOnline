@extends('admin.layout.layout')

@section('title')
  Editar Oferta
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">

            @include('admin.fragment.flashmessage')
        
            <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title text-center">Editar Oferta</h3>
                </div>

               @include('admin.fragment.error')

                    <!-- /.card-header -->
                    <!-- form start -->
              <form class="m-4" method="POST" action="{{ route('oferta-actulizar') }}" >
                         @csrf
                        <div class="form-row">
                              <div class="col-md-6 mb-3">
                                <label for="descuento">Porciento Descuento</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="descuento">%</span>
                                  </div>
                                  <input type="number" class="form-control" id="descuento" name="descuento" placeholder="Porciento Descuento"   
                                required min="1" max="100" step="1"  value="{{ $oferta->porciento }}">
                                </div>
                              </div>

                              <div class="col-md-6 mb-3">
                                  <label for="promocion">Texto Promoción</label>
                                <textarea class="form-control" name="promocion" id="" cols="2" rows="2" placeholder="Promoción" required>
                                    {{ $oferta->promotion_text }}
                                </textarea>
                             </div>

                            </div>


                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="inicio">Fecha Inicio</label>
                                  <input  type="date" class="form-control" id="inicio" name="inicio" 
                                required value="{{ $oferta->begin_at->format('Y-m-d') }}" >
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fin">Fecha Fin</label>
                                    <input  type="date" class="form-control" id="fin" name="fin"
                                required value="{{ $oferta->end_at->format('Y-m-d') }}">
                                  </div>

                               
                              </div>

                            <input type="hidden" name="id" value="{{ $oferta->id }}" >
                              
                               <br><br>
                            <button class="btn btn-info btn-block" type="submit">Actualizar</button>
                          </form>
            </div>

    </div>

</div>

    
@endsection