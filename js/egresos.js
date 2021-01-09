var index; //index para recetario
$(document).ready(function () {
  $(document).on("click", "#agregarGasto", function () {
    agregarGasto();
  });
  $(document).on("click", "#guardargastoEgresoFijo", function () {
    guardargastoEgresoFijo();
  });
  $(document).on("click", "#guardarGasto", function () {
    guardarGasto();
  });
  $("table#tableegresos tbody").on("click", "#modificarGasto", function () {
    $("#formmodifMP")[0].reset();
    var table = $("table#tableegresos").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var id = D.id_compra;
    var tipogasto = D.tipogasto;
    if (tipogasto == 'Materia Prima') {
      $("#modalmodificarGasto").modal('show');
      $("#idcompra").val(id);
      consultaEgreso(id);
    }else {
      $("#modalmodificarGastoEF").modal('show');
      $("#idcompramodif").val(id);
      consultaEgresoFijo(id);
    }
    
  });
  $("table#tableegresosfijo tbody").on("click", "#modificarEgresoFijo", function () {
    $("#formmodifEF")[0].reset();
    var table = $("table#tableegresosfijo").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var id = D.id_egresofijo;
    $("#id_egresofijo").val(id);
    consultaEgresoFijo(id);
  });
  $(document).on("click", "#guardargastoEgresoFijomodif", function () {
    guardarmodifGastoEF();
  });
  $(document).on("click", "#guardarmodifGasto", function () {
    guardarmodifGasto();
  });
  $(document).on("click", "#guardarnuevoegresoFijo", function () {
    guardarNuevoEgresFijo();
  });
  $(document).on("click", "#botongastoEgresoFijo", function () {
    $("#formEF")[0].reset();
    $("#egresofijo").empty();
    listaEgresosFijos();
  });
  $(document).on("click", "#guardarmodifegresoFijo", function () {
    guardarEgresFijomodif();
  });
  
});
function listaEgresosFijos(){
  $.ajax({
    url: "view/egresos/consultaegresosfijos.php",
    type: "POST",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
     // product = $("#ModifProducto").val();
      $("#egresofijo").append("<option value=''>Seleccione</option>");
      $.each(JSON.parse(data).data, function (i, info) {
       // if (product != info.id_pro) {
          $("#egresofijo").append(
            '<option value="' +
              info.id_egresofijo +
              '" id="mp_' +
              info.egresofijo +
              '">' +
              info.egresofijo +
              "</option>"
          );
       // }
      });
      $(document).on("blur", "#egresofijo", function () {
        var id = $("#egresofijo").val();
        var precio =
          $("#egresofijo").val() == ""
            ? ""
            : (JSON.parse(data).data).find((encontrar) => encontrar.id_egresofijo == id)
                .costo;
        $("#Gasto").val(precio);
      });
    },
  });
}
function agregarGasto() {
  $("#Producto").empty();
  $.ajax({
    url: "view/inventario/listamp.php",
    type: "POST",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $("#Producto").append("<option value=''>Seleccione</option>");
      $.each(JSON.parse(data), function (i, info) {
        $("#Producto").append(
          '<option value="' +
            info.id_mp +
            '" id="mp_' +
            info.descp +
            '">' +
            info.descp +
            "</option>"
        );
      });
    },
  });
}
function guardargastoEgresoFijo() {
  $("form[name='formEF']").validate({
    rules: {
      Gasto: {
        required: true,
      },
      Fecha: {
        required: true,
      },
      egresofijo: {
        required: true,
      },
    },
    messages: {
      Gasto: {
        required: "Este campo es obligatorio.",
      },
      Fecha: {
        required: "Este campo es obligatorio.",
      },
      egresofijo: {
        required: "Este campo es obligatorio.",
      }
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formEF")[0]);
      $.ajax({
        url: "view/egresos/guardarGastoEFijo.php",
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
              timer: 1300,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              location.reload();
            });
          } else {
            _Title = "Error!";
            _Text = "Ya existe este producto.";
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
function guardarGasto() {
  $("form[name='formMP']").validate({
    rules: {
      Producto: {
        required: true,
      },

      fechacompra: {
        required: true,
      },
      Cantidad: {
        required: true,
      },
      Precio: {
        required: true,
      },
      Peso: {
        required: true,
      },
    },
    messages: {
      Producto: {
        required: "Este campo es obligatorio.",
      },
      fechacompra: {
        required: "Este campo es obligatorio.",
      },
      Cantidad: {
        required: "Este campo es obligatorio.",
      },
      Precio: {
        required: "Este campo es obligatorio.",
      },
      Peso: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formMP")[0]);
      $.ajax({
        url: "view/egresos/guardarGasto.php",
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
              timer: 1300,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              location.reload();
            });
          } else {
            _Title = "Error!";
            _Text = "Ya existe este producto.";
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
function guardarNuevoEgresFijo() {
  $("form[name='formaggEF']").validate({
    rules: {
      nombreEgresoFijo: {
        required: true,
      },
      GastoEF: {
        required: true,
      },
      
    },
    messages: {
      nombreEgresoFijo: {
        required: "Este campo es obligatorio.",
      },
      GastoEF: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formaggEF")[0]);
      $.ajax({
        url: "view/egresos/guardarnuevoEgresoFijo.php",
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
              timer: 1300,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              location.reload();
            });
          } else {
            _Title = "Error!";
            _Text = "Ya existe este producto.";
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
function guardarEgresFijomodif() {
  $("form[name='formmodifEF']").validate({
    rules: {
      modifnombreEgresoFijo: {
        required: true,
      },
      modifGastoEF: {
        required: true,
      },
      
    },
    messages: {
      modifnombreEgresoFijo: {
        required: "Este campo es obligatorio.",
      },
      modifGastoEF: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formmodifEF")[0]);
      $.ajax({
        url: "view/egresos/guardarEgresoFijomodif.php",
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
              timer: 1300,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              location.reload();
            });
          } else {
            _Title = "Error!";
            _Text = "Ya existe este producto.";
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
function guardarmodifGastoEF() {
  $("form[name='formEFmodif']").validate({
    rules: {
      egresofijomodif: {
        required: true,
      },

      Gastomodif: {
        required: true,
      },
      Fechamodif: {
        required: true,
      },
    },
    messages: {
      egresofijomodif: {
        required: "Este campo es obligatorio.",
      },
      Gastomodif: {
        required: "Este campo es obligatorio.",
      },
      Fechamodif: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formEFmodif")[0]);
      $.ajax({
        url: "view/egresos/guardarModifGastoEF.php",
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
              timer: 1300,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              location.reload();
            });
          } else {
            _Title = "Error!";
            _Text = "Ya existe este producto.";
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
function guardarmodifGasto() {
  $("form[name='formmodifMP']").validate({
    rules: {
      ModifProducto: {
        required: true,
      },

      modiffechacompra: {
        required: true,
      },
      modifCantidad: {
        required: true,
      },
      modifPrecio: {
        required: true,
      },
      modifPeso: {
        required: true,
      },
    },
    messages: {
      ModifProducto: {
        required: "Este campo es obligatorio.",
      },
      modiffechacompra: {
        required: "Este campo es obligatorio.",
      },
      modifCantidad: {
        required: "Este campo es obligatorio.",
      },
      modifPrecio: {
        required: "Este campo es obligatorio.",
      },
      modifPeso: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formmodifMP")[0]);
      $.ajax({
        url: "view/egresos/guardarModifGasto.php",
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
              timer: 1300,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            }).then((result) => {
              location.reload();
            });
          } else {
            _Title = "Error!";
            _Text = "Ya existe este producto.";
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
function consultaEgreso(id) {
  $.ajax({
    url: "view/egresos/consultaModifEgreso.php",
    type: "POST",
    data: { id: id },

    success: function (data) {
      $("#ModifProducto").empty();

      data = JSON.parse(data);
      $("#modifcompra").val(data.data[0].nro_compra);
      $("#modiffechacompra").val(data.data[0].fecha_compra);
      $("#modifCantidad").val(data.data[0].cantidad_mp);
      $("#modifPrecio").val(data.data[0].precio);
      $("#modifPeso").val(data.data[0].peso);
      $("#ModifProducto").append(
        '<option value="' +
        data.data[0].idgasto+
          '">' +
          data.data[0].gasto +
          "</option>"
      );
      $.ajax({
        url: "view/inventario/listamp.php",
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          product = $("#ModifProducto").val();
          $("#ModifProducto").append("<option value=''>Seleccione</option>");
          $.each(JSON.parse(data), function (i, info) {
            if (product != info.id_pro) {
              $("#ModifProducto").append(
                '<option value="' +
                  info.id_mp +
                  '" id="mp_' +
                  info.descp +
                  '">' +
                  info.descp +
                  "</option>"
              );
            }
          });
        },
      });
    },
  });
}
function consultaEgresoFijo(id) {
  $.ajax({
    url: "view/egresos/consultaModifEgresofijo.php",
    type: "POST",
    data: { id: id },

    success: function (data) {
     var info = JSON.parse(data).data[0];
     $("#modifnombreEgresoFijo").val(info.egresofijo);
     $("#modifGastoEF").val(info.costo);
    },
  });
}
function consultaEgresoFijo(id) {
  $.ajax({
    url: "view/egresos/consultaModifEgreso.php",
    type: "POST",
    data: { id: id },

    success: function (data) {
      $("#egresofijomodif").empty();

      data = JSON.parse(data);
      $("#Gastomodif").val(data.data[0].precio);
      $("#Fechamodif").val(data.data[0].fecha_compra);
      $("#egresofijomodif").append(
        '<option value="' +
        data.data[0].idgasto+
          '">' +
          data.data[0].gasto +
          "</option>"
      );
      $.ajax({
        url: "view/egresos/consultaegresosfijos.php",
        type: "POST",
        success: function (data) {
          console.log(JSON.parse(data).data);
          product = $("#egresofijomodif").val();
          $("#egresofijomodif").append("<option value=''>Seleccione</option>");
          $.each(JSON.parse(data).data, function (i, info) {
            if (product != info.id_egresofijo) {
              $("#egresofijomodif").append(
                '<option value="' +
                  info.id_egresofijo +
                  '" id="mp_' +
                  info.egresofijo +
                  '">' +
                  info.egresofijo +
                  "</option>"
              );
            }
          });
        },
      });
    },
  });
}
