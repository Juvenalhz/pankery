<?php

	require("../../controller/cajaChicaControlador.php");
	$controlador =new ControladorCajaChica();
	$resultados=$controlador->sp_MovimientosCajaChica();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	if (!isset($Conf)) {
		$arreglo["data"] = array(
		"id_out" => "",
		"nombre_out" => "",
		"cantidad_out" => "",
		"usuario_out" => "",
		"fecha_registro_out" => "");

		echo json_encode($arreglo);
	}else{
		echo json_encode($Conf);
	}

?>
