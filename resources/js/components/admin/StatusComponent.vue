<template>

<div class="container">  

    <div class="row">
         <div class="col-md-12">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ordenes Entrantes
                     <h4 class="badge badge-danger">9</h4>
                </a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ordenes Internas
                     <h4 class="badge badge-danger">9</h4>
                </a>
            </div>
          </nav>

         </div>

    </div>

<div class="row">

  <div class="col-md-12">

<div class="tab-content"  id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    
    <div id="orden" class="mt-2">
            <div class="row">
                <div class="col-md-4">
                     <input class="search" placeholder="Buscar" />
                      <button class="sort btn-primary btn-sm" data-sort="name">Name</button>
                      <button class="sort btn-primary btn-sm" data-sort="born">Born</button>
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
                        <th>Acciiones</th>
                        </tr>
                    </thead>
            <tbody class="list" >
                    <tr v-for="(item, key) in estado" :key="key">
                        <td class="name">{{ item.id }}</td>
                         <td class="accion">{{ item.nombres }}</td>
                        <td class="born">{{ item.phone }}</td>
                        <td class="born">{{ item.email }}</td>
                        <td class="born">{{ item.total }}</td>
                        <td class="born">{{ item.estatus }}</td>
                        <th> 
                            <button class="btn btn-success btn-sm" @click="modal()" ><i class="fas fa-exchange-alt"></i></button> 
                            <button class="btn btn-success btn-info btn-sm"><i class="fas fa-list-ol"></i></button>                         
                        </th>
                    </tr>
            </tbody>
         </table>

        
    </div>

  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
     
  </div>

</div>


</div>

</div>


<div class="modal" id="status" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <select name="status" id="status">
               <option  v value=""  > </option>
                 
           </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Cambiar Estatus</button>
      </div>
    </div>
  </div>
</div>

</div>


</template>

<script>

 import Swal from 'sweetalert2'

 export default 
 {

     mounted(){
         this.lista();
         this.status();

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
         }

     },

     methods:
     {
         modal()
         {
             $('#status').modal('show');
         },

         lista()
         {
             var options = {
                valueNames: [ 'name', 'born' ]
            };

             var userList = new List('orden', options);      

         },

         status()
         {
            axios.get('ordenes')
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
             axios.get('listar_status')
                .then((response)=>{
                    // handle success
                   this.lista_estatus=response.data;
                   console.log(this.lista_estatus);
                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
               })
             
         }

     }

 }

</script>