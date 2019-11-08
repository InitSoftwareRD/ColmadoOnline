<template>
<div class="container mt-5">  
        <div class="row">
            <div class="col-md-6">
             <table v-if="items" id="productos" class="table table-striped  table-sm table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
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
                                <button class="btn btn-success btn-sm" @click="agregarArticulo(item)"><i class="fas fa-shopping-cart"></i></button>
                            </th>
                        </tr>
                    </tbody>
                </table>
           
            </div>
    <div class="col-md-6">
 
    <div id="carrito"  v-if="carrito">
            <div class="row">
                <div class="col-md-4">
                     <input class="search" placeholder="buscar" />
                </div>

                 <div class="col-md-2">
                      <button v-if="total > 0" class="btn btn-success" @click="modal()" ><i class="fas fa-shopping-bag"></i></button>
                  
                 </div>  
                <div class="col-md-4">
                    <h4 v-if="total > 0" >Total:<span class="badge badge-primary">{{ total }}</span></h4>
                </div>   
                 
                <div class="col-md-2">
                    <button v-if="total > 0" class="btn btn-danger btn-sm" @click="limpiar()"><i class="fas fa-trash-alt"></i> </button>

                </div>
            </div>
            
            

        <table class="table  table-sm table-bordered  mt-2">
                    <thead>
                        <tr>
                        <th scope="col">Articulo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Suma</th>
                        <th>Accion</th>
                        </tr>
                    </thead>
            <tbody class="list" >
                        <tr v-for="(item, key) in carrito" :key="key" >
                        <td class="name">{{ item.name }}</td>
                        <td class="born">{{ item.price }}</td>
                        <td class="accion">
                            <button class="btn btn-info btn-sm" @click=" sumar(item)" >+</button>
                              <input type="number"  min="1" max="999" name="cantidad" size="3" v-model="item.cantidad"
                              readonly>
                            <button class="btn btn-warning btn-sm" @click="restar(item)" >--</button>  

                        </td>
                        <th>{{ item.suma }}</th>
                        <th> <button class="btn btn-danger btn-sm" @click="eliminar(key)"><i class="fas fa-trash-alt"></i></button>
                        </th>
                        </tr>
            </tbody>
         </table>

        
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
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, key) in clientes" :key="key">
                            <td>{{ item.id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.last_name }}</td>
                            <th>{{ item.phone }}</th>
                            <th>
                                <button class="btn btn-success btn-sm" @click="customer = item"><i class="fas fa-user-plus"></i></button>
                            </th>
                        </tr>
                    </tbody>
                </table>
            
                </div>
                <div class="modal-footer">
                    <button v-if="customer" @click="ordenar()" type="button" class="btn btn-success">Ordenar</button>  
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
           this.compras();       

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
        }

       },

       methods: {

           modal(){
              $('#aviso').modal('show')
           },

           ordenar()
           {
                axios.post('realizar_orden',
                  {
                      'carrito':this.carrito,
                      'customer':this.customer,
                      'total':this.total,
                  }
                )
                .then((response)=>{

                         Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Orden registrada correctamente',
                            showConfirmButton: false,
                            timer: 4000
                        })

                        this.carrito = [];
                        $('#aviso').modal('hide')
                
                
                })
                .catch((error)=>{
                  
                       Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Error al realizar Orden',
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


          compras(){
               var options = {
                valueNames: [ 'name', 'born' ]
            };

            var userList = new List('carrito', options);

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
              this.compras();
              this.sumatoria();
           },

           eliminar(key){
                    this.carrito.splice(key,1);
                     this.sumatoria();
                     
                    var options = {
                            valueNames: [ 'key','name', 'born' ]
                        };

                        var userList = new List('carrito', options);        
            },

            mytable()
            {
                $(function () {
                     $('#productos').DataTable();
                  });          
 
            },

            tablaClientes()
            {
                $(function () {
                     $('#clientes').DataTable();
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

</style>
