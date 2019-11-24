<template>
    <div class="product_item_block">
        <div class="org_product_block">
            <div class="org_product_image">
                <img :src="product.imagen_portada"  width="275" height="275">
            </div>
            <h4>{{ product.name }}</h4>
            <h3><span><i class="fa fa-usd" aria-hidden="true"></i></span>{{ product.price }}</h3>
            <a @click="removeCart"v-if="remove" v-show="isAuth">Quiter del carrito</a>
            <a @click="addCart" v-else v-show="isAuth">Agregar a carrito</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product', 'isAuth'],
        data() {
            return {
                remove: false
            }
        },
        methods: {
            addCart() {
                window.axios.post('carts', {
                    'product_id': this.product.id,
                    'quantity': 1
                }).then(() => {
                    this.remove = true;
                });
            },
            removeCart() {
                window.axios.delete(`carts/${this.product.id}`).then(() => {
                    this.remove = false;
                });
            }
        }
    }
</script>
