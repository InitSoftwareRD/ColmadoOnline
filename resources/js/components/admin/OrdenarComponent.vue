<template>
<div class="container mt-5">  
        <div class="row">
            <div class="col-md-6">
             <table v-if="items" id="productos" class="table table-striped  table-sm table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, key) in items" :key="key">
                            <th><img v-bind:src="item.ruta" width="40" height="40" ></th>
                            <td>{{ item.name }}</td>
                            <td>{{ item.category}}</td>
                            <th>{{ item.price }}</th>
                            <th>
                                <button class="btn btn-success btn-sm" @click="agregarArticulo(item)" title="Agregar al carrito"><i class="fas fa-shopping-cart"></i></button>
                            </th>
                        </tr>
                    </tbody>
                </table>
           
            </div>
    <div class="col-md-6">
 
    <div id="carrito"  v-if="carrito">

        
        <table class="table  table-sm table-bordered  mt-2">
                    <thead>
                        <tr>
                        <th scope="col">Artículo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Suma</th>
                        <th>Acción</th>
                        </tr>
                    </thead>
            <tbody>
                        <tr v-for="(item, key) in carrito" :key="key" >
                        <td>{{ item.name }}</td>
                        <td>{{ item.price }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" @click=" sumar(item)" title="Aumentar">+</button>
                              <input type="number"  min="1" max="999" name="cantidad" size="3" v-model="item.cantidad"
                              readonly>
                            <button class="btn btn-warning btn-sm" @click="restar(item)" title="Disminuir">--</button>  

                        </td>
                        <th>{{ item.suma }}</th>
                        <th> <button class="btn btn-danger btn-sm" @click="eliminar(key)" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                        </th>
                        </tr>
            </tbody>
         </table>



           <div class="row">
                 <div class="col-md-4">
                      <button v-if="total > 0" class="btn btn-success" @click="modal()" title="Realizar orden"><i class="fas fa-shopping-bag"></i></button>
                  
                 </div>  
                <div class="col-md-4">
                    <h4 v-if="total > 0" >Total:<span class="badge badge-primary">{{ total }}</span></h4>
                </div>   
                 
                <div class="col-md-4">
                    <button v-if="total > 0" class="btn btn-danger btn-sm" @click="limpiar()" title="Eliminar todo"><i class="fas fa-trash-alt"></i> </button>

                </div>
            </div>

        
    </div>
                 

        </div>

        </div>


<div id="modal" >
            <!-- Modal -->
            <div class="modal fade" id="aviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cliente:
                          <strong class="text-primary" v-if="customer">{{ customer.name }} {{ customer.last_name }}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" @click="customer ='' " aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

         <table id="clientes" class="table table-striped  table-sm table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Teléfono</th>
                            <th>ID</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, key) in clientes" :key="key">
                            <td>{{ item.name }}</td>
                            <td>{{ item.last_name }}</td>
                            <th>{{ item.phone }}</th>
                            <th>{{ item.identificador }}</th>
                            <th>
                                <button class="btn btn-success btn-sm" @click="customer = item" title="Elegir cliente"><i class="fas fa-user-plus"></i></button>
                            </th>
                        </tr>
                    </tbody>
                </table>

            <div v-if="loader" class="loader"></div>    
            
                </div>
                <div class="modal-footer">
                    <button v-if="customer" @click="ordenar()" type="button" class="btn btn-success" title="Ordenar">Ordenar</button>  
                    <button v-else type="button" class="btn btn-success" disabled>Ordenar</button>    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="customer ='' " >Cerrar</button>
                </div>
                </div>
            </div>
        </div>
</div>

   
      </div>



</template>

<script>

    import datables from 'datatables'
   import Swal from 'sweetalert2'


    export default {
        mounted() {

           this.getProductos(); 

        },

        created(){
              this.getClientes();
        },

       data()
       {
           return {
            items: [],
            carrito:[],
            clientes:[],
            customer:'',
            total:0,
            loader:false,
        }

       },

       methods: {

           modal(){
              $('#aviso').modal('show')
           },

           ordenar()
           {
               this.loader = true;
                axios.post('realizar_orden',
                  {
                      'carrito':this.carrito,
                      'customer':this.customer,
                      'total':this.total,
                  }
                )
                .then((response)=>{

                      this.loader =false;
                      $('#aviso').modal('hide');

                         Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Orden registrada correctamente',
                            showConfirmButton: false,
                            timer: 4000
                        })

                        this.carrito = [];
                        this.total = 0;
                
                
                })
                .catch((error)=>{
                       this.loader =false;
                       Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Error al realizar la orden',
                            showConfirmButton: false,
                            timer: 4000
                        })
               })
                
           },

           limpiar(){
                this.carrito = [];
                this.sumatoria();
           },


           sumar(item)
           {
               item.cantidad++
               item.suma =  (item.cantidad * item.price);
               this.sumatoria();

           },

           restar(item){

               if(item.cantidad > 1){
                   item.cantidad--
                   item.suma =  (item.cantidad * item.price);
                   this.sumatoria();
               }


           },

           sumatoria(){
                    this.total=0;
                    
                     for(let item of this.carrito)
                     {
                         this.total = this.total  + item.suma;
                     }
           },


       
           
           agregarArticulo(item)
           {
              this.carrito.push({
                 id:item.id, 
                 name:item.name,
                 price:item.price,
                 cantidad:1,
                 suma:item.price,

              });  
              this.sumatoria();
           },

           eliminar(key){
                
                    this.carrito.splice(key,1);
                     this.sumatoria();      
            },

            mytable()
            {
                $(function () {
                     $('#productos').DataTable({
                          "language":{
                                "sProcessing": "Procesando..."
                                , "sLengthMenu": "Mostrar _MENU_ registros"
                                , "sZeroRecords": "No se encontraron resultados"
                                , "sEmptyTable": "Ningún dato disponible en esta tabla"
                                , "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros"
                                , "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros"
                                , "sInfoFiltered": "(filtrado de un total de _MAX_ registros)"
                                , "sInfoPostFix": ""
                                , "sSearch": "Buscar:"
                                , "sUrl": ""
                                , "sInfoThousands": ","
                                , "sLoadingRecords": "Cargando..."
                                , "oPaginate": {
                                    "sFirst": "Primero"
                                    , "sLast": "Último"
                                    , "sNext": "Siguiente"
                                    , "sPrevious": "Anterior"
                                }
                                , "oAria": {
                                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                                    , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                            }
                        });
                  });          
 
            },

            tablaClientes()
            {
                $(function () {
                     $('#clientes').DataTable({
                          "language":{
                                "sProcessing": "Procesando..."
                                , "sLengthMenu": "Mostrar _MENU_ registros"
                                , "sZeroRecords": "No se encontraron resultados"
                                , "sEmptyTable": "Ningún dato disponible en esta tabla"
                                , "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros"
                                , "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros"
                                , "sInfoFiltered": "(filtrado de un total de _MAX_ registros)"
                                , "sInfoPostFix": ""
                                , "sSearch": "Buscar:"
                                , "sUrl": ""
                                , "sInfoThousands": ","
                                , "sLoadingRecords": "Cargando..."
                                , "oPaginate": {
                                    "sFirst": "Primero"
                                    , "sLast": "Último"
                                    , "sNext": "Siguiente"
                                    , "sPrevious": "Anterior"
                                }
                                , "oAria": {
                                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                                    , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                            }
                        });
               }); 
            },

            getProductos(){

            axios.get('listar_productos')
                .then((response)=>{
                    // handle success
                   this.items=response.data;
                   this.mytable();
                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })

            },

            getClientes()
            {
                axios.get('listar_clientes')
                .then((response)=>{
                    // handle success
                   this.clientes=response.data;
                   this.tablaClientes();
                
                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })

            }

           },



       }
</script>

<style>

input[type="number"] {
   width:50px;
}

#carrito
{
    border-style:solid;
    background: #ffffff
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 70px;
  height: 70px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


</style>


