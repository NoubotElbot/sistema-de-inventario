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
                <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#categoria-agregar-modal">
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
    <div class="col-12 cuadro-alertas" style="display: none;">
        <div class="alert" role="alert">

        </div>
    </div>
    <div class="col">
        <div class="main-card mb-3 card">
            <div class="card-body viewdata">

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

    // function agregar() {
    //     $('#categoria-agregar-modal').modal('show');
    // }

    $(document).ready(function() {
        cargarDatos();
    })
</script>
<?= $this->endSection() ?>
<?= $this->section('modals') ?>
<?= $this->include('Categoria/categoria_agregar') ?>
<div class="viewmodal"></div>
<?= $this->endSection() ?>