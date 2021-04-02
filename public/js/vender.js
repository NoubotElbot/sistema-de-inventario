

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split(',');
    var x1 = x[0];
    var x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}



function cargarProductos() {
    let productos_select = $('#producto');
    productos_select.find('option').remove();
    productos_select.append('<option> ------- </option>');
    $.ajax({
        type: "POST",
        url: '/get_productos',
        data: {
            csrf_test_name: token
        },
        dataType: "json",
        success: function (data) {
            if (data.productos) {
                let productos = data.productos;
                for (producto of productos) {
                    productos_select.append(`<option value="${producto.id}">${producto.nombre_producto}</option>`);
                }
            } else {
                alert(data.error)
            }
        },
        error: function (xhr, ajaxOption, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    })
}



function cargarCarro() {
    let tabla = document.getElementById("tbody");
    $.ajax({
        type: "POST",
        url: '/get_carro',
        data: {
            csrf_test_name: token
        },
        dataType: "json",
        success: function (data) {
            tabla.innerHTML = "";
            if (data.carro.length > 0) {
                let total = 0;
                let index = 0;
                for (producto of data.carro) {
                    let fila = `
                        <td>${producto.id}</td>
                        <td>${producto.nombre_producto}</td>
                        <td>${producto.cantidad}</td>
                        <td>${producto.precio_out}</td>
                        <td>${producto.total}</td>
                        <td>
                            <button type="button" onclick="quitarProductoDeVenta(${index})" class="btn btn-danger">
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
                $('#total').text(`Total: $${addCommas(total)}`)
            } else {
                let fila = '<td colspan="6">No hay productos en este carro</td>';
                let btn = document.createElement("TR");
                btn.innerHTML = fila;
                tabla.appendChild(btn);
            }
        },
        error: function (xhr, ajaxOption, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    })
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
            cargarProductos();
            cargarCarro();
        },
        error: function (xhr, ajaxOption, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    })
}

$('#venderBtn').click(function (e) {
    let producto = $('#producto').val();
    $.ajax({
        type: "POST",
        url: '/agregar_al_carro',
        data: {
            id: producto,
            csrf_test_name: token,
        },
        dataType: "json",
        success: function (data) {
            if (data.error) {
                alert(data.error);
            } else {
                cargarProductos();
                cargarCarro();
            }
        },
        error: function (xhr, ajaxOption, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    })
})
cargarProductos();
cargarCarro();




