<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Listado de tipos de viaje</h5>
            <div>
                <input type="text" placeholder="Buscar por nombre" class="form-control form-control-sm"
                    v-model="search">
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="tipo in filteredTipoViajes" :key="tipo.id">
                    <td>
                        <a href="" @click.prevent="seleccionarTipoViaje(tipo.id)" class="btn btn-primary btn-sm">
                            <i class="fa fa-check"></i>
                        </a>
                    </td>
                    <td>{{ tipo.descripcion }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$store.dispatch("getTipoViajes");
    },
    data() {
        return {
            search: ''
        }
    },
    methods: {
        seleccionarTipoViaje(tipo_id) {
            this.$emit('tipoSelected', tipo_id);
        },
    },
    computed: {
        filteredTipoViajes() {
            const searchTerm = this.search.toLowerCase();
            return this.tipoViajes.filter(tipo =>
                tipo.descripcion.toLowerCase().includes(searchTerm)
            );
        },
        tipoViajes() {
            return this.$store.state.tipoViajes;
        },
    },
}
</script>