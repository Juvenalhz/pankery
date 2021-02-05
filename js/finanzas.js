var index; //index para recetario
$(document).ready(function () {
  $("#guardaraggfinanza").click(function () {
    AggCapital();
  });
});

function AggCapital() {
  $("form[name='formaggF']").validate({
    rules: {
      Cantidadagg: {
        required: true,
        number: true,
        max: 999,
      },
    },
    messages: {
      Cantidadagg: {
        required: "Este campo es obligatorio.",
        number: "Ingrese solo números",
        max: "Este campo no puede tener más de tres dígitos.",
      },
    },
    submitHandler: function () {
      // var file_data = $('#file').prop('files')[0];
      var datos = new FormData($("form#formaggF")[0]);
      $.ajax({
        url: "view/finanzas/aggcapital.php",
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
