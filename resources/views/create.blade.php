<form method="POST" v-on:submit.prevent="createKeeps">
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Tarea</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="keep">Nombre de la Tarea</label>
                <input type="text" name="keep" id="keep" class="form-control" v-model="newKeep">
                <span v-for="error in errors" class="text-danger"> @{{ error }} </span>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </div>
    </div>

</div>
</form>