$("#producto-agregar-modal").on("hidden.bs.modal", function (event) {
  document.getElementById("producto-agregar").reset();
});
$("#producto-agregar").submit(function (e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: $(this).attr("action"),
    data: $(this).serialize(),
    dataType: "json",
    beforeSend: function () {
      $(".btnsubmit").attr("disable", "disabled");
      $(".btnsubmit").html('<i class="fa fa-spin fa-spinner"></i>');
    },
    complete: function () {
      $(".btnsubmit").removeAttr("disable");
      $(".btnsubmit").html("Guardar");
    },
    success: function (response) {
      if (response.error) {
        if (response.error.nombre_producto) {
          $("#nombre_producto").addClass("is-invalid");
          $(".validationNombre").html(response.error.nombre_producto);
        } else {
          $("#nombre_producto").removeClass("is-invalid");
          $(".validationNombre").html("");
        }

        if (response.error.categoria) {
          $("#categoria").addClass("is-invalid");
          $(".validationCategoria").html(response.error.categoria);
        } else {
          $("#categoria").removeClass("is-invalid");
          $(".validationCategoria").html("");
        }

        if (response.error.precio_in) {
          $("#precio_in").addClass("is-invalid");
          $(".validationPrecioIn").html(response.error.precio_in);
        } else {
          $("#precio_in").removeClass("is-invalid");
          $(".validationPrecioIn").html("");
        }

        if (response.error.precio_out) {
          $("#precio_out").addClass("is-invalid");
          $(".validationPrecioOut").html(response.error.precio_out);
        } else {
          $("#precio_out").removeClass("is-invalid");
          $(".validationPrecioOut").html("");
        }

        if (response.error.stock) {
          $("#stock").addClass("is-invalid");
          $(".validationStock").html(response.error.stock);
        } else {
          $("#stock").removeClass("is-invalid");
          $(".validationStock").html("");
        }

        if (response.error.stock_critico) {
          $("#stock_critico").addClass("is-invalid");
          $(".validationStockCritico").html(response.error.stock_critico);
        } else {
          $("#stock_critico").removeClass("is-invalid");
          $(".validationStockCritico").html("");
        }
      } else {
        $("#producto-agregar-modal").modal("hide");
        $(".cuadro-alertas").html(
          `<div class="alert alert-success alert-dismissible fade show" role="alert">
                ${response.success}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`
        );
        table.ajax.reload(null, false);
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
  return false;
});
