
require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('ordenar-component', require('./components/admin/OrdenarComponent.vue').default);
Vue.component('status-component', require('./components/admin/StatusComponent.vue').default);
Vue.component('cart-add', require('./components/front/CartAdd').default);


const app = new Vue({
    el: '#app',
});
