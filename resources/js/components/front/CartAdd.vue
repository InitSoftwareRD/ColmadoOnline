<template>
    <div class="product_item_block">
        <div class="org_product_block">
            <span class="product_label" v-if="product.oferta">{{ product.oferta }}% de descuento</span>
            <div class="org_product_image">
                <img :src="product.imagen_portada"  width="275" height="275">
            </div>
            <h4>{{ product.name }}</h4>

            <h6 v-if="product.oferta" style="text-decoration: line-through;"><small><i class="fa fa-usd" aria-hidden="true"></i></small>{{ product.original_price }}</h6>
            <h3><span><i class="fa fa-usd" aria-hidden="true"></i></span>{{ product.price }}</h3>
            <a style="background-color: #AF0000; color:#fff;" @click="removeCart"v-if="remove == 1" v-show="isAuth">Quiter del carrito</a>
            <a style="color:#fff" @click="addCart" v-else v-show="isAuth">Agregar a carrito</a>
        </div>
    </div>
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
