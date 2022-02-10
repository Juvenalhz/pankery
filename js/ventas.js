var index; //index para recetario
var tanda;
$(document).ready(function () {
  $("#agregarPedido").click(function () {
    NuevoPedido();
  });
  $(document).on("blur", "#Cantidad", function () {
    var id = $("#Producto").val();
    $("#Costo").val($("#Precio").val() * ($("#Cantidad").val()/tanda));
  });
  $(document).on("click", "#guardarPedido", function () {
    guardarPedido();
  });
  $(document).on("click", "#cambioestatus", function () {
    cambioEstatus();
  });
  $(document).on("click", "#guardarPedidomod", function () {
    guardarModifPedido();
  });
  $(document).on("click", "#guardarpago", function () {
    guardarpago();
  });

  $("table#DataPendienteVentas tbody").on(
    "click",
    "#cambiarestatus",
    function () {
      $("#Cobranza").hide();
      $("#Proceso").show();
      $("#formstatus")[0].reset();
      var table = $("table#DataPendienteVentas").DataTable();
      var D = table.row($(this).parents("tr")).data();
      var id = D.id_pedidos;
      var estatusactual = D.estatus;
      $("#pedido").val(id);
      $("#estatusActual").val(estatusactual);
    }
  );
  $("table#DataProcesoVentas tbody").on(
    "click",
    "#cambiarestatus",
    function () {
      $("#Cobranza").show();
      $("#Proceso").hide();
      $("#formstatus")[0].reset();
      var table = $("table#DataProcesoVentas").DataTable();
      var D = table.row($(this).parents("tr")).data();
      var id = D.id_pedidos;
      var estatusactual = D.estatus;
      $("#pedido").val(id);
      $("#estatusActual").val(estatusactual);
    }
  );
  $("table#DataPendienteVentas tbody").on(
    "click",
    "#modificarpedido",
    function () {
      var table = $("table#DataPendienteVentas").DataTable();
      var D = table.row($(this).parents("tr")).data();
      var id = D.id_pedidos;
      modificarPedido(id);
    }
  );
  $("table#DataPendienteVentas tbody").on(
    "click",
    "#eliminarpedido",
    function () {
      var table = $("table#DataPendienteVentas").DataTable();
      var D = table.row($(this).parents("tr")).data();
      var id = D.id_pedidos;
      eliminarPedido(id);
    }
  );
  $("table#DataCobranzaVentas tbody").on("click", "#agregarpagos", function () {
    $("#formpagos")[0].reset();
    var table = $("table#DataCobranzaVentas").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var id = D.id_pedidos;
    consultaDeuda(id);
    
  });
});
function guardarpago() {
  
  $("form[name='formpagos']").validate({
    rules: {
      Deuda: {
        required: true,
      },
      pago: {
        required: true,
        number: true,
      },
      pedidoCobranza: {
        required: true,
      },
    },
    messages: {
      Deuda: {
        required: "Este campo es obligatorio.",
      },
      pago: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      pedidoCobranza: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      var datos = new FormData($("form[name='formpagos']")[0]);
      $.ajax({
        url: "view/ventas/guardarpago.php",
        type: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 1) {
            _Title = "¡Enhorabuena!";
            _Text = "Transacción exitosa";
            _Type = "success";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1000,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
               $("table#DataPendienteVentas").DataTable().ajax.reload();
              $("table#DataProcesoVentas").DataTable().ajax.reload();
              $("table#DataCobranzaVentas").DataTable().ajax.reload();
              $("#modalagregarpagos").modal('toggle');
            });
          } else if (data == 0) {
            _Title = "Error!";
            _Text = "El pago debe ser menor al total.";
            _Type = "error";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1700,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              // location.reload();
            });
          }
        },
      }).fail(function () {
        swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
      });
    },
  });
}
function consultaDeuda(id) {
  $.ajax({
    url: "view/ventas/buscarPedido.php",
    type: "POST",
    data: { id: id },
    success: function (data) {
      $("#Deuda").val(
        JSON.parse(data).data[0].total - JSON.parse(data).data[0].monto
      );
      $("#pedidoCobranza").val(id);

    },
  });
}
function eliminarPedido(id) {
  Swal.fire({
    title: "Estás seguro?",
    text: "Eliminar permanentemente este pedido.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Borrar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "view/ventas/eliminarPedido.php",
        type: "POST",
        data: { id: id },
        success: function (data) {
          Swal.fire(
            "Eliminado",
            "Este pedido fue eliminado satisfactoriamente.",
            "success"
          );
        },
      }).then((result) => {
        $("table#DataPendienteVentas").DataTable().ajax.reload();
        $("table#DataProcesoVentas").DataTable().ajax.reload();
        $("table#DataCobranzaVentas").DataTable().ajax.reload();
      });
    }
  });
}
function guardarModifPedido() {
  $("form[name='formPedidomod']").validate({
    rules: {
      Productomod: {
        required: true,
      },
      Preciomod: {
        required: true,
        number: true,
      },
      Cantidadmod: {
        required: true,
        number: true,
      },
      Costomod: {
        required: true,
        number: true,
      },
      Pagomod: {
        required: false,
        number: true,
      },
      Clientemod: {
        required: true,
      },
    },
    messages: {
      Productomod: {
        required: "Este campo es obligatorio.",
      },
      Preciomod: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Costomod: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Cantidadmod: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Pagomod: {
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Clientemod: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      var datos = new FormData($("form[name='formPedidomod']")[0]);
      $.ajax({
        url: "view/ventas/guardarmodfpedido.php",
        type: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 1) {
            _Title = "¡Enhorabuena!";
            _Text = "Transacción exitosa";
            _Type = "success";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1000,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              $("table#DataPendienteVentas").DataTable().ajax.reload();
              $("table#DataProcesoVentas").DataTable().ajax.reload();
              $("table#DataCobranzaVentas").DataTable().ajax.reload();
              $("#modalmodificarpedido").modal('toggle');
            });
          } else if (data == 0) {
            _Title = "Error!";
            _Text = "El pago debe ser menor al total.";
            _Type = "error";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1700,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              // location.reload();
            });
          }
        },
      }).fail(function () {
        swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
      });
    },
  });
}
function cambioEstatus() {
  $("form[name='formstatus']").validate({
    rules: {
      estatuspedido: {
        required: true,
      },
      pedido: {
        required: true,
      },
      estatusActual: {
        required: true,
      },
    },
    messages: {
      estatuspedido: {
        required: "Este campo es obligatorio.",
      },
      pedido: {
        required: "Este campo es obligatorio.",
      },
      estatusActual: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      var datos = new FormData($("form[name='formstatus']")[0]);
      $.ajax({
        url: "view/ventas/cambioestatus.php",
        type: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 1) {
            _Title = "¡Enhorabuena!";
            _Text = "Transacción exitosa";
            _Type = "success";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1000,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              location.reload();
              $("table#DataPendienteVentas").DataTable().ajax.reload();
              $("table#DataProcesoVentas").DataTable().ajax.reload();
              $("table#DataCobranzaVentas").DataTable().ajax.reload();
              $("#modalcambiarestatus").modal('toggle');
            });
          } else {
            _Title = "Error!";
            _Text = "No posee suficiente " + data + " en stock.";
            _Type = "error";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1700,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              // location.reload();
            });
          }
        },
      });
    },
  });
}
function NuevoPedido() {
  $("#Producto").empty();
  $("#formPedido")[0].reset();

  $.ajax({
    url: "view/ventas/listaproductos.php",
    type: "POST",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $("#Producto").append("<option value=''>Seleccione</option>");
      $.each(JSON.parse(data), function (i, info) {
        $("#Producto").append(
          '<option class="opcProducto" value="' +
            info.id_pro +
            '" id="si" >' +
            info.descp +
            "</option>"
        );
      });
      $(document).on("blur", "#Producto", function () {
        var id = $("#Producto").val();
        var precio =
          $("#Producto").val() == ""
            ? ""
            : JSON.parse(data).find((encontrar) => encontrar.id_pro == id)
                .precio;
        var ganancia =
          $("#Producto").val() == ""
            ? ""
            : JSON.parse(data).find((encontrar) => encontrar.id_pro == id)
                .ganancia;
              

            tanda = $("#Producto").val() == ""
            ? ""
            : JSON.parse(data).find((encontrar) => encontrar.id_pro == id)
                .ctanda;
                console.log(JSON.parse(data));
                console.log(JSON.parse(tanda));
        $("#Precio").val((precio+ganancia));
        $("#Costo").val($("#Cantidad").val()  * $("#Precio").val());
      });
    },
  }).fail(function () {
    swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
  });
}
function guardarPedido() {
  $("form[name='formPedido']").validate({
    rules: {
      Producto: {
        required: true,
      },
      Precio: {
        required: true,
        number: true,
      },
      Cantidad: {
        required: true,
        number: true,
      },
      Costo: {
        required: true,
        number: true,
      },
      Pago: {
        required: false,
        number: true,
      },
      Cliente: {
        required: true,
      },
    },
    messages: {
      Producto: {
        required: "Este campo es obligatorio.",
      },
      Precio: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Costo: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Cantidad: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Pago: {
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      Cliente: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      var datos = new FormData($("form[name='formPedido']")[0]);
      $.ajax({
        url: "view/ventas/guardarpedido.php",
        type: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 1) {
            _Title = "¡Enhorabuena!";
            _Text = "Transacción exitosa";
            _Type = "success";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1000,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              
              $("table#DataPendienteVentas").DataTable().ajax.reload();
              $("#modalaggventa").modal('toggle');
            });
          } else if (data == 0) {
            _Title = "Error!";
            _Text = "El pago debe ser menor al total.";
            _Type = "error";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 1700,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              // location.reload();
            });
          }
        },
      }).fail(function () {
        swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
      });
    },
  });
}

function modificarPedido(id) {
  $("#Productomod").empty();

  $.ajax({
    url: "view/ventas/buscarPedido.php",
    type: "POST",
    data: { id: id },
    success: function (data) {
      console.log(JSON.parse(data));
      info = JSON.parse(data);
      $("#Preciomod").val(info.data[0].precio_und);
      $("#Costomod").val(info.data[0].total);
      $("#Cantidadmod").val(info.data[0].cantidad);
      $("#Clientemod").val(info.data[0].cliente);
      $("#Pagomod").val(info.data[0].monto);
      $("#id_pedido").val(info.data[0].id_pedidos);
      $("#Productomod").append(
        '<option value="' +
          info.data[0].id_product +
          '">' +
          info.data[0].descr +
          "</option>"
      );
      $.ajax({
        url: "view/ventas/listaproductos.php",
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          product = $("#Productomod").val();
          $.each(JSON.parse(data), function (i, info) {
            if (product != info.id_pro) {
              $("#Productomod").append(
                '<option class="opcProducto" value="' +
                  info.id_pro +
                  '" id="si" >' +
                  info.descp +
                  "</option>"
              );
            }
          });
          $(document).on("blur", "#Productomod", function () {
            var id = $("#Productomod").val();
            var precio =
              $("#Productomod").val() == ""
                ? ""
                : JSON.parse(data).find((encontrar) => encontrar.id_pro == id)
                    .precio;
            $("#Preciomod").val(precio);
            $("#Costomod").val($("#Preciomod").val() * $("#Cantidadmod").val());
          });
        },
      });
    },
  }).fail(function () {
    swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
  });
}
