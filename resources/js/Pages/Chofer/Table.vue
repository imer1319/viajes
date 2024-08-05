<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Listado de Choferes</h5>
            <div>
                <input type="text" placeholder="Buscar por nombre" class="form-control"
                    v-model="search">
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="chofer in filteredChoferes" :key="chofer.id">
                    <td>
                        <a href="" @click.prevent="seleccionarChofer(chofer.id)" class="btn btn-primary btn-sm">
                            <i class="fa fa-check"></i>
                        </a>
                    </td>
                    <td>{{ chofer.nombre }}</td>
                    <td>{{ chofer.dni }}</td>
                    <td>{{ chofer.saldo }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$store.dispatch("getChoferes");
    },
    data() {
        return {
            search: ''
        }
    },
    methods: {
        seleccionarChofer(chofer_id) {
            this.$emit('choferSelected', chofer_id);
        },
    },
    computed: {
        filteredChoferes() {
            const searchTerm = this.search.toLowerCase();
            return this.choferes.filter(chofer =>
                chofer.nombre.toLowerCase().includes(searchTerm)
            );
        },
        choferes() {
            return this.$store.state.choferes;
        },
    },
}
</script>