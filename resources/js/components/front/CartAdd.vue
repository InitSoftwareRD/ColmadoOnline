<template>
    <main>
        <div class="product_item_block">
            <div class="org_product_block">
                <span class="product_label" v-if="product.oferta">{{ product.oferta }}% de descuento</span>
                <div class="org_product_image">
                    <img :src="product.imagen_portada"  width="275" height="275">
                </div>
                <h4>{{ product.name }}</h4>

                <h6 v-if="product.oferta" style="text-decoration: line-through;"><small><i class="fa fa-usd" aria-hidden="true"></i></small>{{ product.original_price }}</h6>
                <h3><span><i class="fa fa-usd" aria-hidden="true"></i></span>{{ product.price }}</h3>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-link" data-toggle="modal" :data-target="'#Modal' + product.id">
                    Ver detalle
                </button>

                <a style="background-color: #AF0000; color:#fff;" @click="removeCart"v-if="remove == 1" v-show="isAuth">Quitar del carrito</a>
                <a style="color:#fff" @click="addCart" v-else v-show="isAuth">Agregar a carrito</a>
            </div>
        </div>
        <div class="modal fade" :id="'Modal' + product.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">{{ product.name }} <strong>${{ product.price }}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="org_product_image">
                            <img :src="product.imagen_portada"  width="275" height="275">
                        </div>
                        <p class="pt-4 font-weight-bold">Categoría:</p>
                        <p>{{ product.category.name }}</p>

                        <p class="font-weight-bold">Descripción:</p>
                        <p>{{ product.description }}</p>

                        <p class="font-weight-bold">Ingredientes</p>
                        <p>{{ product.ingredients }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import toastr from 'toastr';

    export default {
        props: ['product', 'isAuth', 'hasProduct'],
        data() {
            return {
                remove: this.hasProduct
            }
        },
        methods: {
            addCart() {
                window.axios.post('carts', {
                    'product_id': this.product.id,
                    'quantity': 1
                }).then(() => {
                    this.remove = 1;
                    toastr.success(this.product.name + ', Agregado al carrito')
                });
            },
            removeCart() {
                window.axios.delete(`carts/${this.product.id}`).then(() => {
                    this.remove = 0;
                    toastr.info(this.product.name + ', Eliminado del carrito')
                });
            }
        }
    }
</script>
