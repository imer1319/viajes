import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
export default {
    namespaced: true,
    state: {
        chofer: {},
        form: {
            id: "",
            fecha: "",
            chofer_id: "",
            numero_interno: "",
            observaciones: "",
            total_liquidacion: "",
            movimientos: [],
            gastos: [],
            anticipos: [],
        },
    },
    getters: {
        
    },
    mutations: {

    },
    actions: {

    }
}