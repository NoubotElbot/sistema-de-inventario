<?= $this->extend('layouts/master') ?>

<?= $this->section('titulo') ?>
Registrar Venta
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cash icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Registrar Venta
                <div class="page-title-subheading">
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelarModal">
                Cancelar
            </button>
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
                <div class="form-group row">
                    <label for="producto" class="col-sm-2 col-form-label">Productos</label>
                    <div class="col-sm-8">
                        <select class="custom-select" id="producto">
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary" id="venderBtn">Agregar</button>
                    </div>
                </div>
                <h5 class="card-title">Ventas</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-bordered text-center" id="tabla-venta" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unit.</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var token = {
        <?= csrf_token() ?>: '<?= csrf_hash() ?>',
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        let productos_select = $('#producto');
        productos_select.append('<option> ------- </option>');
        $.ajax({
            type: "POST",
            url: '/get_productos',
            data: token,
            dataType: "json",
            success: function(data) {
                if (data.productos) {
                    let productos = data.productos;
                    for (producto of productos) {
                        productos_select.append(`<option value="${producto.id}">${producto.nombre_producto}</option>`);
                    }
                    actualizarTabla()
                } else {
                    alert(data.error)
                }
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

        function actualizarTabla() {
            let tabla = document.getElementById("tbody");
            $.ajax({
                type: "POST",
                url: '/get_carro',
                data: token,
                dataType: "json",
                success: function(data) {
                    if (data.carro) {
                        for (producto of data.carro) {
                            let fila = `
                            <td>${producto.id}</td>
                            <td>${producto.nombre_producto}</td>
                            <td>${producto.cantidad}</td>
                            <td>${producto.precio}</td>
                            <td>${producto.total}</td>
                            <td>${producto.acciones}</td>
                            `;
                            let btn = document.createElement("TR");
                            btn.innerHTML = fila;
                            tabla.appendChild(btn);
                        }
                    } else {
                        let fila = '<td colspan="6">No hay productos en este carro</td>';
                        let btn = document.createElement("TR");
                        btn.innerHTML = fila;
                        tabla.appendChild(btn);
                    }
                },
                error: function(xhr, ajaxOption, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }
        $('#venderBtn').click(function(e) {
            let producto = $('#producto').val();
            $.ajax({
                type: "POST",
                url: '/get_productos',
                data: {
                    id: producto,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                },
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        var producto = data.success;
                        document.getElementById("tabla-venta").insertRow(-1).innerHTML =
                            `<td>${producto.id}</td>
                         <td>${producto.nombre_producto}</td>
                         <td></td>
                         <td>${producto.precio}</td>
                         <td></td>
                         <td>
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                         </td>`;

                    } else {
                        alert(data.error)
                    }

                },
                error: function(xhr, ajaxOption, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })

    });
</script>
<?= $this->endSection() ?>
<?= $this->section('modals') ?>
<div class="modal fade" id="cancelarModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Esta a punto de cancelar la venta. Perderá todos los productos agregados a la lista de venta.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Continuar vendiendo</button>
                <a href="<?= base_url('venta') ?>" class="btn btn-warning">Cancelar Venta</a>
            </div>
        </div>
    </div>
</div>
<div class="viewmodal"></div>
<?= $this->endSection() ?>