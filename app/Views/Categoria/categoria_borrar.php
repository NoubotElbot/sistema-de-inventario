<div class="modal fade" id="categoria-borrar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title"><?= $deleted_at == null ? 'Desactivar' : 'Activar' ?> Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="card-title">¡Atención!</h4>
                <h5>Esta a pundo de <?= $deleted_at == null ? 'Desactivar' : 'Activar' ?> la Categoría:</h5>
                <h5><?=$nombre.' #'.$id?></h5>
                <?= form_open('categoria/delete', ['id' => 'categoria-borrar']) ?>
                <input type="hidden" name="_method" value="DELETE" />
                <input name="id" id="id-edit" type="hidden" class="form-control" value="<?= $id ?>" readonly>
                <button type="button" class="btn btn-warning close-modal" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger btnsubmit">Aceptar</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('js/Categoria/delete.js')?>" type="text/javascript">
</script>