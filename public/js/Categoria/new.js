$("#categoria-agregar-modal").on("hidden.bs.modal", function (event) {
  document.getElementById("categoria-agregar").reset();
});
$("#categoria-agregar").submit(function (e) {
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
        if (response.error.nombre) {
          $("#nombre").addClass("is-invalid");
          $(".validationNombre").html(response.error.nombre);
        } else {
          $("#nombre").removeClass("is-invalid");
          $(".validationNombre").html("");
        }
        if (response.error.descripcion) {
          $("#descripcion").addClass("is-invalid");
          $(".validationDescripcion").html(response.error.descripcion);
        } else {
          $("#descripcion").removeClass("is-invalid");
          $(".validationDescripcion").html("");
        }
      } else {
        $("#categoria-agregar-modal").modal("hide");
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
});
