require('./bootstrap');
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import store from './store';

window.Vue = require('vue').default;
Vue.use(ToastPlugin)

Vue.component('chofer-create', require('./Pages/Chofer/Create.vue').default);
Vue.component('movimiento-create', require('./Pages/Movimiento/Create.vue').default);

const app = new Vue({
    el: '#app',
    store
});
