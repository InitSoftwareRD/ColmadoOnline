
require('./bootstrap');

window.Vue = require('vue');




Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('ordenar-component', require('./components/admin/OrdenarComponent.vue').default);



const app = new Vue({
    el: '#app',
});
