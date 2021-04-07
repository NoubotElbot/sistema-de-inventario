<div class="modal fade" id="venta-detalle-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle Venta N°<?= $venta['id'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="mb-3 table table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Caja</th>
                                <th>Operación</th>
                                <th>Total</th>
                                <th>Pago</th>
                                <th>Descuento</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $venta['id'] ?></td>
                                <td><?= $venta['created_at'] ?></td>
                                <td><?= $venta['caja_id'] ?></td>
                                <td><?= $venta['tipo_operacion_id'] ?></td>
                                <td><?= $venta['total'] ?></td>
                                <td><?= $venta['cash'] ?></td>
                                <td><?= $venta['descuento'] ?></td>
                                <td><?= $venta['username'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h5 class="card-title">Prodcutos</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-bordered text-center" id="myTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Venta</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($operaciones as $op) : ?>
                                <tr>
                                    <td><?= $op['id'] ?></td>
                                    <td><?= $op['nombre_producto'] ?></td>
                                    <td><?= $op['cantidad'] ?></td>
                                    <td><?= $op['precio_out'] ?></td>
                                    <td><?= $op['precio_out']*$op['cantidad'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>