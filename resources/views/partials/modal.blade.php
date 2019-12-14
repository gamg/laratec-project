<div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminando registro</h5>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar éste registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="showSpinner">No</button>
                <button type="button" class="btn btn-danger" @click="deleteIt" :disabled="showSpinner">
                    <span v-if="showSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Sí, estoy seguro
                </button>
            </div>
        </div>
    </div>
</div>
