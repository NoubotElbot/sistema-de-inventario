$('#categoria-editar').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
            $('.btnsubmit-edit').attr('disable', 'disabled');
            $('.btnsubmit-edit').html('<i class="fa fa-spin fa-spinner"></i>')
        },
        complete: function() {
            $('.btnsubmit-edit').removeAttr('disable');
            $('.btnsubmit-edit').html('Actualizar')
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

                if (response.error.descripcion) {
                    $('#descripcion-edit').addClass('is-invalid');
                    $('.validationDescripcion').html(response.error.descripcion);
                } else {
                    $('#descripcion-edit').removeClass('is-invalid');
                    $('.validationDescripcion').html('');
                }
            } else {
                $("#categoria-editar-modal").modal('hide');
                $(".cuadro-alertas").html(
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.success}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`
            );table.ajax.reload(null, false );
            }
        },
        error: function(xhr, ajaxOption, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
    return false;
})