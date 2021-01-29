$(document).ready(function(){
	$(document).on("click", "#agregarCajaChica", function () {
    	$.getJSON("view/cajaChica/consultarFinanzas.php",function(datos){
	        if(datos != '0'){
	            $.each(datos,function(K,V){
    				$("input#disponible").val("");
    				$("input#disponible").val(V['capital']);
    				$("input#MontoIngreso").attr("max",V['capital']);
	            });
	        }
	    });
    	$("#modalaggventa").modal("show");
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

	$(document).on("click", "button#guardargastoEgresoFijo", function (event) {
	    var info = $("input#MontoIngreso").val();
	    $.getJSON("view/cajaChica/guardarCajaChica.php",{info:info},function(datos){
	            	console.log(datos);
	        if(datos != '0'){
	            $.each(datos,function(K,V){
    				$("input#disponible").val("");
    				$("input#disponible").val(V['capital']);
    				$("input#MontoIngreso").attr("max",V['capital']);
	            });
	        }
	    });
	            	event.preventDefault();  

	    
				/*if (data == 1) {
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
	          	}*/
	       
	    
	});

});