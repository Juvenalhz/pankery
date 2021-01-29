<?php

	require("../../controller/inventarioControlador.php");
	$controlador =new ControladorInventario();
	$resultados=$controlador->sp_consultaMP();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
		
	if (empty($Conf)) {
		$arreglo["data"] = array(

			"id_mp" => "",
			"descp" => "",
			"cant" => ""
		);
		echo json_encode($arreglo);
	} else echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
