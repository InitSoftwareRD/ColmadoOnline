            <!-- Modal -->
        <div class="modal fade" id="producto{{ $producto->id  }}" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                <div class="row">
                      <div class="col-md-12">

                            <form class="m-4" method="POST" action="{{ route('crear_producto') }}"  enctype="multipart/form-data" >
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
                                       <option>Seleccione una categoria....</option>
                                           @foreach ($categorias as $categoria)
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
                                         <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio"  value={{ $producto->precio }}
                                         required min="1" max="99999999" step="0.1" value="50.80" >
                                       </div>
                                     </div>
        
                                   </div>
                                   <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                       <label for="ingredientes">Ingredientes</label>
                                     <textarea class="form-control" name="ingredientes" id="ingredientes" cols="30" rows="10" placeholder="Ingredientes" required>
                                            {{ $producto->ingredients }}
                                   </textarea>
                                     </div>
        
                                     <div class="col-md-6 mb-3">
                                       <label for="Descripcion">Descripción</label>
                                     <textarea class="form-control" name="descripcion" id="" cols="30" rows="10" placeholder="Descripción"required>
                                            {{ $producto->description }}
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Actualizar</button>
            </div>
          </div>
        </div>
      </div>