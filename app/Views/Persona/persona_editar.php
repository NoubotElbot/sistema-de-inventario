<div class="modal fade" id="persona-editar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Clientes/Provedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Editar a "<?= $nombre . ' ' . $apellido ?>"</h5>
                <?= form_open('persona/update', ['id' => 'persona-editar']) ?>
                <input type="hidden" name="_method" value="PUT" readonly/>
                <input name="id" id="id-edit" type="hidden" class="form-control" value="<?= $id ?>" readonly>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="nombre-edit" class="">Nombre</label>
                            <input name="nombre" id="nombre-edit" placeholder="Ingrese el nombre" type="text" class="form-control" value="<?= $nombre ?>">
                            <div class="invalid-feedback validationNombre">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="apellido-edit" class="">Apellido</label>
                            <input name="apellido" id="apellido-edit" placeholder="Ingrese el apellido" type="text" class="form-control" value="<?= $apellido ?>">
                            <div class="invalid-feedback validationApellido">

                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title">Tipo</h5>
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1-edit" name="tipo" class="custom-control-input tipo-radio" value="1" <?= $tipo == 1 ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="customRadio1-edit">Cliente</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2-edit" name="tipo" class="custom-control-input tipo-radio" value="0" <?= $tipo == 0 ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="customRadio2-edit">Provedor</label>
                            <div class="invalid-feedback validationTipo">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="position-relative form-group company" <?= $tipo == 1 ? 'style="display: none;"' : '' ?>>
                            <label for="company-edit" class="">Nombre Compañia</label>
                            <input type="text" id="company-edit" name="company" class="form-control" <?= $tipo == 1 ? 'disabled' : '' ?> value="<?= $empresa ?>">
                            <div class="invalid-feedback validationCompany">

                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title">Informacion de contacto</h5>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="direccion-edit" class="">Dirección</label>
                            <input type="text" id="direccion-edit" name="direccion" class="form-control" value="<?= $direccion ?>">
                            <div class="invalid-feedback validationDireccion">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="email-edit" class="">Email</label>
                            <input type="email" id="email-edit" name="email" class="form-control" value="<?= $email ?>">
                            <div class="invalid-feedback validationEmail">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="telefono-edit" class="">Telefono</label>
                            <input type="number" id="telefono-edit" name="telefono" class="form-control" value="<?= $telefono ?>">
                            <div class="invalid-feedback validationTelefono">

                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cancelar</button>
                <button form="persona-editar" type="submit" class="btn btn-primary btnsubmit">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('js/Persona/edit.js') ?>" type="text/javascript"></script>