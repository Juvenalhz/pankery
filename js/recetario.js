var index; //index para recetario
$(document).ready(function () {
  $("#agregarProducto").click(function () {
    pestañaNuevoProducto();
  });
  $(document).on("click", "#guardarproducto", function () {
    GuardarNuevoProducto();
  });
  $(document).on("click", "#agregarmp", function () {
    agregarMPReceta();
  });
  $(document).on("click", "#deleteMP", function () {
   $(this).parent().remove();    
  });
  $("table#dataRecetario tbody").on("click", "#recetario", function () {
    var table = $("table#dataRecetario").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var id = D.id_pro;
    $("#formreceta").empty();
    $("#formreceta").append(
      '<input type="hidden" name="id_producto" value="' + id + '">'
    );
    index = 0; //devolviendo valor de recetario verreceta
    modificarReceta(id);
  });

  $("table#dataRecetario tbody").on("click", "#verganancia", function () {
    var table = $("table#dataRecetario").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var id = D.id_pro;
    $("#formganancia")[0].reset();
    $("#formganancia").append(
      '<input type="hidden" name="id_producto" value="' + id + '">'
    );
    
  });
  $("#guardarganancia").on("click",  function () {
    GuardarGanancia();
  });

  $("table#dataRecetario").on("click", "#verreceta", function () {
    var table = $("table#dataRecetario").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var id = D.id_pro;
    var descp = D.descp;
    receta(id,descp);
  });
  $(document).on("click", "#guardarReceta", function () {
    guardarReceta();
  });
});
function  receta(id,descp) {
  $("#listReceta").empty();
  index = 0;
  $.ajax({
    url: "view/recetario/verReceta.php",
    type: "POST",
    data: { id: id },
    success: function (data) {
      $("#tituloReceta").html("RECETA " + descp);
      if (data == 0) {
        $("#listReceta").append(
          '<li class="list-group-item">' +
            "No se ha agregado ninguna receta" +
            "</li>"
        );
      } else {
        $.each(JSON.parse(data), function (i, info) {
          index++;
          $("#listReceta").append(
            '<li class="list-group-item">' +
              index +
              " . " +
              info.materiaprima +
              " " +
              info.cantidad +
              " gr</li>"
          );
        });
      }
      
    },
  }).fail(function () {
    swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
  });
}
function agregarMPReceta() {
  index++;
  $("#formreceta").append(
    '<div class="mprec">' +
    "<button type='button' class='close' aria-label='Close' id='deleteMP'><span aria-hidden='true'>&times;</span></button>"+
    '<div class="form-row" style="padding-top: 1em;">' +
      '<div class="form-group col-md-6">' +
      '<label for="materiaprima">Materia Prima</label>' +
      '   <select class="custom-select mr-sm-2" id="materiaprimaAct' +
      index +
      '" name="materiaprimaAct' +
      index +
      '">' +
      "</select></div>" +
      '<div class="form-group col-md-6">' +
      '<label for="CantidadMP">Cantidad</label>' +
      '<input type="numeric" class="form-control" id="CantidadMPAct' +
      index +
      '" name="CantidadMPAct' +
      index +
      '"></div></div></div>'
  );
  ListaMP = "#materiaprimaAct" + index;
  //  $("#materiaprimaAct").empty();
  $.ajax({
    url: "view/inventario/listamp.php",
    type: "POST",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $(ListaMP).append("<option>Seleccione</option>");
      $.each(JSON.parse(data), function (i, info) {
        $(ListaMP).append(
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
  }).fail(function () {
    swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
  });
}

function pestañaNuevoProducto() {
  $("#formRec").empty();
  $("#formRec").append(
    '<div class="form-row" style="padding-top: 1em;">' +
      '<div class="form-group col-md-6">' +
      '<label for="materiaprima">Producto</label>' +
      '<input type="text" class="form-control" id="productoRec" name="productoRec"></div>' +
      '<div class="form-group col-md-6">' +
      '<label for="materiaprima" style="display:none;">Precio</label>' +
      '<input type="text" class="form-control" id="preciouni" name="preciouni" value="0" style="display:none;"></div></div>' +
      '<div class="form-group">' +
      '<div class="modal-footer">' +
      '<button type="button" class=" btn btn-secondary" data-dismiss="modal">Cerrar</button>' +
      '<button type="submit" class="btn btn-primary" id="guardarproducto">Guardar</button></div>'
  );
}

function GuardarNuevoProducto() {
  $("form[name='formRec']").validate({
    rules: {
      productoRec: {
        required: true,
        maxlength: 25,
      },
      preciouni: {
        required: true,
        number: true,
        max: 999,
      },
    },
    messages: {
      productoRec: {
        required: "Este campo es obligatorio.",
        maxlength: "Excede el máximo de caracteres (25).",
      },
      preciouni: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        max: "Este campo no puede tener más de tres dígitos.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formRec")[0]);
      $.ajax({
        url: "view/recetario/nuevoProducto.php",
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
              $("table#dataRecetario").DataTable().ajax.reload();
              $("#exampleModal").modal('toggle');
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
function GuardarGanancia() {
  $("form[name='formganancia']").validate({
    rules: {
      montoganancia: {
        required: true,
        maxlength: 10,
      },
    },
    messages: {
      montoganancia: {
        required: "Este campo es obligatorio.",
        maxlength: "Excede el máximo de caracteres (10).",
      }
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formganancia")[0]);
      $.ajax({
        url: "view/recetario/gananciaproducto.php",
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
              $("table#dataRecetario").DataTable().ajax.reload();
              $("#agregarganancia").modal('toggle');
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
function guardarReceta() {
  for (let i = 1; i <= index; i++) {
    validacion = "#materiaprimaAct" + i;
    validacion2 = "#CantidadMPAct" + i;
    if (
      
      $(validacion).val() == "Seleccione" ||
     
      $(validacion2).val() == ""
    ) {
      Swal.fire({
        position: "center",
        icon: "error",
        title: "Debe completar todos los campos.",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      if (i != index) continue;
      var datos = new FormData($("form#formreceta")[0]);
      datos.append("index", index);
      $.ajax({
        url: "view/recetario/nuevaReceta.php",
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
              $("table#dataRecetario").DataTable().ajax.reload();
              $("#modificarMateriaPrimaRecetario").modal('toggle');
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
    }
  }
}
function modificarReceta(id) {
  $.ajax({
    url: "view/recetario/modificarReceta.php",
    type: "POST",
    data: { id: id },
    success: function (data) {
      console.log(data);
      if (data != 0) {
        $.each(JSON.parse(data), async function (i, info) {
          index = index + 1;
          $("#formreceta").append(
            '<div>' +
            "<button type='button' class='close' aria-label='Close'  id='deleteMP'><span aria-hidden='true'>&times;</span></button>"+
            '<div class="form-row" style="padding-top: 1em;">' +
              '<div class="form-group col-md-6">' +
              '<label for="materiaprima">Materia Prima</label>' +
              '   <select class="custom-select mr-sm-2" id="materiaprimaAct' +
              index +
              '" name="materiaprimaAct' +
              index +
              '">' +
              '<option value="' +
              info.id_mp +
              '" id="mp_' +
              info.materia_prima +
              '">' +
              info.materia_prima +
              "</option>" +
              "</select></div>" +
              '<div class="form-group col-md-6">' +
              '<label for="CantidadMP">Cantidad</label>' +
              '<input type="numeric" class="form-control" id="CantidadMPAct' +
              index +
              '" name="CantidadMPAct' +
              index +
              '" value="' +
              info.cantidad +
              '"></div></div></div>'
          );
        });
      } else {
        return false;
      }
    },
  })
    .done(function (value) {
      if (value) {
        for (let i = 1; i <= index; i++) {
          $.ajax({
            url: "view/recetario/listampconprecio.php",
            type: "POST",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
              ListaMP = "#materiaprimaAct" + i;
              $.each(JSON.parse(data), function (i, info) {
                for (let j = 1; j <= index; j++) {
                  ListaMPseleccionados = "#materiaprimaAct" + j;
                  if ($(ListaMPseleccionados).val() == info.id_mp) {
                    break;
                  }else {
                    if (j < index) continue;
                    $(ListaMP).append(
                      '<option value="' +
                        info.id_mp +
                        '" id="mp_' +
                        info.descp +
                        '">' +
                        info.descp +
                        "</option>"
                    );

                  }
                }
                });
            },
          });
        }
      }
    })

    .fail(function () {
      swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
    });
}
