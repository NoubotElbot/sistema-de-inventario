function addCommas(nStr) {
  nStr += "";
  var x = nStr.split(",");
  var x1 = x[0];
  var x2 = x.length > 1 ? "," + x[1] : "";
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, "$1" + "." + "$2");
  }
  return x1 + x2;
}

function cargarClientes() {
  let clientes_select = $("#cliente");
  clientes_select.find("option").remove();
  clientes_select.append(
    "<option class=\"text-muted\" value=''> Seleccione un cliente </option>"
  );
  $.ajax({
    type: "POST",
    url: "/get_clientes",
    data: {
      csrf_test_name: token,
    },
    dataType: "json",
    success: function (data) {
      if (data.clientes) {
        let clientes = data.clientes;
        for (cliente of clientes) {
          clientes_select.append(
            `<option value="${cliente.id}">${cliente.nombre} ${cliente.apellido}</option>`
          );
        }
      } else {
        alert(data.error);
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}
function onKeyDownHandler(event) {
  var codigo = event.which || event.keyCode;
  if (codigo === 9) {
    $("#venderBtn").click();
  }
}
function cargarCarro() {
  let tabla = document.getElementById("tbody");
  $.ajax({
    type: "POST",
    url: "/get_carro",
    data: {
      csrf_test_name: token,
    },
    dataType: "json",
    success: function (data) {
      tabla.innerHTML = "";
      $("#total").text("");
      if (data.carro.length > 0) {
        let total = 0;
        let index = 0;
        for (producto of data.carro) {
          let fila = `
                        <td>${producto.codigo}</td>
                        <td>${producto.nombre_producto}</td>
                        <td>${producto.cantidad}</td>
                        <td>${producto.precio_out}</td>
                        <td>${producto.total}</td>
                        <td>
                            <button type="button" onclick="quitarProductoDeVenta(${index})" data-toggle="tooltip" data-placement="top" title="Quitar del carro" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        `;
          let btn = document.createElement("TR");
          btn.innerHTML = fila;
          tabla.appendChild(btn);
          total += parseInt(producto.total);
          index++;
        }
        $("#total").text(`Total: $${addCommas(total)}`);
        $(function () {
          $('[data-toggle="tooltip"]').tooltip();
        });
      } else {
        let fila = '<td colspan="6">No hay productos en este carro</td>';
        let btn = document.createElement("TR");
        btn.innerHTML = fila;
        tabla.appendChild(btn);
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

function quitarProductoDeVenta(index) {
  $.ajax({
    type: "POST",
    url: "/quitarProductoDeVenta",
    data: {
      csrf_test_name: token,
      _method: "DELETE",
      indice: index,
    },
    dataType: "json",
    success: function (data) {
      cargarCarro();
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

$("#agregar-form").submit(function (e) {
  e.preventDefault();
  let codigo = $("#producto").val();
  $.ajax({
    type: "POST",
    url: "/agregar_al_carro",
    data: {
      codigo: codigo,
      csrf_test_name: token,
    },
    dataType: "json",
    complete: () => {
      $("#producto").val("");
    },
    success: function (data) {
      if (data.error) {
        alert(data.error + ` #${codigo}`);
      } else {
        cargarCarro();
        $("#producto").focus();
      }
    },
    error: function (xhr, ajaxOption, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});
$(document).ready(function () {
  cargarClientes();
  cargarCarro();
  $("#producto").focus();
});
