<div class="modal fade" id="persona-agregar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Clientes/Provedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Nuevo Cliente/Provedor</h5>
                <?= form_open('persona/agregar', ['id' => 'persona-agregar']) ?>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input name="nombre" id="nombre" placeholder="Ingrese el nombre" type="text" class="form-control">
                            <div class="invalid-feedback validationNombre">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="apellido" class="">Apellido</label>
                            <input name="apellido" id="apellido" placeholder="Ingrese el apellido" type="text" class="form-control">
                            <div class="invalid-feedback validationApellido">

                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title">Tipo</h5>
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="tipo" class="custom-control-input tipo-radio" value="1">
                            <label class="custom-control-label" for="customRadio1">Cliente</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="tipo" class="custom-control-input tipo-radio" value="0">
                            <label class="custom-control-label" for="customRadio2">Provedor</label>
                            <div class="invalid-feedback validationTipo">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="position-relative form-group company" style="display: none;">
                            <label for="company" class="">Nombre Compañia</label>
                            <input type="text" id="company" name="company" class="form-control" disabled>
                            <div class="invalid-feedback validationCompany">

                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title">Informacion de contacto</h5>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="direccion" class="">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control">
                            <div class="invalid-feedback validationDireccion">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="email" class="">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                            <div class="invalid-feedback validationEmail">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="telefono" class="">Telefono</label>
                            <input type="number" id="telefono" name="telefono" class="form-control">
                            <div class="invalid-feedback validationTelefono">

                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cancelar</button>
                <button form="persona-agregar" type="submit" class="btn btn-primary btnsubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('js/Persona/new.js') ?>" type="text/javascript"></script>