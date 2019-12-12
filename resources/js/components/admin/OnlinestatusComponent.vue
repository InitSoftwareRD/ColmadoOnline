<template>

<div class="container">  

<div class="row">

  <div class="col-md-12">
    
    <div id="products" class="mt-2">

            <div class="row">
                <div class="col-md-4">
                      <input class="search" placeholder="Buscar" />
               </div>
            </div>

        <table class="table  table-sm table-bordered mt-2">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Email</th>
                        <th scope="col">Total</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Delivery</th>
                        <th>Acciones</th>
                        </tr>
                    </thead>
            <tbody class="list" >
                    <tr v-for="(item, key) in estado" :key="key">
                        <td class="id">{{ item.id }}</td>
                         <td class="nombres">{{ item.nombres }}</td>
                        <td class="celular">{{ item.phone }}</td>
                        <td class="email">{{ item.email }}</td>
                        <td class="total">{{ item.total }}</td>
                        <td class="estatus">{{ item.estatus }}</td>
                        <td class="total">{{ item.delivery }}</td>
                        <th> 
                            <button class="btn btn-success btn-sm" @click="modal(item)" ><i class="fas fa-exchange-alt"></i></button>  
                            <button class="btn btn-success btn-info btn-sm" @click="detalle_orden(item.id)"><i class="fas fa-list-ol"></i></button>                      
                            <button class="btn btn-warning btn-sm" @click="listarDelivery(item.id)" ><i class="fas fa-motorcycle"></i></button>                      
                        </th>
                    </tr>
            </tbody>
         </table>

        
    </div>

  </div>



</div>


<div class="modal" id="Onlinestatus" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Selecciones el siguiente estatus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">

           <select class="form-control" v-model="state" name="status" id="status">
               <option value="">Seleccione un estatus</option>
               <option v-for="(item, key) in lista_estatus" :key="key" :value="item.id">{{ item.name }}</option>  
           </select>

        </div>

        <div v-if="loader" class="loader"></div>


            
      </div>

      <div class="modal-footer">
        <button v-if="state" type="button" class="btn btn-primary" @click="cambiar_estatus()" >Cambiar Estatus</button>  
        <button v-else type="button" class="btn btn-primary" disabled>Cambiar Estatus</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="delivery" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Selecciones el  Delivery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">

           <select class="form-control" v-model="delivery" name="delivery">
               <option value="">Seleccione un Delivery</option>
               <option v-for="(item, key) in deliveries" :key="key" :value="item.id + '|' + item.name + ' ' + item.last_name">{{ item.name + ' ' + item.last_name }}</option>  
           </select>

        </div>

         <div v-if="loader"  class="loader"></div>
            
      </div>

      <div class="modal-footer">
        <button v-if="delivery" type="button" class="btn btn-primary" @click="AsignarDelivery()" >Asignar Delivery</button>  
        <button v-else type="button" class="btn btn-primary" disabled>Asignar Delivery</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="detallesOnline" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalle Orden</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        
         <table id="detalle" class="table table-striped  table-sm  table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, key) in detalle" :key="key">
                            <td>{{ item.id }}</td>
                            <td>{{ item.nombre }}</td>
                            <td>{{ item.cantidad }}</td>
                            <th>{{ item.precio }}</th>
                            <th>{{ item.subtotal }}</th>
                        </tr>
                    </tbody>
            </table>

             <h5 v-if="detalle.length > 0" class="text-info"> Total <strong> ${{ detalle[0].total  }}</strong></h5>
      </div>
      <div class="modal-footer">
          
      </div>
    </div>
  </div>
</div>


</div>


</template>

<script>

 import Swal from 'sweetalert2'
 import datables from 'datatables'


 export default 
 {

     mounted(){
         this.status();
         //this.lista();
     },

     created()
     {
         this.listar_estatus();

     },

     data()
     {
         return{
             estado:[],
             lista_estatus:[],
             state:'',
             orden:'',
             detalle:[],
             deliveries:[],
             delivery:'',
             total:0,
             orden_envio:'',
             loader:false,
             delivery_id:'',
         }

     },

     methods:
     {

        tablaDetalle()
        {
                $(function () {
                     $('#detalle').DataTable({
                       dom: 'Bfrtip',
                        buttons: [
                            'print'
                        ]
                     });
               }); 
        },

         detalle_orden(id)
         {
             this.detalle=[];
             axios.get('detalle_pedido',{
                 params: {
                      id: id
                  }
             })
                .then((response)=>{
                    // handle success
                   this.detalle=response.data;
                   this.tablaDetalle();
                  $('#detallesOnline').modal('show');
                  

                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })
         },
         cambiar_estatus()
         {
           this.loader = true;    
            axios.post('cambiar_status',{ 
                     'order_id':this.orden.id,  
                     'status':this.state,
                 }
                )
                .then((response)=>{

                        this.loader = false;
                        $('#Onlinestatus').modal('hide');
                        
                         Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Orden actulizada',
                            showConfirmButton: false,
                            timer: 5000
                        })
                       
                        this.orden = '';
                        this.state = ' ';
                        this.estado=[];
                        this.status();
                        this.lista();
                
                })
                .catch((error)=>{
                    this.loader =false;
                       Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Error al actulizar Orden',
                            showConfirmButton: false,
                            timer: 4000
                        })
               })
            

         },

         modal(item)
         {
             this.orden = item;
             $('#Onlinestatus').modal('show');
         },

         listarDelivery(item)
         {
            this.orden_envio = item;

            axios.get('deliveries')
                .then((response)=>{
                    // handle success
                   this.deliveries=response.data;
                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })

             $('#delivery').modal('show');

         },

         AsignarDelivery()
         {
           this.delivery_id=this.delivery.substring(0,this.delivery.indexOf('|'));
           this.delivery=this.delivery.substring(this.delivery.indexOf('|') + 1,this.delivery.length);

           this.loader = true;
           axios.post('asignardelivery',{ 
                
                     'order_id':this.orden_envio,  
                     'delivery':this.delivery,
                     'delivery_id':this.delivery_id,
                 }
                )
                .then((response)=>{

                        this.loader = false;
                         $('#delivery').modal('hide');
                         Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Delivery Asignado',
                            showConfirmButton: false,
                            timer: 5000
                        })

                       
                        this.orden = '';
                        this.delivery='';
                        this.delivery_id = '';
                        this.deliveries=[];
                        this.estado=[];
                        this.status();
                
                })
                .catch((error)=>{
                    this.loader =false;
                       Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Error al Asignar Delivery',
                            showConfirmButton: false,
                            timer: 4000
                        })
               })
         },

         lista()
         {
             var options = {
                valueNames: [ 'nombres','estatus']
            };

             var userList = new List('products', options);      

         },

         status()
         {
            axios.get('Onlineordenes')
                .then((response)=>{
                    // handle success
                   this.estado=response.data;

                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })
         },

         listar_estatus()
         {
             axios.get('listar_statusOnline')
                .then((response)=>{
                    // handle success
                   this.lista_estatus=response.data;
                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })
             
         },

     }

 }

</script>

<style>
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