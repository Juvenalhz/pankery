<?php

	require("../../controller/cajaChicaControlador.php");
	$controlador =new ControladorCajaChica();
	$resultados=$controlador->sp_consultaTotal();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	if (!isset($Conf)) {
		$arreglo["data"] = array(
		"id_out" => "",
		"total_out" => "");

		echo json_encode($arreglo);
	}else{
		echo json_encode($Conf);
	}

?>
