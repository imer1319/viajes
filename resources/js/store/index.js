import Vue from 'vue';
import Vuex from 'vuex';
import liquidaciones from './modules/liquidaciones';
import recibos from './modules/recibos';
import facturas from './modules/facturas';
import movimientos from './modules/movimientos';
Vue.use(Vuex);

import state from "./state";
import * as getters from "./getters"
import * as actions from "./actions"
import * as mutations from "./mutations"

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
    modules: {
        liquidaciones,
        recibos,
        facturas,
        movimientos,
    }
})