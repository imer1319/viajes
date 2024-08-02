<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Listado de Flotas</h5>
            <div>
                <input type="text" placeholder="Buscar por nombre" class="form-control form-control-sm"
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
                <tr v-for="flota in filteredFlotas" :key="flota.id">
                    <td>
                        <a href="" @click.prevent="seleccionarFlota(flota.id)" class="btn btn-primary btn-sm">
                            <i class="fa fa-check"></i>
                        </a>
                    </td>
                    <td>{{ flota.nombre }}</td>
                    <td>{{ flota.placa }}</td>
                    <td>{{ flota.anio }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$store.dispatch("getFlotas");
    },
    data() {
        return {
            search: ''
        }
    },
    methods: {
        seleccionarFlota(flota_id) {
            this.$emit('flotaSelected', flota_id);
        },
    },
    computed: {
        filteredFlotas() {
            const searchTerm = this.search.toLowerCase();
            return this.flotas.filter(flota =>
                flota.nombre.toLowerCase().includes(searchTerm)
            );
        },
        flotas() {
            return this.$store.state.flotas;
        },
    },
}
</script>