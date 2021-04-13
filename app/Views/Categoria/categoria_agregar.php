<div class="modal fade" id="categoria-agregar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Nueva Categoria</h5>
                <?= form_open('categoria/agregar', ['id' => 'categoria-agregar']) ?>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="position-relative form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input name="nombre" id="nombre" placeholder="Ingrese el nombre de la categoría" type="text" class="form-control">
                            <div class="invalid-feedback validationNombre">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="position-relative form-group">
                            <label for="descripcion" class="">Descripción</label>
                            <textarea name="descripcion" id="descripcion" placeholder="Ingrese una descripción (Opcional)" rows="5" class="form-control"></textarea>
                            <div class="invalid-feedback validationDescripcion">

                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cancelar</button>
                <button form="categoria-agregar" type="submit" class="btn btn-primary btnsubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('js/Categoria/new.js') ?>" type="text/javascript"></script>