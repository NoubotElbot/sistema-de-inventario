function agregar() {
  $.ajax({
    type: "POST",
    url: "categoria/new",
    data: {
      csrf_test_name: $("meta[name='X-CSRF-TOKEN']").attr("content"),
    },
    dataType: "json",
    beforeSend: function () {
      $("#agregarBtn").attr("disable", "disabled");
      $("#agregarBtn").html('<i class="fa fa-spin fa-spinner"></i>');
    },
    complete: function () {
      $("#agregarBtn").removeAttr("disable");
      $("#agregarBtn").html("Nueva Categoría");
    },
    success: function (response) {
      if (response.success) {
        $(".viewmodal").html(response.success);
        $("#categoria-agregar-modal").modal("show");
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

function edit(id) {
  $.ajax({
    type: "POST",
    url: "categoria/editar",
    data: {
      id: id,
      csrf_test_name: $("meta[name='X-CSRF-TOKEN']").attr("content"),
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $(".viewmodal").html(response.success);
        $("#categoria-editar-modal").modal("show");
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

function activar_desactivar(id) {
  $.ajax({
    type: "POST",
    url: "categoria/borrar",
    data: {
      id: id,
      csrf_test_name: $("meta[name='X-CSRF-TOKEN']").attr("content"),
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $(".viewmodal").html(response.success);
        $("#categoria-borrar-modal").modal("show");
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}
var table = $("#myTable").DataTable({
  language: {
    processing: "Procesando...",
    lengthMenu: "Mostrar _MENU_ registros",
    zeroRecords: "No se encontraron resultados",
    emptyTable: "Ningún dato disponible en esta tabla",
    info:
      "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
    infoFiltered: "(filtrado de un total de _MAX_ registros)",
    search: "Buscar:",
    infoThousands: ",",
    loadingRecords: "Cargando...",
    paginate: {
      first: "Primero",
      last: "Último",
      next: "Siguiente",
      previous: "Anterior",
    },
    aria: {
      sortAscending: ": Activar para ordenar la columna de manera ascendente",
      sortDescending: ": Activar para ordenar la columna de manera descendente",
    },
    buttons: {
      copy: "Copiar",
      colvis: "Visibilidad",
      collection: "Colección",
      colvisRestore: "Restaurar visibilidad",
      copyKeys:
        "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
      copySuccess: {
        1: "Copiada 1 fila al portapapeles",
        _: "Copiadas %d fila al portapapeles",
      },
      copyTitle: "Copiar al portapapeles",
      csv: "CSV",
      excel: "Excel",
      pageLength: {
        "-1": "Mostrar todas las filas",
        1: "Mostrar 1 fila",
        _: "Mostrar %d filas",
      },
      pdf: "PDF",
      print: "Imprimir",
    },
    decimal: ",",
    searchBuilder: {
      add: "Añadir condición",
      button: {
        0: "Constructor de búsqueda",
        _: "Constructor de búsqueda (%d)",
      },
      clearAll: "Borrar todo",
      condition: "Condición",
      conditions: {
        date: {
          after: "Despues",
          before: "Antes",
          between: "Entre",
          empty: "Vacío",
          equals: "Igual a",
          not: "No",
          notBetween: "No entre",
          notEmpty: "No Vacio",
        },
        moment: {
          after: "Despues",
          before: "Antes",
          between: "Entre",
          empty: "Vacío",
          equals: "Igual a",
          not: "No",
          notBetween: "No entre",
          notEmpty: "No vacio",
        },
        number: {
          between: "Entre",
          empty: "Vacio",
          equals: "Igual a",
          gt: "Mayor a",
          gte: "Mayor o igual a",
          lt: "Menor que",
          lte: "Menor o igual que",
          not: "No",
          notBetween: "No entre",
          notEmpty: "No vacío",
        },
        string: {
          contains: "Contiene",
          empty: "Vacío",
          endsWith: "Termina en",
          equals: "Igual a",
          not: "No",
          notEmpty: "No Vacio",
          startsWith: "Empieza con",
        },
      },
      data: "Data",
      deleteTitle: "Eliminar regla de filtrado",
      leftTitle: "Criterios anulados",
      logicAnd: "Y",
      logicOr: "O",
      rightTitle: "Criterios de sangría",
      title: {
        0: "Constructor de búsqueda",
        _: "Constructor de búsqueda (%d)",
      },
      value: "Valor",
    },
    searchPanes: {
      clearMessage: "Borrar todo",
      collapse: {
        0: "Paneles de búsqueda",
        _: "Paneles de búsqueda (%d)",
      },
      count: "{total}",
      countFiltered: "{shown} ({total})",
      emptyPanes: "Sin paneles de búsqueda",
      loadMessage: "Cargando paneles de búsqueda",
      title: "Filtros Activos - %d",
    },
    select: {
      1: "%d fila seleccionada",
      _: "%d filas seleccionadas",
      cells: {
        1: "1 celda seleccionada",
        _: "$d celdas seleccionadas",
      },
      columns: {
        1: "1 columna seleccionada",
        _: "%d columnas seleccionadas",
      },
    },
    thousands: ".",
  },
  ajax: {
    url: "categoria/lista",
    type: "POST",
    data: {
      csrf_test_name: $("meta[name='X-CSRF-TOKEN']").attr("content"),
    },
    dataSrc: "data",
  },
  columns: [
    {
      data: "id",
    },
    {
      data: "nombre",
    },
    {
      data: "descripcion",
    },
    {
      data: "created_at",
    },
    {
      data: "deleted_at",
    },
    {
      data: "opciones",
    },
  ],
  dom: "Bfrtilp",
  buttons: [
    {
      extend: "pdfHtml5",
      text: '<i class="fas fa-file-pdf"></i>',
      titleAttr: "Exportar a Pdf",
      className: "btn btn-danger",
    },
    {
      extend: "excelHtml5",
      text: '<i class="fas fa-file-excel"></i>',
      titleAttr: "Exportar a Excel",
      className: "btn btn-success",
    },
  ],
});
