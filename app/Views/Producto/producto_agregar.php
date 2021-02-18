<div class="modal fade" id="producto-agregar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Nuevo Producto</h5>
                <?= form_open('producto/agregar', ['id' => 'producto-agregar']) ?>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="nombre_producto">Nombre del producto</label>
                            <input name="nombre_producto" id="nombre_producto" placeholder="Ingrese el nombre" type="text" class="form-control">
                            <div class="invalid-feedback validationNombre">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="categoria">Categoria</label>
                            <select class="custom-select" name="categoria" id="categoria">
                                <option> ------ </option>
                                <?php foreach ($categorias as $categoria) : ?>
                                    <option value="<?= $categoria['id']?>"><?= $categoria['nombre']?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback validationPrecio">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="descripcion" class="">Descripción</label>
                            <textarea name="descripcion" id="descripcion" placeholder="Ingrese la descripción de producto (Opcional)" class="form-control" rows="5"></textarea>
                            <div class="invalid-feedback validationDescripcion">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="precio">Precio</label>
                            <input type="number" id="precio" name="precio" class="form-control" placeholder="$0">
                            <div class="invalid-feedback validationPrecio">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="stock" class="">Stock</label>
                            <input name="stock" id="stock" type="number" class="form-control" placeholder="0">
                            <div class="invalid-feedback validationStock">

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="stock_critico" class="">Stock Critico</label>
                            <input name="stock_critico" id="stock_critico" type="number" class="form-control" placeholder="0">
                            <div class="invalid-feedback validationStockCritico">

                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cancelar</button>
                <button form="producto-agregar" type="submit" class="btn btn-primary btnsubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.close-modal').mousedown(function(e) {
        document.getElementById("producto-agregar").reset();
    });
    $('#producto-agregar').submit(function(e) {
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
                if (response.error) {
                    if (response.error.nombre) {
                        $('#nombre').addClass('is-invalid');
                        $('.validationNombre').html(response.error.nombre);
                    } else {
                        $('#nombre').removeClass('is-invalid');
                        $('.validationNombre').html('');
                    }
                } else {
                    $("#producto-agregar-modal").modal('hide');
                    document.getElementById("producto-agregar").reset();
                    $('.cuadro-alertas').show();
                    $('.alert ').html(response.success).removeAttr('class').addClass('alert alert-success');
                    table.ajax.reload(null, false);
                }
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    })
</script>