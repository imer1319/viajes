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
Vue.component('gasto-create', require('./Pages/Gasto/Create.vue').default);
Vue.component('gasto-edit', require('./Pages/Gasto/Edit.vue').default);
Vue.component('liquidacion-create', require('./Pages/Liquidacion/Create.vue').default);
Vue.filter('formatNumber', function (value) {
    if (!value) return '';
    return new Intl.NumberFormat('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(value);
});

// Vue.directive('format-number', {
//     bind(el, binding, vnode) {
//         const $input = $(el);
//         const numberFormatter = new Intl.NumberFormat('id-ID', {
//             minimumFractionDigits: 0,
//             maximumFractionDigits: 0,
//         });
//         function formatNumber(value) {
//             return numberFormatter.format(value);
//         }
//         function parseNumber(value) {
//             return value.replace(/\D/g, '');
//         }
//         $input.on('input', function () {
//             let rawValue = parseNumber($input.val());
//             $input.val(formatNumber(rawValue)); // Actualizar el input con el formato
//             vnode.context.$set(vnode.context.form, 'precio_real', rawValue);
//         });
//         if (vnode.context.form.precio_real) {
//             $input.val(formatNumber(vnode.context.form.precio_real));
//         }
//     }
// });
const app = new Vue({
    el: '#app',
    store
});
