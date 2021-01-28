<?php

	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();
	$resultados=$controlador->sp_consultaGastos();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
		
	if (empty($Conf)) {
		$arreglo["data"] = array(

			"id_compra" => "",
			"tipogasto" => "",
			"gasto" => "",
			"nro_compra" => "",
			"fecha_compra" => "",
			"cantidad_mp" => "",
			"peso" => "",
			"precio" => "",
		);
		echo json_encode($arreglo);
	} else echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
