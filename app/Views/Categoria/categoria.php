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
            <!-- <a href="<?= base_url() . '/categoria/agregar' ?>" class="btn-shadow btn btn-primary">

            </a> -->
            <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#categoria-agregar-modal">
                <span class="btn-icon-wrapper pr-2 opacity-7">
                    <i class="fa fa-plus-circle fa-w-20"></i>
                </span>
                Nueva Categoría
            </button>
        </div>

    </div>
</div>
<div class="row">
    <div class="col">
        <div class="main-card mb-3 card">
            <div class="card-body viewdata">

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('modals') ?>
<div class="modal fade" id="categoria-agregar-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Nueva Categoria</h5>
                <?= form_open('categoria/agregar', ['id' => 'categoria-agregar']) ?>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="position-relative form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input name="nombre" id="nombre" placeholder="Ingrese el nombre de la categoría" type="text" class="form-control" value="<?= set_value('nombre') ?>">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="position-relative form-group">
                            <label for="descripcion" class="">Descripción</label>
                            <textarea name="descripcion" id="descripcion" placeholder="Ingrese una descripción (Opcional)" rows="5" class="form-control"><?= set_value('descripcion') ?></textarea>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button form="categoria-agregar" type="submit" class="btn btn-primary btnsubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    function cargarDatos() {
        $.ajax({
            url: "<?= site_url('categoria/lista') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(document).ready(function() {
        cargarDatos();
        $('#categoria-agregar').submit(function(e) {
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
                    cargarDatos();
                },
                error: function(xhr, ajaxOption, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        })
    })
</script>
<?= $this->endSection() ?>