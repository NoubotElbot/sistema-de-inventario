<div class="modal fade" id="usuario-agregar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Nuevo Usuario</h5>
                <?= form_open('usuario/agregar', ['id' => 'usuario-agregar']) ?>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input name="nombre" id="nombre" placeholder="Ingrese el Nombre" type="text" class="form-control">
                            <div class="invalid-feedback validationNombre">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="apellido" class="">Apellido</label>
                            <input name="apellido" id="apellido" placeholder="Ingrese el Apellido" type="text" class="form-control">
                            <div class="invalid-feedback validationApellido">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="username" class="">Nombre de Usuario</label>
                            <input name="username" id="username" placeholder="Ingrese Nombre de Usuario" type="text" class="form-control">
                            <div class="invalid-feedback validationUsername">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="email" class="">Email</label>
                            <input name="email" id="email" placeholder="Ingrese Nombre de Usuario" type="email" class="form-control">
                            <div class="invalid-feedback validationEmail">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="password" class="">Contraseña</label>
                            <input name="password" id="password" placeholder="Ingrese su Contraseña" type="password" class="form-control">
                            <div class="invalid-feedback validationPassword">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="password_confirm" class="">Confirme Contraseña</label>
                            <input name="password_confirm" id="password_confirm" placeholder="Ingrese Nuevamente su contraseña" type="password" class="form-control">
                            <div class="invalid-feedback validationPasswordConfirm">

                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cancelar</button>
                <button form="usuario-agregar" type="submit" class="btn btn-primary btnsubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.close-modal').mousedown(function(e) {
        document.getElementById("usuario-agregar").reset();
    });
    $('#usuario-agregar').submit(function(e) {
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
                        $('#nombre').addClass('is-invalid');
                        $('.validationNombre').html(response.error.nombre);
                    } else {
                        $('#nombre').removeClass('is-invalid');
                        $('.validationNombre').html('');
                    }
                    if (response.error.apellido) {
                        $('#apellido').addClass('is-invalid');
                        $('.validationApellido').html(response.error.apellido);
                    } else {
                        $('#apellido').removeClass('is-invalid');
                        $('.validationApellido').html('');
                    }
                    if (response.error.username) {
                        $('#username').addClass('is-invalid');
                        $('.validationUsername').html(response.error.username);
                    } else {
                        $('#username').removeClass('is-invalid');
                        $('.validationUsername').html('');
                    }
                    if (response.error.email) {
                        $('#email').addClass('is-invalid');
                        $('.validationEmail').html(response.error.email);
                    } else {
                        $('#email').removeClass('is-invalid');
                        $('.validationEmail').html('');
                    }
                    if (response.error.password) {
                        $('#password').addClass('is-invalid');
                        $('.validationPassword').html(response.error.password);
                    } else {
                        $('#password').removeClass('is-invalid');
                        $('.validationPassword').html('');
                    }
                    if (response.error.password_confirm) {
                        $('#password_confirm').addClass('is-invalid');
                        $('.validationPasswordConfirm').html(response.error.password_confirm);
                    } else {
                        $('#password_confirm').removeClass('is-invalid');
                        $('.validationPasswordConfirm').html('');
                    }
                } else {
                    $("#usuario-agregar-modal").click();
                    document.getElementById("usuario-agregar").reset();
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