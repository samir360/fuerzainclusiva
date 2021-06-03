<div class="modal" tabindex="-1" role="dialog" id="modal-deleted-{{$id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Estás seguro de eliminar el registro seleccionado ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-deleted" data-id="{{$id}}">Si, Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancelar</button>
            </div>
        </div>
    </div>
</div>