$(document).ready(function () {
  $("#agregarArticulo").click(function () {
    pestañaNuevoArticulo();
  });
  $("#Nuevomp").click(function () {
    pestañaNuevoArticulo();
  });
  $("#Actualizarmp").click(function () {
    pestañaActualizarArticulo();
  });

  $(document).on("click", "#guardarNuevoArticulo", function () {
    GuardarNuevoArticulo();
  });
  $(document).on("click", "#actualizarArticulo", function () {
    ActualizarArticulo();
  });
  $("table#dataMateriaPrima tbody").on("click", "#modificarError", function () {
    var table = $("#dataMateriaPrima").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var materiaprima = D.descp;
    var id = D.id_mp;
    pestañaModificarArticulo(materiaprima, id);
  });
  $(document).on("click", "#modifNuevoArticulo", function () {
    modificarArticulo();
  });



  $("table#dataMateriaPrima").on("click", "#habilitarError", function () {
    var table = $("#dataMateriaPrima").DataTable();
    var D = table.row($(this).parents("tr")).data();
    var id = D.id_mp;
    eliminarArticulo(id);
  });
});
function eliminarArticulo(id){
  
  Swal.fire({
    title: 'Esta seguro?',
    text: "Elimiará permanentemente este artículo.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Estoy seguro.'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "view/inventario/eliminararticulo.php",
        data: {id:id},
        success: function (data) {
          Swal.fire(
            'Eliminado!',
            'El artículo ha sido elimnado permanentemente.',
            'success'
          ).then((result) => {
            location.reload();
          })
        },
      }).fail(function () {
        swal("FATAL-ERROR", " ERROR DE AJAX :( :( ", "error");
      });
     
    }
  })
}
function modificarArticulo() {
  $("form[name='formmodif']").validate({
    rules: {
      materiaprimamodif: {
        required: true,
      },
    },
    messages: {
      materiaprimamodif: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formmodif")[0]);
      $.ajax({
        url: "view/inventario/modificarArticulo.php",
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
function pestañaModificarArticulo(value, id) {
  $("#formmodif").empty();
  $("#formmodif").append(
    '<div class="form-row" style="padding-top: 1em;">' +
      '<div class="form-group col-md-6">' +
      '<label for="materiaprimamodif">Materia Prima</label>' +
      '<input type="text" class="form-control" id="materiaprimamodif" name="materiaprimamodif" value="' +
      value +
      '">'+
      '<input type="hidden" class="form-control" id="idmateriaprima" name="idmateriaprima" value="' +
      id +
      '"></div></div>' +
      '<div class="form-group">' +
      '<div class="modal-footer">' +
      '<button type="button" class=" btn btn-secondary" data-dismiss="modal">Cerrar</button>' +
      '<button type="submit" class="btn btn-primary" id="modifNuevoArticulo">Guardar</button></div>'
  );
}
function pestañaNuevoArticulo() {
  $("#formInv").empty();
  $("#Nuevomp").addClass("active");
  $("#Actualizarmp").removeClass("active");
  $("#formInv").append(
    '<div class="form-row" style="padding-top: 1em;">' +
      '<div class="form-group col-md-6">' +
      '<label for="materiaprima">Materia Prima</label>' +
      '<input type="text" class="form-control" id="materiaprima" name="materiaprima"></div></div>' +
      '<div class="form-group">' +
      '<div class="modal-footer">' +
      '<button type="button" class=" btn btn-secondary" data-dismiss="modal">Cerrar</button>' +
      '<button type="submit" class="btn btn-primary" id="guardarNuevoArticulo">Guardar</button></div>'
  );
}
function pestañaActualizarArticulo() {
  $("#formInv").empty();
  $("#Actualizarmp").addClass("active");
  $("#Nuevomp").removeClass("active");
  $("#formInv").append(
    '<div class="form-row" style="padding-top: 1em;">' +
      '<div class="form-group col-md-6">' +
      '<label for="materiaprima">Materia Prima</label>' +
      '   <select class="custom-select mr-sm-2" id="materiaprimaAct" name="materiaprimaAct">' +
      "<option >Seleccione</option>" +
      "</select></div>" +
      '<div class="form-group col-md-6">' +
      '<label for="CantidadMP">Cantidad</label>' +
      '<input type="numeric" class="form-control" id="CantidadMPAct" name="CantidadMPAct"></div></div>' +
      '<div class="form-check-inline form-check">' +
      '<label for="inline-radio1" class="form-check-label ">' +
      '<input type="radio" id="accionCant" name="accionCant" value="sum" class="form-check-input">Agregar </label>' +
      '<label for="inline-radio3" class="form-check-label ">' +
      '<input type="radio" id="accionCant" name="accionCant" value="res" class="form-check-input">Reducir </label>' +
      " </div>" +
      '<div class="form-group">' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>' +
      '<button type="submit" class="btn btn-primary" id="actualizarArticulo">Guardar</button></div>'
  );
  $("#materiaprimaAct").empty();
  $.ajax({
    url: "view/inventario/listamp.php",
    type: "POST",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $("#materiaprimaAct").append("<option>Seleccione</option>");
      $.each(JSON.parse(data), function (i, info) {
        $("#materiaprimaAct").append(
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

function ActualizarArticulo() {
  $("form[name='formInv']").validate({
    rules: {
      materiaprimaAct: {
        required: true,
      },
      CantidadMPAct: {
        required: true,
        number: true,
      },
      accionCant: {
        required: true,
      },
    },
    messages: {
      materiaprimaAct: {
        required: "Este campo es obligatorio.",
      },
      CantidadMPAct: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
      accionCant: {
        required: "Este campo es obligatorio.",
      },
    },
    submitHandler: function () {
      var datos = new FormData($("form[name='formInv']")[0]);
      $.ajax({
        url: "view/inventario/actualizararticulo.php",
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
            });
          } else {
            _Title = "Error!";
            _Text = "Stock insuficiente";
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

function GuardarNuevoArticulo() {
  $("form[name='formInv']").validate({
    rules: {
      materiaprima: {
        required: true,
      },
      CantidadMP: {
        required: false,
        number: true,
      },
    },
    messages: {
      materiaprima: {
        required: "Este campo es obligatorio.",
      },
      CantidadMP: {
        number: "Ingrese solo números",
        pattern: "Este campo debe contener solo números [0 - 9]",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formInv")[0]);
      $.ajax({
        url: "view/inventario/nuevoArticulo.php",
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
