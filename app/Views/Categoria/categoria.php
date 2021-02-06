<?= $this->extend('layouts/master') ?>

<?= $this->section('titulo') ?>
Hello World!
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diamond icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Categorias
                <div class="page-title-subheading">Listado de todas tu categorias
                </div>
            </div>
        </div>
        <div class="page-title-actions">
                <a href="<?= base_url().'/categoria/agregar'?>" class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus-circle fa-w-20"></i>
                    </span>
                    Nueva Categoría
                </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Categorias</h5>
                <table class="mb-0 table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre </th>
                            <th>Descripción</th>
                            <th>Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria) : ?>
                            <tr>
                                <th scope="row"><?= $categoria['id'] ?></th>
                                <td><?= $categoria['nombre'] ?></td>
                                <td><?= $categoria['descripcion'] ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($categoria['create_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>