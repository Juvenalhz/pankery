<?php

	require("../../controller/recetarioControlador.php");
	$controlador =new ControladorRecetario();
	$resultados=$controlador->sp_consultaProductos();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	if (empty($Conf)) {
		$arreglo["data"] = array(

			"id_pro" => "",
			"descp" => "",
			"precio" => "",
			"ganancia" => ""
		);
		echo json_encode($arreglo);
	} else echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
