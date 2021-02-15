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
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo" id="cliente" value="option1">
                            <label class="form-check-label" for="cliente">
                                Cliente
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo" id="provedor" value="option2">
                            <label class="form-check-label" for="provedor">
                                Provedor
                            </label>
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
                            <div class="invalid-feedback validationEmail">

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
                            <div class="invalid-feedback validationDescripcion">

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
<script type="text/javascript">
    $('.close-modal').mousedown(function(e) {
        document.getElementById("persona-agregar").reset();
    });
    $('#cliente').click(function(e) {
        $('#company').attr('disabled', 'disable');
        $('.company').hide();
    });
    $('#provedor').click(function(e) {
        $('#company').removeAttr('disabled');
        $('.company').show();
    });
    $('#persona-agregar').submit(function(e) {
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

                    if (response.error.descripcion) {
                        $('#descripcion').addClass('is-invalid');
                        $('.validationDescripcion').html(response.error.descripcion);
                    } else {
                        $('#descripcion').removeClass('is-invalid');
                        $('.validationDescripcion').html('');
                    }
                } else {
                    $("#persona-agregar-modal").click();
                    document.getElementById("persona-agregar").reset();
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