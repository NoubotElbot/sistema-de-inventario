<?= $this->extend('layouts/master') ?>

<?= $this->section('titulo') ?>
Productos
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-ticket icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Productos
                <div class="page-title-subheading">Listado de todas tus Productos
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <?php if (session()->get('admin') == 1) : ?>
                <button type="button" class="btn-shadow btn btn-primary" id="agregarBtn" onclick="agregar()">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus-circle fa-w-20"></i>
                    </span>
                    Nuevo Producto
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <!-- <div class="col-lg-6 col-xl-4">
        <div class="card mb-3 widget-content">
            <div class="widget-content-wrapper">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Orders</div>
                    <div class="widget-subheading">Last year expenses</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-success"><span>1896</span></div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-12 cuadro-alertas">
    </div>
    <div class="col">
        <div class="main-card mb-3 card">
            <div class="card-body viewdata">
                <h5 class="card-title">Productos</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-bordered text-center" id="myTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Stock</th>
                                <th>Stock Critico</th>
                                <th>Categoria</th>
                                <th>Usuario</th>
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
<script src="<?= base_url('js/Producto/producto.js') ?>" type="text/javascript"></script>
<?= $this->endSection() ?>
<?= $this->section('modals') ?>
<div class="viewmodal"></div>
<?= $this->endSection() ?>