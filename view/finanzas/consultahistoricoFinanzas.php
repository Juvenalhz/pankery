<?php

	require("../../controller/finanzasControlador.php");
	$controlador =new ControladorFinanzas();
	$resultados=$controlador->sp_consultahistfinanza();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
		
	if (empty($Conf)) {
		$arreglo["data"] = array(

			"id_finanzahist" => "",
			"tipo" => "",
			"descripcion" => "",
			"monto" => "",
			"fecha" => ""
		);
		echo json_encode($arreglo);
	} else echo json_encode($Conf,JSON_NUMERIC_CHECK);




?>
