<div class="modal fade" id="usuario-editar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Editar Usuario "<?= $username ?>"</h5>
                <?= form_open('usuario/update', ['id' => 'usuario-editar']) ?>
                <input type="hidden" name="_method" value="PUT" />
                <input name="id" id="id-edit" type="hidden" class="form-control" value="<?= $id ?>" readonly>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input name="nombre" id="nombre-edit" placeholder="Ingrese el Nombre" type="text" class="form-control" value="<?= $nombre ?>">
                            <div class="invalid-feedback validationNombre">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="apellido" class="">Apellido</label>
                            <input name="apellido" id="apellido-edit" placeholder="Ingrese el Apellido" type="text" class="form-control" value="<?= $apellido ?>">
                            <div class="invalid-feedback validationApellido">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="email" class="">Email</label>
                            <input name="email" id="email-edit" placeholder="Ingrese Nombre de Usuario" type="email" class="form-control" value="<?= $email ?>">
                            <div class="invalid-feedback validationEmail">

                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title mt-3">Cambiar Contraseña</h5>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check-pass" name="check-pass">
                            <label class="form-check-label" for="check-pass">
                                Cambiar Contraseña
                            </label>
                        </div>
                    </div>
                </div>
                <fieldset id="passwords-inputs" disabled>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password" class="">Contraseña Actual</label>
                                <input name="password" id="password-edit" placeholder="Ingrese su Contraseña Actual" type="password" class="form-control">
                                <div class="invalid-feedback validationPassword">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="new_password" class="">Nueva Contraseña</label>
                                <input name="new_password" id="new_password" placeholder="Ingrese su Contraseña Nueva" type="password" class="form-control">
                                <div class="invalid-feedback validationNewPassword">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password_confirm" class="">Confirme Contraseña</label>
                                <input name="password_confirm" id="password_confirm-edit" placeholder="" type="password" class="form-control">
                                <div class="invalid-feedback validationPasswordConfirm">

                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button form="usuario-editar" type="submit" class="btn btn-primary btnsubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#check-pass').click(function(e) {
        if ($(this).is(':checked')) {
            $('#passwords-inputs').removeAttr('disabled')
        } else {
            $('#passwords-inputs').attr('disabled', 'disable')
        }
    });
    $('#usuario-editar').submit(function(e) {
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
                $('.btnsubmit').html('Guardar')
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
                    if (response.error.username) {
                        $('#username-edit').addClass('is-invalid');
                        $('.validationUsername').html(response.error.username);
                    } else {
                        $('#username-edit').removeClass('is-invalid');
                        $('.validationUsername').html('');
                    }
                    if (response.error.email) {
                        $('#email-edit').addClass('is-invalid');
                        $('.validationEmail').html(response.error.email);
                    } else {
                        $('#email-edit').removeClass('is-invalid');
                        $('.validationEmail').html('');
                    }
                    if (response.error.password) {
                        $('#password-edit').addClass('is-invalid');
                        $('.validationPassword').html(response.error.password);
                    } else {
                        $('#password-edit').removeClass('is-invalid');
                        $('.validationPassword').html('');
                    }
                    if (response.error.new_password) {
                        $('#new_password').addClass('is-invalid');
                        $('.validationNewPassword').html(response.error.new_password);
                    } else {
                        $('#new_password').removeClass('is-invalid');
                        $('.validationNewPassword').html('');
                    }
                    if (response.error.password_confirm) {
                        $('#password_confirm-edit').addClass('is-invalid');
                        $('.validationPasswordConfirm').html(response.error.password_confirm);
                    } else {
                        $('#password_confirm-edit').removeClass('is-invalid');
                        $('.validationPasswordConfirm').html('');
                    }
                } else {
                    $("#usuario-editar-modal").modal('hide');
                    document.getElementById("usuario-editar").reset();
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