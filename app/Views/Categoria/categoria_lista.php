<h5 class="card-title">Categorias</h5>
<div class="table-responsive">
    <table class="mb-0 table table-bordered text-center" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre </th>
                <th>Descripción</th>
                <th>Creación</th>
                <th>Estado</th>
                <?php if (session()->get('admin') == 1) : ?>
                    <th>Opciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria) : ?>
                <tr>
                    <th scope="row"><?= $categoria['id'] ?></th>
                    <td><?= $categoria['nombre'] ?></td>
                    <td class="text-justify"><?= $categoria['descripcion'] ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($categoria['create_at'])) ?></td>
                    <td><?= $categoria['activo'] == 1 ? 'Activo' : 'Desactivado' ?></td>
                    <?php if (session()->get('admin') == 1) : ?>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn-shadow btn btn-primary" onclick="edit(<?= $categoria['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn <?= $categoria['activo'] == 1 ? 'btn-danger' : 'btn-warning' ?>" onclick="activar_desactivar(<?= $categoria['id'] ?>)" data-toggle="tooltip" data-placement="top" title="<?= $categoria['activo'] == 1 ? 'Desactivar' : 'Activar' ?>">
                                    <?= $categoria['activo'] == 1 ? '<i class="fas fa-trash-alt"></i>' : '<i class="fas fa-recycle"></i>' ?>
                                </button>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="<?= base_url() . '/js/datatables.js' ?>"></script>
<script type="text/javascript">
    function edit(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('categoria/editar') ?>",
            data: {
                id: id,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewmodal').html(response.success);
                    $('#categoria-editar-modal').modal('show');
                    
                }
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function activar_desactivar(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('categoria/borrar') ?>",
            data: {
                id: id,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewmodal').html(response.success);
                    $('#categoria-borrar-modal').modal('show');
                }
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>