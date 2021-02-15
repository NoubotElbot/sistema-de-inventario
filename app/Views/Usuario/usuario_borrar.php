<div class="modal fade" id="usuario-borrar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title"><?= $activo == 1 ? 'Desactivar' : 'Activar' ?> Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="card-title">¡Atención!</h4>
                <h5>Esta a pundo de <?= $activo == 1 ? 'Desactivar' : 'Activar' ?> El Usuario:</h5>
                <h5><?=$username.' #'.$id?></h5>
                <?= form_open('usuario/delete', ['id' => 'usuario-borrar']) ?>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger btnsubmit">Aceptar</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#usuario-borrar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: {
                id: <?= $id ?>,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                _method: 'DELETE'
            },
            dataType: "json",
            success: function(response) {
                $('#usuario-borrar-modal').modal('hide');
                if (response.success) {
                    $('.cuadro-alertas').show();
                    $('.alert ').html(response.success).removeAttr('class').addClass('alert alert-success');
                    table.ajax.reload();
                }

                if (response.error) {
                    $('.cuadro-alertas').show();
                    $('.alert ').html(response.error).removeAttr('class').addClass('alert alert-danger');
                }
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    })
</script>