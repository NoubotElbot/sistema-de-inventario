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
            <div>Editar Categoría
                <div class="page-title-subheading">Edite las categorias de sus Productos
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <a href="<?= base_url() . '/categoria' ?>" class="btn-shadow btn btn-danger">
                <span class="btn-icon-wrapper pr-2 opacity-7">
                    <i class="fa fa-minus-circle fa-w-20"></i>
                </span>
                Cancelar
            </a>
        </div>
    </div>
</div>
<div class="tab-content">
    <?= \Config\Services::validation()->listErrors() ?>
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Editar Categoria </h5>
                <form class="" method="post" action="<?= base_url() . "/categoria/{$categoria['id']}/editar" ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="form-row">
                        <div class="col-lg-8 col-sm-12">
                            <div class="position-relative form-group">
                                <label for="nombre" class="">Nombre</label>
                                <input name="nombre" id="nombre" placeholder="Ingrese el nombre de la categoría" type="text" class="form-control" value="<?= $categoria['nombre'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-8 col-sm-12">
                            <div class="position-relative form-group">
                                <label for="descripcion" class="">Descripción</label>
                                <textarea name="descripcion" id="descripcion" placeholder="Ingrese una descripción (Opcional)" rows="5" class="form-control"><?= $categoria['descripcion'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mt-2 btn btn-lg btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>