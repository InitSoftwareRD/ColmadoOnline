<template>
    <span>({{ count }})</span>
</template>

<script>
    export default {
        name: "CartCount.vue",
        data() {
            return {
                count: 0
            }
        },
        created() {
            setInterval(() => this.getCount(), 1000);
        },
        methods: {
            getCount() {
                axios.get('carts/count').then((response) => {
                   this.count = response.data;
                });
            }
        }
    }
</script>
