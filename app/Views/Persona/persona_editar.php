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
<script type="text/javascript">
    $('.close-modal').mousedown(function(e) {
        document.getElementById("persona-editar").reset();
    });
    $('#customRadio1-edit').click(function(e) {
        $('#company-edit').attr('disabled', 'disable');
        $('.company').hide();
    });
    $('#customRadio2-edit').click(function(e) {
        $('#company-edit').removeAttr('disabled');
        $('.company').show();
    });
    $('#persona-editar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnsubmit').attr('disable', 'disabled');
                $('.btnsubmit').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function() {
                $('.btnsubmit').removeAttr('disable');
                $('.btnsubmit').html('Actualizar')
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.nombre) {
                        $('#nombre-edit').addClass('is-invalid');
                        $('.validationNombre').html(response.error.nombre);
                    } else {
                        $('#nombre-edit').removeClass('is-invalid');
                        $('.validationNombre').html('');
                    }

                    if (response.error.apellido) {
                        $('#apellido-edit').addClass('is-invalid');
                        $('.validationApellido').html(response.error.apellido);
                    } else {
                        $('#apellido-edit').removeClass('is-invalid');
                        $('.validationApellido').html('');
                    }

                    if (response.error.tipo) {
                        $('.tipo-radio').addClass('is-invalid');
                        $('.validationTipo').html(response.error.tipo);
                    } else {
                        $('.tipo-radio').removeClass('is-invalid');
                        $('.validationTipo').html('');
                    }

                    if (response.error.company) {
                        $('#company-edit').addClass('is-invalid');
                        $('.validationCompany').html(response.error.company);
                    } else {
                        $('#company-edit').removeClass('is-invalid');
                        $('.validationCompany').html('');
                    }

                    if (response.error.email) {
                        $('#email-edit').addClass('is-invalid');
                        $('.validationEmail').html(response.error.email);
                    } else {
                        $('#email-edit').removeClass('is-invalid');
                        $('.validationEmail').html('');
                    }

                    if (response.error.telefono) {
                        $('#telefono-edit').addClass('is-invalid');
                        $('.validationTelefono').html(response.error.telefono);
                    } else {
                        $('#telefono-edit').removeClass('is-invalid');
                        $('.validationTelefono').html('');
                    }

                    if (response.error.direccion) {
                        $('#direccion-edit').addClass('is-invalid');
                        $('.validationDireccion').html(response.error.direccion);
                    } else {
                        $('#direccion-edit').removeClass('is-invalid');
                        $('.validationDireccion').html('');
                    }
                } else {
                    $("#persona-editar-modal").modal('hide');
                    $('.cuadro-alertas').show();
                    $('.alert ').html(response.success).removeAttr('class').addClass('alert alert-success');
                    table.ajax.reload(null, false);
                }
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    })
</script>