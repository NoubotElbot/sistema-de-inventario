<?= $this->extend('layouts/master') ?>

<?= $this->section('titulo') ?>
Categorias
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
            <?php if (session()->get('admin') == 1) : ?>
                <button type="button" class="btn-shadow btn btn-primary" id="agregarBtn" onclick="agregar()">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus-circle fa-w-20"></i>
                    </span>
                    Nueva Categoría
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 cuadro-alertas">
    </div>
    <div class="col">
        <div class="main-card mb-3 card">
            <div class="card-body viewdata">
                <h5 class="card-title">Categorias</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-bordered text-center" id="myTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre </th>
                                <th>Descripción</th>
                                <th>Creación</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('js/Categoria/categoria.js') ?>" type="text/javascript"></script>
<?= $this->endSection() ?>
<?= $this->section('modals') ?>
<div class="viewmodal"></div>
<?= $this->endSection() ?>