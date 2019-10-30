<template>
<div class="container mt-5">  
        <div class="row">
            <div class="col-md-6">
            <table v-if="items" id="productos" class="table table-striped  table-sm table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, key) in items" :key="key">
                            <td>{{ item.name }}</td>
                            <td>{{ item.category_id }}</td>
                            <th>{{ item.price }}</th>
                            <th>
                                <button class="btn btn-success btn-sm" @click="agregar(key)"><i class="fas fa-shopping-cart"></i></button>
                            </th>
                        </tr>
                    </tbody>
                </table>
           
            </div>
    <div class="col-md-6">
 
         <div id="carrito"  v-if="carrito">
            <input class="search" placeholder="Lista" />
            <table>
                <!-- IMPORTANT, class="list" have to be at tbody -->
                <tbody class="list">
                <tr v-for="(item, key) in carrito" :key="key">
                    <td class="name">{{ key }}</td>
                    <td class="name">{{ item.nombre }}</td>
                    <td class="born">{{ item.Fecha }}</td>
                    <td class="accion">
                      <button class="btn btn-danger btn-sm" @click="eliminar(key)"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
        </table>

    </div>
                 

        </div>

        </div>
  
      </div>
</template>

<script>



    export default {
        mounted() {
            window.onload = function () {
            var options = {
                valueNames: [ 'name', 'born' ]
            };

            var userList = new List('carrito', options);

               $('#productos').DataTable();
        }

         axios.get('listar_productos')
                .then((response)=>{
                    // handle success
                   this.items=response.data;
                })
                .catch((error)=> {
                    // handle error
                    console.log(error);
        })
        },

        created(){
            $('#productos').DataTable();
        },

       data()
       {
           return {
            items: [],
            carrito:[],
            data:'',
           }

       },

       methods: {
           
           agregar(key)
           {
            
                    this.carrito.push({nombre:key,Fecha:'2006'});
                    
                var options = {
                        valueNames: [ 'name', 'born' ]
                    };

                    var userList = new List('carrito', options);
           },

           eliminar(key){
                        this.carrito.splice(key,1);
                    var options = {
                            valueNames: [ 'key','name', 'born' ]
                        };

                        var userList = new List('carrito', options);
            },
           }

       }
</script>

<style>

.list {
  font-family:sans-serif;
}
td {
  padding:10px; 
  border:solid 1px #eee;
}

input {
  border:solid 1px #ccc;
  border-radius: 5px;
  padding:7px 14px;
  margin-bottom:10px
}
input:focus {
  outline:none;
  border-color:#aaa;
}
.sort {
  padding:8px 30px;
  border-radius: 6px;
  border:none;
  display:inline-block;
  color:#fff;
  text-decoration: none;
  background-color: #28a8e0;
  height:30px;
}
.sort:hover {
  text-decoration: none;
  background-color:#1b8aba;
}
.sort:focus {
  outline:none;
}
.sort:after {
  display:inline-block;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid transparent;
  content:"";
  position: relative;
  top:-10px;
  right:-5px;
}
.sort.asc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid #fff;
  content:"";
  position: relative;
  top:4px;
  right:-5px;
}
.sort.desc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #fff;
  content:"";
  position: relative;
  top:-4px;
  right:-5px;
}

</style>
