<template>
  
<div class="container">

  <div class="row" v-if="loader" >
     <div class="col-md-6">

     </div>
      <div class="col-md-6 mb-6">
         <div class="loader"></div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12">
           
                  
       <div class="table-responsive">

                    
              <table id="envios" class="table table-striped table-reponsive">
              <thead class="thead-dark" >
                <tr>
                  <th scope="col">Cliente</th>
                  <th scope="col">Celular</th>
                  <th scope="col">Total</th>
                  <th scope="col">Dinero</th>
                  <th scope="col">Devuelta</th>
                  <th scope="col">Locación</th>
                  <th scope="col">Pin</th>
                  <th scope="col">Delivery</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, key) in ordenes" :key="key" >
                  <th>{{ item.nombres }}</th>
                  <th> {{ item.phone }} </th>
                  <th>{{ item.total }}</th>
                  <th> {{ item.pagado }}</th>
                  <th>{{ item.devuelta  }}</th>
                  <th> <a :href=" 'https://maps.google.com/?q=' + item.ubicacion " target="_blank" ><i class="fas fa-map-marked-alt"></i></a> </th>
                  <th> {{ item.ping }}</th>
                  <th> {{ item.delivery }}</th>
                  <th>  
                    <button class="btn btn-success btn-info btn-sm" @click="detalle_orden(item.id)"><i class="fas fa-list-ol"></i></button>  
                    <button class="btn btn-success btn-sm" @click="confirmacion(item.id)"><i class="fas fa-check-circle"></i></button>
                  </th>
                </tr>
            </tbody>
            </table>

      </div>

      </div>

  </div>




<div class="modal" id="detalles" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalle Orden</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
         
         <table class="table table-striped  table-sm  table-bordered">
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
    export default {

      mounted(){
           this.envios();
      },
   
      data()
     {
         return{
             ordenes:[],
             detalle:[],
             loader:false,          
         }

     },

     methods:
     {

        envios()
         {
             this.detalle=[];
             axios.get('ordenes_salientes')
                .then((response)=>{
                    // handle success
                   this.ordenes=response.data;
                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })
         },

         detalle_orden(id)
         {
             this.detalle=[];
             axios.get('detalle_envio',{
                 params: {
                      id: id
                  }
             })
                .then((response)=>{
                    // handle success
                  this.detalle=response.data;
                  $('#detalles').modal('show');
                  

                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })
         },

         confirmacion(item)
         {
            Swal.fire({
                title: '¿Realmente Quiere Finalizar la Orden?',
                text: "(No vas a poder revertirlo una vez hecho)",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Finalizar!'
          }).then((result) => {
                      if (result.value) {
                         
                         this.finalizar(item);
                         
                     }
          })

         },

         finalizar(item)
         {    
               this.loader = true;
                axios.post('cambiar_envios',{ 
                
                     'order_id':item,  
                     'status':3,
                 }
                )
                .then((response)=>{

                        this.loader =false;
                         Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Orden Finalizada',
                            showConfirmButton: false,
                            timer: 5000
                        })
                      
                      this.ordenes=[];
                      this.envios();
                })
                .catch((error)=>{
                   this.loader =false;
                       Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Error al finalizar la orden',
                            showConfirmButton: false,
                            timer: 4000
                        })
               })
            


         },

    
     },

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
