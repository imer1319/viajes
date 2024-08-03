require('./bootstrap');
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import store from './store';

window.Vue = require('vue').default;
Vue.use(ToastPlugin)

Vue.component('movimiento-create', require('./Pages/Movimiento/Create.vue').default);
Vue.component('movimiento-edit', require('./Pages/Movimiento/Edit.vue').default);

const app = new Vue({
    el: '#app',
    store
});
