$("#persona-borrar").submit(function (e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: $(this).attr("action"),
    data: $(this).serialize(),
    dataType: "json",
    success: function (response) {
      $("#persona-borrar-modal").modal("hide");
      if (response.success) {
        $(".cuadro-alertas").html(
          `<div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${response.success}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`
        );
        table.ajax.reload();
      }

      if (response.error) {
        $(".cuadro-alertas").html(
          `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${response.error}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`
        );
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});
