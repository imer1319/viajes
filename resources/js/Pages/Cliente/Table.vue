<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Listado de Clientes</h5>
            <div>
                <input type="text" placeholder="Buscar por razon social" class="form-control"
                    v-model="search">
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Razon social</th>
                    <th>CUIT</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in filteredClientes" :key="cliente.id">
                    <td>
                        <a href="" @click.prevent="seleccionarCliente(cliente.id)" class="btn btn-primary btn-sm">
                            <i class="fa fa-check"></i>
                        </a>
                    </td>
                    <td>{{ cliente.razon_social }}</td>
                    <td>{{ cliente.cuit }}</td>
                    <td>{{ cliente.telefono }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$store.dispatch("getClientes");
    },
    data() {
        return {
            search: ''
        }
    },
    methods: {
        seleccionarCliente(cliente_id) {
            this.$emit('clienteSelected', cliente_id);
        },
    },
    computed: {
        filteredClientes() {
            const searchTerm = this.search.toLowerCase();
            return this.clientes.filter(cliente =>
                cliente.razon_social.toLowerCase().includes(searchTerm)
            );
        },
        clientes() {
            return this.$store.state.clientes;
        },
    },
}
</script>