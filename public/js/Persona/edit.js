$("#customRadio1-edit").click(function (e) {
  $("#company-edit").attr("disabled", "disable");
  $(".company").hide();
});
$("#customRadio2-edit").click(function (e) {
  $("#company-edit").removeAttr("disabled");
  $(".company").show();
});
$("#persona-editar").submit(function (e) {
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
      $(".btnsubmit").html("Actualizar");
    },
    success: function (response) {
      if (response.error) {
        if (response.error.nombre) {
          $("#nombre-edit").addClass("is-invalid");
          $(".validationNombre").html(response.error.nombre);
        } else {
          $("#nombre-edit").removeClass("is-invalid");
          $(".validationNombre").html("");
        }

        if (response.error.apellido) {
          $("#apellido-edit").addClass("is-invalid");
          $(".validationApellido").html(response.error.apellido);
        } else {
          $("#apellido-edit").removeClass("is-invalid");
          $(".validationApellido").html("");
        }

        if (response.error.tipo) {
          $(".tipo-radio").addClass("is-invalid");
          $(".validationTipo").html(response.error.tipo);
        } else {
          $(".tipo-radio").removeClass("is-invalid");
          $(".validationTipo").html("");
        }

        if (response.error.company) {
          $("#company-edit").addClass("is-invalid");
          $(".validationCompany").html(response.error.company);
        } else {
          $("#company-edit").removeClass("is-invalid");
          $(".validationCompany").html("");
        }

        if (response.error.email) {
          $("#email-edit").addClass("is-invalid");
          $(".validationEmail").html(response.error.email);
        } else {
          $("#email-edit").removeClass("is-invalid");
          $(".validationEmail").html("");
        }

        if (response.error.telefono) {
          $("#telefono-edit").addClass("is-invalid");
          $(".validationTelefono").html(response.error.telefono);
        } else {
          $("#telefono-edit").removeClass("is-invalid");
          $(".validationTelefono").html("");
        }

        if (response.error.direccion) {
          $("#direccion-edit").addClass("is-invalid");
          $(".validationDireccion").html(response.error.direccion);
        } else {
          $("#direccion-edit").removeClass("is-invalid");
          $(".validationDireccion").html("");
        }
      } else {
        $("#persona-editar-modal").modal("hide");
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
