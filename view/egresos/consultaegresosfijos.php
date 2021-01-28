<?php

	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();
	$resultados=$controlador->sp_consultaEgresosFijos();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
		
	if (empty($Conf)) {
		$arreglo["data"] = array(

			"id_egresofijo" => "",
			"egresofijo" => "",
			"costo" => ""
		);
		echo json_encode($arreglo);
	} else echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
