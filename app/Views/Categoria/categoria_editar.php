<div class="modal fade" id="categoria-editar-modal" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Editar Categoria N°<?= $id ?></h5>
                <?= form_open("categoria/update", ['id' => 'categoria-editar']) ?>
                <input type="hidden" name="_method" value="PUT" />
                <input name="id" id="id-edit" type="hidden" class="form-control" value="<?= $id ?>" readonly>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="position-relative form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input name="nombre" id="nombre-edit" placeholder="Ingrese el nombre de la categoría" type="text" class="form-control" value="<?= $nombre ?>">
                            <div class="invalid-feedback validationNombre">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="position-relative form-group">
                            <label for="descripcion" class="">Descripción</label>
                            <textarea name="descripcion" id="descripcion-edit" placeholder="Ingrese una descripción (Opcional)" rows="5" class="form-control"><?= $descripcion ?></textarea>
                            <div class="invalid-feedback validationDescripcion">

                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cancelar</button>
                <button form="categoria-editar" type="submit" class="btn btn-primary btnsubmit-edit">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('js/Categoria/edit.js') ?>" text="text/javascript"></script>