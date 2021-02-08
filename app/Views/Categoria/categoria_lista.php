<h5 class="card-title">Categorias</h5>
<table class="mb-0 table table-bordered" id="myTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre </th>
            <th>Descripción</th>
            <th>Creación</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <th scope="row"><?= $categoria['id'] ?></th>
                <td><?= $categoria['nombre'] ?></td>
                <td><?= $categoria['descripcion'] ?></td>
                <td><?= date('d/m/Y H:i:s', strtotime($categoria['create_at'])) ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="<?= base_url() . "/categoria/{$categoria['id']}/editar" ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php if ($categoria['activo'] == 1) : ?>
                            <button form="categoria-delete-<?= $categoria['id'] ?>" type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Desactivar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        <?php else : ?>
                            <button form="categoria-delete-<?= $categoria['id'] ?>" type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activar">
                                <i class="fas fa-recycle"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                    <?= form_open("categoria/{$categoria['id']}/desactivar", "id='categoria-delete-{$categoria['id']}'") ?>
                    <input type="hidden" name="_method" value="<?= $categoria['activo'] == 1 ? 'DELETE' : 'PUT' ?>" />
                    <?= form_close() ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript" src="<?= base_url() . '/js/datatables.js' ?>"></script>