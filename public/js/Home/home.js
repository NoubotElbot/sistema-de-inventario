$.ajax({
  type: "POST",
  url: "/datosHome",
  data: {
    csrf_test_name: $("meta[name='X-CSRF-TOKEN']").attr("content"),
  },
  dataType: "json",
  success: (data) => {
    let tabla = document.getElementById("productos-criticos");
    let clientes = document.getElementById("clientes");
    let ventas = document.getElementById("ventas");
    let gastos = document.getElementById("gastos");
    let provedores = document.getElementById("provedores");
    tabla.innerHTML = "";
    if (data.productos) {
      for (producto of data.productos) {
        let fila = `
                        <td class="text-center">${producto.id}</td>
                        <td>${producto.nombre_producto}</td>
                        <td class="text-center">${producto.stock}</td>
                        <td class="text-center">${producto.stock_critico}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                        `;
        let btn = document.createElement("TR");
        btn.innerHTML = fila;
        tabla.appendChild(btn);
      }
    } else {
      let fila = `<tr>
                    <td class="text-center" colspan="5">No hay datos en esta tabla</td>
                  </tr>`;
      tabla.appendChild(btn);
    }
    clientes.innerHTML = data.clientes;

    provedores.innerHTML = data.provedores;

    data.operaciones.ventas
      ? (ventas.innerHTML = "$" + data.operaciones.ventas)
      : (ventas.innerHTML = "$0");

    data.operaciones.gastos
      ? (gastos.innerHTML = "$" + data.operaciones.gastos)
      : (gastos.innerHTML = "$0");
  },
  error: (xhr, ajaxOption, thrownError) =>
    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError),
});


var ctx = document.getElementById('ventasReporte').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});