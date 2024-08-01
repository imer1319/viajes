<template>
    <div class="modal fade" :id="modal_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel"> {{ titulo }} </h5>
                    <button type="button" class="close" @click="cerrarModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal">Cancelar</button>
                    <button v-if="show_action" type="button" class="btn btn-primary" @click="guardarCambios">Guardar
                        cambios</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['titulo', 'size', 'show_action', 'modal_id'],
    methods: {
        guardarCambios() {
            this.$emit('guardar');
        },
        cerrarModal() {
            this.$emit('cerrarModal');
        }
    }
}
</script>