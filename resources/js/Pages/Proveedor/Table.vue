<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Listado de Proveedores</h5>
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
                <tr v-for="proveedor in filteredProveedores" :key="proveedor.id">
                    <td>
                        <a href="" @click.prevent="seleccionarProveedor(proveedor.id)" class="btn btn-primary btn-sm">
                            <i class="fa fa-check"></i>
                        </a>
                    </td>
                    <td>{{ proveedor.razon_social }}</td>
                    <td>{{ proveedor.cuit }}</td>
                    <td>{{ proveedor.telefono }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$store.dispatch("getProveedores");
    },
    data() {
        return {
            search: ''
        }
    },
    methods: {
        seleccionarProveedor(proveedor_id) {
            this.$emit('proveedorSelected', proveedor_id);
        },
    },
    computed: {
        filteredProveedores() {
            const searchTerm = this.search.toLowerCase();
            return this.proveedores.filter(cliente =>
                cliente.razon_social.toLowerCase().includes(searchTerm)
            );
        },
        proveedores() {
            return this.$store.state.proveedores;
        },
    },
}
</script>