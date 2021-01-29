$(document).ready(function(){
	$(document).on("click", "#agregarCajaChica", function () {
    	$.getJSON("view/cajaChica/consultarFinanzas.php",function(datos){
	        if(datos != '0'){
	            $.each(datos,function(K,V){
    				$("input#MontoIngreso").val("");
    				$("input#disponible").val("");
    				$("input#disponible").val(V['capital']);
    				$("input#MontoIngreso").attr("max",V['capital']);
	            });
	        }
	    });
    	$("#modalaggventa").modal("show");
  	});

	$("input#egreso").keyup(function() {
		// input es el monto que se esta ingresando
		var input = $(this).val();
		//finanza representa el monto disponible
		var  Finanza = $("input#caja").val();
		
		//si monto ingresado es mayor al disponible muestro la alerta
		if (input > parseInt(Finanza)) {
			$("input#egreso").val('');
			_Title = "Error!";
            _Text = "Monto a ingresar no puede ser mayor a total disponible.";
            _Type = "error";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 3000,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            });
		
			return false;
		}
  	});


	$("form[name='cajach']").validate({
	    rules: {
			disponible: {
				required: true,
				number: true,
			},
			MontoIngreso: {
				required: true,
				number: true,
			}
	    },
	    messages: {
	      	disponible: {
		        required: "Este campo es obligatorio.",
		        number: "Ingrese solo números",
	      	},
	      	MontoIngreso: {
		        required: "Este campo es obligatorio.",
		        number: "Ingrese solo números",
	      	}
	    },
	    submitHandler: function () {
	      	var datos = new FormData($("form[name='cajach']")[0]);
	      	$.ajax({
		        url: "view/cajaChica/guardarCajaChica.php",
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
			              $("table#tableCajaChica").DataTable().ajax.reload();
			              $("table#tableMovimientosCajaChica").DataTable().ajax.reload();
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

	$("#MontoIngreso").keyup(function() {
		// input es el monto que se esta ingresando
		var input = $(this).val();
		//finanza representa el monto disponible
		var  Finanza = $("input#disponible").val();
		
		//si monto ingresado es mayor al disponible muestro la alerta
		if (input > parseInt(Finanza)) {
			$("#MontoIngreso").val('');
			_Title = "Error!";
            _Text = "Monto a ingresar no puede ser mayor a total disponible.";
            _Type = "error";
            Swal.fire({
              text: _Text,
              title: _Title,
              timer: 3000,
              icon: _Type,
              onBeforeOpen: function () {
                swal.showLoading();
              },
            });
		
			return false;
		}
  	});

    $('table#tableCajaChica tbody').on( 'click', 'button#agregarGasto', function () {
        var table=$('table#tableCajaChica').DataTable();
        var T =  table.row($(this).parents("tr")).data();
        var cant = T.total_out;
        $("input#caja").val("");
        $("input#caja").val(cant);

       $("div#modalRetiro").modal("show");

    });

    $("form[name='cajachEgreso']").validate({
	    rules: {
			disponible: {
				required: true,
				number: true,
			},
			MontoIngreso: {
				required: true,
				number: true,
			}
	    },
	    messages: {
	      	disponible: {
		        required: "Este campo es obligatorio.",
		        number: "Ingrese solo números",
	      	},
	      	MontoIngreso: {
		        required: "Este campo es obligatorio.",
		        number: "Ingrese solo números",
	      	}
	    },
	    submitHandler: function () {
	      	var datos = new FormData($("form[name='cajachEgreso']")[0]);
	      	$.ajax({
		        url: "view/cajaChica/EgresoCajaChica.php",
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
			              	$("div#modalRetiro").modal('toggle');
			              	$("table#tableCajaChica").DataTable().ajax.reload();
			              	$("table#tableMovimientosCajaChica").DataTable().ajax.reload();
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


});