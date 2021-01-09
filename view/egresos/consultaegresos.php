<?php

	require("../../controller/egresosControlador.php");
	$controlador =new ControladorEgresos();
	$resultados=$controlador->sp_consultaGastos();
	while($registros = pg_fetch_assoc($resultados)){
		$Conf["data"][] = $registros;
	}
	
	echo json_encode($Conf,JSON_NUMERIC_CHECK);





?>
