function agregar() {
    $.ajax({
      type: "POST",
      url: "persona/new",
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
        $("#agregarBtn").html("Nuevo Cliente/Provedor");
      },
      success: function (response) {
        if (response.success) {
          $(".viewmodal").html(response.success);
          $("#persona-agregar-modal").modal("show");
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
    url: "persona/editar",
    data: {
      id: id,
      csrf_test_name: $("meta[name='X-CSRF-TOKEN']").attr("content"),
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $(".viewmodal").html(response.success);
        $("#persona-editar-modal").modal("show");
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
    url: "persona/borrar",
    data: {
      id: id,
      csrf_test_name: $("meta[name='X-CSRF-TOKEN']").attr("content"),
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $(".viewmodal").html(response.success);
        $("#persona-borrar-modal").modal("show");
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
    url: "persona/lista",
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
      data: "apellido",
    },
    {
      data: "direccion",
    },
    {
      data: "telefono",
    },
    {
      data: "email",
    },
    {
      data: "tipo",
    },
    {
      data: "empresa",
    },
    {
      data: "opciones",
    },
  ],
});
