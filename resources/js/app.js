require('./bootstrap');
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import 'vue-select/dist/vue-select.css';
import store from './store';
import vSelect from 'vue-select'

window.Vue = require('vue').default;
Vue.use(ToastPlugin)

Vue.component('v-select', vSelect)
Vue.component('movimiento-create', require('./Pages/Movimiento/Create.vue').default);
Vue.component('movimiento-edit', require('./Pages/Movimiento/Edit.vue').default);
Vue.component('cliente-create', require('./Pages/Cliente/Create.vue').default);
Vue.component('cliente-edit', require('./Pages/Cliente/Edit.vue').default);
Vue.component('proveedor-create', require('./Pages/Proveedor/Create.vue').default);
Vue.component('proveedor-edit', require('./Pages/Proveedor/Edit.vue').default);
Vue.component('flota-create', require('./Pages/Flota/Create.vue').default);
Vue.component('flota-edit', require('./Pages/Flota/Edit.vue').default);
Vue.component('chofer-create', require('./Pages/Chofer/Create.vue').default);
Vue.component('chofer-edit', require('./Pages/Chofer/Edit.vue').default);
Vue.component('anticipo-create', require('./Pages/Anticipo/Create.vue').default);
Vue.component('anticipo-edit', require('./Pages/Anticipo/Edit.vue').default);

const app = new Vue({
    el: '#app',
    store
});
